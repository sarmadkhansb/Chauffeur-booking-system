<?php

/******************************************************************************/
/******************************************************************************/

class CHBSWooCommerce
{
	/**************************************************************************/
	
	function __construct()
	{
		
	}
	
	/**************************************************************************/
	
	function isEnable($meta)
	{
		return((class_exists('WooCommerce')) && ($meta['woocommerce_enable']) && (!$meta['price_hide']));
	}
	
	/**************************************************************************/
	
	function isPayment($paymentId,$dictionary=null)
	{
		if(is_null($dictionary)) $dictionary=$this->getPaymentDictionary();

		foreach($dictionary as $value)
		{
			if($value->{'id'}==$paymentId) return(true);
		}
		
		return(false);
	}
	
	/**************************************************************************/
	
	function getPaymentDictionary()
	{
		$dictionary=WC()->payment_gateways->payment_gateways();

		foreach($dictionary as $index=>$value)
		{
			if(!isset($value->enabled)) unset($dictionary[$index]);
			if($value->enabled!='yes') unset($dictionary[$index]);
		}
		
		return($dictionary);
	}
	
	/**************************************************************************/
	
	function getPaymentName($paymentId,$dictionary=null)
	{
		if(is_null($dictionary)) $dictionary=$this->getPaymentDictionary();
		
		foreach($dictionary as $value)
		{
			if($value->{'id'}==$paymentId) return($value->{'title'});
		}		
		
		return(null);
	}
	
	/**************************************************************************/
	
