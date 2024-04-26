<?php

/******************************************************************************/
/******************************************************************************/

class CHBSBookingHelper
{
	/**************************************************************************/
	
	static function getPaymentName($paymentId,$wooCommerceEnable=-1,$meta=array())
	{
		$Payment=new CHBSPayment();
		$WooCommerce=new CHBSWooCommerce();
		
		if($wooCommerceEnable===-1)
			$wooCommerceEnable=$WooCommerce->isEnable($meta);
		
		if($wooCommerceEnable)
		{
			$paymentName=$WooCommerce->getPaymentName($paymentId);
		}
		else
		{
			$paymentName=$Payment->getPaymentName($paymentId);
		}
		
		return($paymentName);
	}
		
	/**************************************************************************/
	
	static function isPayment(&$paymentId,$meta,$step=-1)
	{
		$Payment=new CHBSPayment();
		$WooCommerce=new CHBSWooCommerce();
		
		if((int)$meta['price_hide']===1)
		{
			$paymentId=0;
			return(true);
		}
		
		if(($step===3) && ($WooCommerce->isEnable($meta)) && ((int)$meta['payment_woocommerce_step_3_enable']===0))
		{
			return(true);
		}
		
		if((int)$meta['payment_mandatory_enable']===0)
		{
			if($WooCommerce->isEnable($meta))
			{
				if((empty($paymentId)) || ((int)$paymentId===-1))
				{
					$paymentId=0;
					return(true);
				}
			}
			else
			{
				if($paymentId==-1)
				{
					$paymentId=0;
					return(true);
				}
			}
		}
		
		if($WooCommerce->isEnable($meta))
		{
			return($WooCommerce->isPayment($paymentId));
		}
		else
		{
			if(!$Payment->isPayment($paymentId)) return(false);
		}
		
		return(true);
	}
	
	/**************************************************************************/
	
	static function isPaymentDepositEnable($meta,$bookingId=-1)
	{
		if((int)$meta['price_hide']===1)
		{
			return(0);
		}
		
		if($bookingId==-1)
		{
			$WooCommerce=new CHBSWooCommerce();
			if($WooCommerce->isEnable($meta)) return(0);
		}
		
		return((int)$meta['payment_deposit_enable']);
	}

	/**************************************************************************/
	
	static function isPassengerEnable($meta,$serviceType=1,$passengerType='adult')
	{
		if((int)$passengerType===-1)
		{
			return($meta['passenger_adult_enable_service_type_'.$serviceType] && $meta['passenger_children_enable_service_type_'.$serviceType]);
		}
		
		return($meta['passenger_'.$passengerType.'_enable_service_type_'.$serviceType]);
	}
	
	/**************************************************************************/
	
	static function getPassenegerSum($meta,$data)
	{
		$sum=0;
		
		if(CHBSBookingHelper::isPassengerEnable($meta,$data['service_type_id'],'adult'))
			$sum+=(int)$data['passenger_adult_service_type_'.$data['service_type_id']];
			
		if(CHBSBookingHelper::isPassengerEnable($meta,$data['service_type_id'],'children'))
			$sum+=(int)$data['passenger_children_service_type_'.$data['service_type_id']];			
		
		return($sum);
	}
	
	/**************************************************************************/
	
	static function getPassengerLabel($numberAdult,$numberChildren,$type=1,$usePersonLabel=0)
	{
		$html=null;
		
		$Validation=new CHBSValidation();
		
		if($type===1)
		{
			if(($numberAdult>0) && ($numberChildren==0))
			{
				if((int)$usePersonLabel===1)
					$html=sprintf(__('%s persons','chauffeur-booking-system'),$numberAdult);
				else $html=sprintf(__('%s passengers','chauffeur-booking-system'),$numberAdult);
			
			}	
			else
			{
				if($numberAdult>0)
				{
					if((int)$usePersonLabel===1)
						$html=sprintf(__('%s persons','chauffeur-booking-system'),$numberAdult);
					else $html=sprintf(__('%s adults','chauffeur-booking-system'),$numberAdult);
				}
				
				if($numberChildren>0)
				{
					if($Validation->isNotEmpty($html)) $html.=', ';
					$html.=sprintf(__('%s children','chauffeur-booking-system'),$numberChildren);
				}
			}
		}
		
		return($html);
	}
	
	/**************************************************************************/
	
	static function getBaseLocationDistance($vehicleId,$return=false,$global=true)
	{
		$Validation=new CHBSValidation();
		
		$distance='';
		
		$option=CHBSHelper::getPostOption();
		
		$index=(!$return ? 'base_location_vehicle_distance' : 'base_location_vehicle_return_distance');
		
		if(array_key_exists($index,$option))
		{
			if(isset($option[$index][$vehicleId]))
				$distance=$option[$index][$vehicleId];
		}
	
		if($global)
		{
			if($Validation->isEmpty($distance))
			{
				$index=(!$return ? 'base_location_distance' : 'base_location_return_distance');
				return($option[$index]);
			}
		}
				
		return($distance);
	}
	
	/**************************************************************************/
	
	static function getPriceType($bookingForm,&$priceType,&$sumType,&$taxShow,$step)
	{
		$taxShow=true;
		$sumType='gross';
		$priceType='gross';
		
		/***/
		
		if((int)$bookingForm['meta']['show_net_price_hide_tax']===1)
		{
			if((int)$step!==4)
			{
				$taxShow=false;
				$sumType='net';
				$priceType='net';
			}
		}
		
		/***/
		
		if((int)$bookingForm['meta']['order_sum_split']===1)
		{
			$priceType='net';
		}
	}
	
	/**************************************************************************/
	
	static function getRoundValue($bookingForm,$price)
	{
		$roundValue=0.00;
		
		if($bookingForm['meta']['vehicle_price_round']>0.00)
		{
			$price=number_format($price,2,'.','');
			
			$roundPrice=ceil($price/$bookingForm['meta']['vehicle_price_round'])*$bookingForm['meta']['vehicle_price_round'];
			
			if($roundPrice>=$price) 
			{
				$roundValue=$roundPrice-$price;
				
				if($roundPrice-$bookingForm['meta']['vehicle_price_round']==$price)
				{
					$roundValue=0.00;
				}
			}
		}
		
		return($roundValue);
	}
	
	/**************************************************************************/
	
	static function isVehicleBidPriceEnable($bookingForm)
	{
		return(((int)$bookingForm['meta']['booking_summary_hide_fee']===1) && ((int)$bookingForm['meta']['vehicle_bid_enable']===1));
	}
	
	/**************************************************************************/
	