	function sendBooking($bookingId,$bookingForm,$data)
	{
		global $wpdb;
		
		$User=new CHBSUser();
		$Booking=new CHBSBooking();
		
		if(($booking=$Booking->getBooking($bookingId))===false) return(false);		
		
		$userId=0;
		
		if(!$User->isSignIn())
		{
			if(((int)$data['client_sign_up_enable']===1) || ((int)$bookingForm['meta']['woocommerce_account_enable_type']===2))
				$userId=$User->createUser($data['client_contact_detail_email_address'],$data['client_sign_up_login'],$data['client_sign_up_password']);
		}
		else
		{
			$userData=$User->getCurrentUserData();
			$userId=$userData->data->ID;
		}
		
		CHBSPostMeta::updatePostMeta($bookingId,'user_id',$userId);
		
		$address=array
		(
			'first_name'=>$booking['meta']['client_contact_detail_first_name'],
			'last_name'=>$booking['meta']['client_contact_detail_last_name'],
			'company'=>$booking['meta']['client_billing_detail_company_name'],
			'address_1'=>$booking['meta']['client_billing_detail_street_name'],
			'address_2'=>$booking['meta']['client_billing_detail_street_number'],
			'city'=>$booking['meta']['client_billing_detail_city'],
			'postcode'=>$booking['meta']['client_billing_detail_postal_code'],
			'country'=>$booking['meta']['client_billing_detail_country_code'],
			'state'=>$booking['meta']['client_billing_detail_state'],
			'phone'=>$booking['meta']['client_contact_detail_phone_number'],
			'email'=>$booking['meta']['client_contact_detail_email_address']			
		);
		
		$argument=array();
		
		$argument['customer_id']=$booking['meta']['user_id'];
		
		if((int)$booking['meta']['business_user_paid']===1) $argument['status']='completed';
	
		$order=wc_create_order($argument);
		$order->set_address($address,'billing');
		$order->set_address($address,'shipping');
		$order->set_payment_method($booking['meta']['payment_id']);
		
		switch((int)$booking['meta']['booking_status_id'])
		{			
			case 3:
				
				$order->update_status('cancelled');
				
			break;
		
			default:
				
				$order->update_status('pending');
		}		

		$order->set_currency($booking['meta']['currency_id']);
		
		update_post_meta($order->get_id(),PLUGIN_CHBS_CONTEXT.'_booking_id',$bookingId);
		
		CHBSPostMeta::updatePostMeta($bookingId,'woocommerce_booking_id',$order->get_id());
		
		if($userId>0) 
		{
			$userData=array
			(
				'ID'=>$userId,
				'first_name'=>$booking['meta']['client_contact_detail_first_name'],
				'last_name'=>$booking['meta']['client_contact_detail_last_name']
			);
			
			wp_update_user($userData); 
			
			update_post_meta($order->get_id(),'_customer_user',$userId);
		
			foreach($address as $index=>$value) 
			{
				update_user_meta($userId,'billing_'.$index,$value);
				update_user_meta($userId,'shipping_'.$index,$value);
			}		  
		}
			
		/***/

		$billing=$Booking->createBilling($bookingId);
		
		if((int)CHBSOption::getOption('woocommerce_order_reduce_item')===1)
			$billing['detail']=$billing['reduced'];
		
		if(isset($billing['detail']))
		{
			$productId=array();
			
			/***/
			
			foreach($billing['detail'] as $detail)
			{
				if($detail['visible']!=1) continue;
				
				$product=$this->prepareProduct
				(
					array
					(
						'post'=>array
						(
							'post_title'=>$detail['name']
						),
						'meta'=>array
						(
							'chbs_price_gross'=>$detail['value_gross'],
							'chbs_tax_value'=>$detail['tax_value'],
							'_regular_price'=>$detail['value_net'],
							'_sale_price'=>$detail['value_net'],
							'_price'=>$detail['value_net']
						)
					)
				);
				
				$productId[]=$this->createProduct($product);
				$order->add_product(wc_get_product(end($productId)));
			}
			
			$order->calculate_totals();
				
			/***/
		
			$query=$wpdb->prepare('delete from '.$wpdb->prefix.'woocommerce_order_items where order_id=%d and order_item_type=%s',$order->get_id(),'tax');
			$wpdb->query($query);
			
			/***/
			
			$taxRateId=1;
			$orderItem=$order->get_items();
				
			/***/
			
			$i=0;
			$taxArray=array();
			foreach($orderItem as $item)
			{
				$priceNet=get_post_meta($item->get_product_id(),'_price',true);
				$priceGross=get_post_meta($item->get_product_id(),'chbs_price_gross',true);
				$taxValue=get_post_meta($item->get_product_id(),'chbs_tax_value',true);
				$taxAmount=round($priceGross-$priceNet,2);
				$taxLabel=sprintf(__('Tax %.2f','chauffeur-booking-system'),$taxValue).'%';
				
				if(!isset($taxArray[$taxValue]))
				{
					$query=$wpdb->prepare('insert into '.$wpdb->prefix.'woocommerce_order_items(order_item_name,order_item_type,order_id) VALUES (%s,%s,%d)',array('TAX-'.$taxValue,'tax',$order->get_id()));
					$wpdb->query($query);

					$taxItemId=$wpdb->insert_id;

					$taxArray[$taxValue]=array
					(
						'taxItemId'=>$taxItemId,
						'rate_id'=>$taxRateId,
						'label'=>$taxLabel,
						'compound'=>'',
						'tax_amount'=>$taxAmount,
						'shipping_tax_amount'=>0,
					);
					
					wc_add_order_item_meta($taxArray[$taxValue]['taxItemId'],'rate_id',$taxArray[$taxValue]['rate_id']);
					wc_add_order_item_meta($taxArray[$taxValue]['taxItemId'],'label',$taxArray[$taxValue]['label']);
					wc_add_order_item_meta($taxArray[$taxValue]['taxItemId'],'compound',$taxArray[$taxValue]['compound']);
					wc_add_order_item_meta($taxArray[$taxValue]['taxItemId'],'tax_amount',$taxArray[$taxValue]['tax_amount']);
					wc_add_order_item_meta($taxArray[$taxValue]['taxItemId'],'shipping_tax_amount',$taxArray[$taxValue]['shipping_tax_amount']);
				}
				else
				{
					$taxArray[$taxValue]['tax_amount']+=$taxAmount;
					wc_update_order_item_meta($taxArray[$taxValue]['taxItemId'],'tax_amount',$taxArray[$taxValue]['tax_amount']);		
				}
				
				$taxData=array
				(
					'total'=>array
					(
						$taxArray[$taxValue]['rate_id']=>(string)$taxAmount,
					),
					'subtotal'=>array
					(
						$taxArray[$taxValue]['rate_id']=>(string)$taxAmount,
					)
				);
								
				wc_update_order_item_meta($item->get_id(),'_line_subtotal_tax',$taxAmount);
				wc_update_order_item_meta($item->get_id(),'_line_tax',$taxAmount);
				wc_update_order_item_meta($item->get_id(),'_line_tax_data',$taxData);
						
				$taxRateId++;
			}
					
			update_post_meta($order->get_id(),'_order_tax',$billing['summary']['value_gross']-$billing['summary']['value_net']);
			update_post_meta($order->get_id(),'_order_total',$billing['summary']['value_gross']);
					
			foreach($productId as $value) wp_delete_post($value);
			
			return($order->get_checkout_payment_url());
		}
		
		return(null);
	}
	