	function createNotification($data,$newLineChar='<br/>')
	{
		$html=null;
		
		$this->newLineChar=$newLineChar;
		
		/***/
		
		$Date=new CHBSDate();
		$Length=new CHBSLength();
		$Validation=new CHBSValidation();
		$BookingFormElement=new CHBSBookingFormElement();
		
		/***/
		
		$html.=$this->addNotificationHeader(__('General','chauffeur-booking-system'),false);
		
		$html.=$this->addNotificationLine(__('Title','chauffeur-booking-system'),$data['booking']['post']->post_title);

		if(array_key_exists('booking_form_name',$data['booking']))
			$html.=$this->addNotificationLine(__('Booking form name','chauffeur-booking-system'),$data['booking']['booking_form_name']);
		
		$html.=$this->addNotificationLine(__('Status','chauffeur-booking-system'),$data['booking']['booking_status_name']);
		$html.=$this->addNotificationLine(__('Service type','chauffeur-booking-system'),$data['booking']['service_type_name']);
		$html.=$this->addNotificationLine(__('Transfer type','chauffeur-booking-system'),$data['booking']['transfer_type_name']);
		$html.=$this->addNotificationLine(__('Pickup date and time','chauffeur-booking-system'),$Date->formatDateToDisplay($data['booking']['meta']['pickup_date']).' '.$Date->formatTimeToDisplay($data['booking']['meta']['pickup_time']));
		
		if(in_array($data['booking']['meta']['service_type_id'],array(1,3)))
		{
			if((int)$data['booking']['meta']['transfer_type_id']===3)
				$html.=$this->addNotificationLine(__('Return date and time','chauffeur-booking-system'),$Date->formatDateToDisplay($data['booking']['meta']['return_date']).' '.$Date->formatTimeToDisplay($data['booking']['meta']['return_time']));
		}
	
		if((int)$data['booking']['meta']['price_hide']===0)
		{
			$html.=$this->addNotificationLine(__('Order total amount','chauffeur-booking-system'),html_entity_decode(CHBSPrice::format($data['booking']['billing']['summary']['value_gross'],$data['booking']['meta']['currency_id'])));
		
			$htmlTax=null;
			foreach($data['booking']['billing']['tax_group'] as $value)
			{
				if(!$Validation->isEmpty($htmlTax)) $htmlTax.=', ';
				$htmlTax.=html_entity_decode(CHBSPrice::format($value['value'],$data['booking']['meta']['currency_id'])).' ('.$value['tax_value'].'%)';
			}	
			$html.=$this->addNotificationLine(__('Taxes','chauffeur-booking-system'),$htmlTax,array(true,false));
			
			if($data['booking']['meta']['payment_deposit_enable']==1)
				$html.=$this->addNotificationLine(sprintf(esc_html('To pay (deposit %s%%)','chauffeur-booking-system'),$data['booking']['meta']['payment_deposit_value']),html_entity_decode(CHBSPrice::format($data['booking']['billing']['summary']['pay'],$data['booking']['meta']['currency_id'])));
		}
		
		if(in_array($data['booking']['meta']['service_type_id'],array(1,3)))
			$html.=$this->addNotificationLine(__('Distance','chauffeur-booking-system'),$data['booking']['billing']['summary']['distance_s2'].$Length->getUnitShortName($data['booking']['meta']['length_unit']));
						
		$html.=$this->addNotificationLine(__('Duration','chauffeur-booking-system'),$data['booking']['billing']['summary']['duration_s2']);	
			
		if($data['booking']['meta']['passenger_enable']==1)
			$html.=$this->addNotificationLine(__('Passengers','chauffeur-booking-system'),CHBSBookingHelper::getPassengerLabel($data['booking']['meta']['passenger_adult_number'],$data['booking']['meta']['passenger_children_number'],1,$data['booking']['meta']['passenger_use_person_label']));
			
		if($Validation->isNotEmpty($data['booking']['meta']['comment']))
			$html.=$this->addNotificationLine(__('Comments','chauffeur-booking-system'),$data['booking']['meta']['comment']);
			
		/***/
		
		if(((int)$data['booking']['meta']['service_type_id']===3) || (((int)$data['booking']['meta']['service_type_id']===3) && ((int)$data['booking']['meta']['extra_time_enable']===1)))
		{
			$html.=$this->addNotificationHeader(__('Route','chauffeur-booking-system'));
			
			$html.=$this->addNotificationLine(__('Route name','chauffeur-booking-system'),$data['booking']['meta']['route_name']);
			
			if(in_array($data['booking']['meta']['service_type_id'],array(1,3)))
			{
				if((int)$data['booking']['meta']['extra_time_enable']===1)
					$html.=$this->addNotificationLine(__('Extra time','chauffeur-booking-system'),$Date->formatMinuteToTime($data['booking']['meta']['extra_time_value']));
			}
		}
		
		/***/
		
		$i=0;
		$html.=$this->addNotificationHeader(__('Route locations','chauffeur-booking-system'));
		
		foreach($data['booking']['meta']['coordinate'] as $value)
		{	
			$html.=$this->addNotificationLine((++$i),'<a href="https://www.google.com/maps/?q='.esc_attr($value['lat']).','.esc_attr($value['lng']).'" target="_blank">'.esc_html(CHBSHelper::getFormattedAddress($value)).'</a>',array(true,false));
		}
		
		/***/
		
		$html.=$this->addNotificationHeader(__('Vehicle','chauffeur-booking-system'));
		
		$html.=$this->addNotificationLine(__('Vehicle name','chauffeur-booking-system'),$data['booking']['meta']['vehicle_name']);
		
		if(array_key_exists('vehicle_bag_count',$data['booking']))
			$html.=$this->addNotificationLine(__('Bag count','chauffeur-booking-system'),$data['booking']['vehicle_bag_count']);
		
		if(array_key_exists('vehicle_passenger_count',$data['booking']))
			$html.=$this->addNotificationLine(__('Passengers count','chauffeur-booking-system'),$data['booking']['vehicle_passenger_count']);
		
		/***/
		
		if(count($data['booking']['meta']['booking_extra']))
		{
			$i=0;
			$html.=$this->addNotificationHeader(__('Booking extras','chauffeur-booking-system'));
			
			foreach($data['booking']['meta']['booking_extra'] as $value)
			{
				$htmlPrice=null;
				if((int)$data['booking']['meta']['price_hide']===0)
					$htmlPrice=' - '.CHBSPrice::format(CHBSPrice::calculateGross($value['price'],0,$value['tax_rate_value'])*$value['quantity'],$data['booking']['meta']['currency_id']);
				
				$html.=$this->addNotificationLine((++$i),esc_html($value['quantity']).esc_html(' x ','chauffeur-booking-system').esc_html($value['name']).$htmlPrice,array(true,false));
			}
		}
		
		/***/
		
		$html.=$this->addNotificationHeader(__('Client details','chauffeur-booking-system'));
		$html.=$this->addNotificationLine(__('First name','chauffeur-booking-system'),$data['booking']['meta']['client_contact_detail_first_name']);
		$html.=$this->addNotificationLine(__('Last name','chauffeur-booking-system'),$data['booking']['meta']['client_contact_detail_last_name']);
		$html.=$this->addNotificationLine(__('E-mail address','chauffeur-booking-system'),$data['booking']['meta']['client_contact_detail_email_address']);
		$html.=$this->addNotificationLine(__('Phone number','chauffeur-booking-system'),$data['booking']['meta']['client_contact_detail_phone_number']);
		$html.=$BookingFormElement->displayField(1,$data['booking']['meta'],4);
		
		/***/
		
		if((int)$data['booking']['meta']['client_billing_detail_enable']===1)
		{
			$html.=$this->addNotificationHeader(__('Billing address','chauffeur-booking-system'));
			$html.=$this->addNotificationLine(__('Company name','chauffeur-booking-system'),$data['booking']['meta']['client_billing_detail_company_name']);
			$html.=$this->addNotificationLine(__('Tax number','chauffeur-booking-system'),$data['booking']['meta']['client_billing_detail_tax_number']);
			$html.=$this->addNotificationLine(__('Street name','chauffeur-booking-system'),$data['booking']['meta']['client_billing_detail_street_name']);
			$html.=$this->addNotificationLine(__('Street number','chauffeur-booking-system'),$data['booking']['meta']['client_billing_detail_street_number']);
			$html.=$this->addNotificationLine(__('City','chauffeur-booking-system'),$data['booking']['meta']['client_billing_detail_city']);
			$html.=$this->addNotificationLine(__('State','chauffeur-booking-system'),$data['booking']['meta']['client_billing_detail_state']);
			$html.=$this->addNotificationLine(__('Postal code','chauffeur-booking-system'),$data['booking']['meta']['client_billing_detail_postal_code']);
			$html.=$this->addNotificationLine(__('Country','chauffeur-booking-system'),$data['booking']['meta']['client_billing_detail_country_name']);
			$html.=$BookingFormElement->displayField(2,$data['booking']['meta'],4);
		}
		
		/***/

		$panel=$BookingFormElement->getPanel($data['booking']['meta']);
	
		foreach($panel as $panelValue)
		{
			if(in_array($panelValue['id'],array(1,2))) continue;

			$html.=$this->addNotificationHeader($panelValue['label']);
			$html.=$BookingFormElement->displayField($panelValue['id'],$data['booking']['meta'],4,array(),$newLineChar);
		}
	
		/***/
	
		if((array_key_exists('form_element_agreement',$data['booking']['meta'])) && (is_array($data['booking']['meta']['form_element_agreement'])) && (count($data['booking']['meta']['form_element_agreement'])))
		{
			$i=0;
			
			$html.=$this->addNotificationHeader(__('Agreements','chauffeur-booking-system'));
			
			foreach($data['booking']['meta']['form_element_agreement'] as $value)
				$html.=$this->addNotificationLine((++$i),((int)$value['value']===1 ? __('[YES]','chauffeur-booking-system') : __('[NO]','chauffeur-booking-system')).' '.$value['text'],array(true,false));
		}
	
		/***/

		if(!empty($data['booking']['meta']['payment_id']))
		{
			$html.=$this->addNotificationHeader(__('Payment','chauffeur-booking-system'));
			$html.=$this->addNotificationLine(__('Name','chauffeur-booking-system'),$data['booking']['payment_name']);
		}
		
		if((array_key_exists('booking_driver_accept_link',$data)) && (array_key_exists('booking_driver_reject_link',$data)))
		{
			$html.=$this->addNotificationHeader(__('Accept booking','chauffeur-booking-system'));
			$html.=$this->addNotificationLine('Accept','<a href="'.urlencode($data['booking_driver_accept_link']).'" target="_blank">'.esc_html__('Click to accept this booking','chauffeur-booking-system').'</a>',array(true,false));			
	
			$html.=$this->addNotificationHeader(__('Reject booking','chauffeur-booking-system'));
			$html.=$this->addNotificationLine('Reject','<a href="'.urlencode($data['booking_driver_reject_link']).'" target="_blank">'.esc_html__('Click to reject this booking','chauffeur-booking-system').'</a>',array(true,false));			
		}
	
		/***/
		
		return($html);	
	}
	
	/**************************************************************************/
	
	function addNotificationLine($label,$value,$format=array(true,true))
	{
		$html='<b>'.($format[0] ? esc_html($label) : $label).':</b> '.($format[1] ? esc_html($value) : $value).$this->newLineChar;
		return($html);
	}
	
	/**************************************************************************/
	
	function addNotificationHeader($header,$addNotificationLineBefore=true)
	{
		$html.=$addNotificationLineBefore ? $this->newLineChar : '';
		$html.='<u>'.esc_html($header).'</u>'.$this->newLineChar;
		return($html);
	}
	
	/**************************************************************************/
}

/******************************************************************************/
/******************************************************************************/