	/**************************************************************************/
	
	function prepareProduct($data)
	{
 		$argument=array
		(
			'post'=>array
			(
				'post_title'=>'',
				'post_content'=>'',
				'post_status'=>'publish',
				'post_type'=>'product',
			),
			'meta'=>array
			(
				'chbs_price_gross'=>0,
				'chbs_tax_value'=>0,
				'_visibility'=>'visible',
				'_stock_status'=>'instock',
				'_downloadable'=>'no',
				'_virtual'=>'yes',
				'_regular_price'=>0,
				'_sale_price'=>0,
				'_purchase_note'=>'',
				'_featured'=>'no',
				'_weight'=>'',
				'_length'=>'',
				'_width'=>'',
				'_height'=>'',
				'_sku'=>'',
				'_product_attributes'=>array(),
				'_sale_price_dates_from'=>'',
				'_sale_price_dates_to'=>'',
				'_price'=>0,
				'_sold_individually'=>'',
				'_manage_stock'=>'no',
				'_backorders'=>'no',
				'_stock'=>'',
				'total_sales'=>'0',
			),
		);
		
		if(isset($data['post']))
		{
			foreach($data['post'] as $index=>$value)
				$argument['post'][$index]=$value;
		}
		
		if(isset($data['meta']))
		{
			foreach($data['meta'] as $index=>$value)
				$argument['meta'][$index]=$value;
		}		
		
		return($argument);	   
	}
	
	/**************************************************************************/
	
	function createProduct($data)
	{
		$productId=wp_insert_post($data['post']);
		wp_set_object_terms($productId,'simple','product_type');
		foreach($data['meta'] as $key=>$value)
			update_post_meta($productId,$key,$value);
		return($productId);
	}
	
	/**************************************************************************/
	
	function locateTemplate($template,$templateName,$templatePath) 
	{
		global $woocommerce;
	   
		$templateTemp=$template;
		if(!$templatePath) $templatePath=$woocommerce->template_url;
 
		$pluginPath=PLUGIN_CHBS_PATH.'woocommerce/';
	 
		$template=locate_template(array($templatePath.$templateName,$templateName));
 
		if((!$template) && (file_exists($pluginPath.$templateName)))
			$template=$pluginPath.$templateName;
 
		if(!$template) $template=$templateTemp;
   
		return ($template);
	}
	
	/**************************************************************************/
	
	function getUserData()
	{
		$userData=array();
		$userCurrent=wp_get_current_user();
		
		$Country=new WC_Countries();
		$Customer=new WC_Customer($userCurrent->ID);
		
		$billingAddress=$Customer->get_billing();
		
		$userData['client_contact_detail_first_name']=$userCurrent->user_firstname;
		$userData['client_contact_detail_last_name']=$userCurrent->user_lastname;
		$userData['client_contact_detail_email_address']=$userCurrent->user_email;
		$userData['client_contact_detail_phone_number']=$billingAddress['phone'];
		
		$userData['client_billing_detail_enable']=1;
		$userData['client_billing_detail_company_name']=$billingAddress['company'];
		$userData['client_billing_detail_tax_number']=null;
		$userData['client_billing_detail_street_name']=$billingAddress['address_1'];
		$userData['client_billing_detail_street_number']=$billingAddress['address_2'];
		$userData['client_billing_detail_city']=$billingAddress['city'];
		$userData['client_billing_detail_state']=null;
		$userData['client_billing_detail_postal_code']=$billingAddress['postcode'];
		$userData['client_billing_detail_country_code']=$billingAddress['country'];
		
		$state=$billingAddress['state'];
		$country=$billingAddress['country'];
		
		$countryState=$Country->get_states();
		
		if((isset($countryState[$country])) && (isset($countryState[$country][$state])))
			$userData['client_billing_detail_state']=$countryState[$country][$state];
		
		return($userData);
	}
	
	/**************************************************************************/
	
	function getPaymentURLAddress($bookingId)
	{
		$order=wc_get_order($bookingId);
		
		if($order!==false)
			return($order->get_checkout_payment_url());
		
		return(null);
	}
	
	/**************************************************************************/
	
	function addAction()
	{
		add_action('woocommerce_order_status_changed',array($this,'changeStatus'));
		add_action('woocommerce_email_customer_details',array($this,'createOrderEmailMessageBody'));
		
		add_action('woocommerce_view_order',array($this,'viewOrder'));
		
		add_action('add_meta_boxes',array($this,'addMetaBox'));
		
		add_action('wpo_wcpdf_order_items_data',array($this,'changeOrderItemsData'),10,4);
	}
	
	/**************************************************************************/
	
	function changeOrderItemsData($data_list,$this_order)
	{
		if(count($data_list)>=1)
		{
			$meta=CHBSPostMeta::getPostMeta($this_order->get_id());

			if(array_key_exists('booking_id',$meta))
			{
				$Date=new CHBSDate();
				$Booking=new CHBSBooking();
				
				if(($booking=$Booking->getBooking($meta['booking_id']))===false) return($data_list);

				$pickupLocation=null;
				$dropoffLocation=null;
				
				$i=0;
				foreach($booking['meta']['coordinate'] as $index=>$value)
				{
					if($i===0) $pickupLocation=$value['address'];
					if($i===count($booking['meta']['coordinate'])-1) $dropoffLocation=$value['address'];
					
					$i++;
				}
				
				$pickupDateTime=$Date->formatDateToDisplay($booking['meta']['pickup_date']).' '.$Date->formatTimeToDisplay($booking['meta']['pickup_time']);
				
				$key=key($data_list);
				
				$data_list[$key]['name'].='<br/>'.__('Pickup date: ','chauffer-booking-system').$pickupDateTime;
				$data_list[$key]['name'].='<br/>'.__('Pickup location: ','chauffer-booking-system').$pickupLocation;
				$data_list[$key]['name'].='<br/>'.__('Drop off location: ','chauffer-booking-system').$dropoffLocation;
			}
		}

		return($data_list);
	}
	
	/**************************************************************************/
	
	function addMetaBox()
	{
		global $post;
	
		if($post->post_type=='shop_order')
		{
			$meta=CHBSPostMeta::getPostMeta($post);
			
			if((is_array($meta)) && (array_key_exists('booking_id',$meta)) && ($meta['booking_id']>0))
			{
				add_meta_box(PLUGIN_CHBS_CONTEXT.'_meta_box_woocommerce_product',__('Booking','chauffeur-booking-system'),array($this,'addMetaBoxWooCommerceBooking'),'shop_order','side','low');		
			}
		}
	}
	
	/**************************************************************************/
	
	function addMetaBoxWooCommerceBooking()
	{
		global $post;
		
		$meta=CHBSPostMeta::getPostMeta($post);
		
		echo 
		'
			<div>
				<div>'.esc_html__('This order has corresponding booking from "Chauffeur Booking System" plugin. Click on button below to see its details in new window.','chauffeur-booking-system').'</div>
				<br/>
				<a class="button button-primary" href="'.esc_url(get_edit_post_link($meta['booking_id'])).'" target="_blank">'.esc_html__('Open booking','chauffeur-booking-system').'</a>
			</div>
		';
	}
	
	/**************************************************************************/
	
	function changeStatus($orderId=-1,$bookingId=-1,&$emailSend=false)
	{
		$Booking=new CHBSBooking();
		
		$bookingStatusSynchronizationId=(int)CHBSOption::getOption('booking_status_synchronization');
		
		if($bookingStatusSynchronizationId===1) return(false);
		
		if(!class_exists('WC_Order')) return(false);
			
		/***/
		
		$BookingStatus=new CHBSBookingStatus();
		
		if((int)$orderId!==-1)
		{
			$orderMeta=CHBSPostMeta::getPostMeta($orderId);		
			if((array_key_exists('booking_id',$orderMeta)) && ($orderMeta['booking_id']>0))
				$bookingId=(int)$orderMeta['booking_id'];
		}
		elseif((int)$bookingId!==-1)
		{
			if(($booking=$Booking->getBooking($bookingId))!==false) 		
			{
				if((array_key_exists('woocommerce_booking_id',$booking['meta'])) && ($booking['meta']['woocommerce_booking_id']>0))
					$orderId=$booking['meta']['woocommerce_booking_id'];
			}
		}
		
		/***/
		
		if((int)$bookingStatusSynchronizationId===2)
		{
			if($bookingId!=-1)
			{
				$order=new WC_Order($orderId);
				
				$status=$BookingStatus->mapBookingStatus($order->get_status());
				
				if($status!==false) 
				{	
					$bookingOld=$Booking->getBooking($bookingId);
					
					CHBSPostMeta::updatePostMeta($bookingId,'booking_status_id',$status);
					
					$bookingNew=$Booking->getBooking($bookingId);
					
					$Booking->sendEmailBookingChangeStatus($bookingOld,$bookingNew);
					
					$GoogleCalendar=new CHBSGoogleCalendar();
					$GoogleCalendar->sendBooking($bookingId,false,'after_booking_status_change');
					
					$emailSend=true;
				}
			}
		}
		else if((int)$bookingStatusSynchronizationId===3)
		{
			if($orderId!=-1)
			{
				$Booking=new CHBSBooking();
				if(($booking=$Booking->getBooking($bookingId))!==false) 
				{
					$status=$BookingStatus->mapBookingStatus($booking['meta']['booking_status_id']);
					if($status!==false)
					{
						$order=new WC_Order($orderId);
						$order->update_status($status);
					}
				}
			}			
		}
	}
	
	/**************************************************************************/
	
	function createOrderEmailMessageBody($order,$sent_to_admin=false)
	{
		if(!($order instanceof WC_Order)) return(''); 
		
		$Email=new CHBSEmail();
		$Booking=new CHBSBooking();
		
		$meta=CHBSPostMeta::getPostMeta($order->get_id());
		
		$bookingId=(int)$meta['booking_id'];
		
		if($bookingId<=0) return;
		
		if(($booking=$Booking->getBooking($bookingId))===false) return;
		
		$data=array();
		
		$data['style']=$Email->getEmailStyle();
		
		$data['booking']=$booking;
		$data['booking']['billing']=$Booking->createBilling($bookingId);
		$data['booking']['booking_title']=$booking['post']->post_title;
		
		$data['document_header_exclude']=1;
				
		if(!$sent_to_admin)
			unset($data['booking']['booking_form_name']);
		
		$Template=new CHBSTemplate($data,PLUGIN_CHBS_TEMPLATE_PATH.'email_booking.php');
		$body=$Template->output();
		
		echo $body;
	}
	
	/**************************************************************************/
	
	function viewOrder($orderId)
	{	
		$orderMeta=CHBSPostMeta::getPostMeta($orderId);
			
		if((array_key_exists('booking_id',$orderMeta)) && ($orderMeta['booking_id']>0))
		{
			$bookingId=(int)$orderMeta['booking_id'];
			
			$Booking=new CHBSBooking();
			if(($booking=$Booking->getBooking($bookingId))!==false)
			{
				$data=array();
				
				$data['booking']=$booking;
				$data['booking']['billing']=$Booking->createBilling($bookingId);
		
				$Template=new CHBSTemplate($data,PLUGIN_CHBS_TEMPLATE_PATH.'public/woocommerce_view_order.php');
				echo $Template->output();			
			}
		}
	}
	
	/**************************************************************************/
}

/******************************************************************************/
/******************************************************************************/