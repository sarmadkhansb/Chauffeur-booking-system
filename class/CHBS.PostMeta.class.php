<?php

/******************************************************************************/
/******************************************************************************/

class CHBSPostMeta
{
	/**************************************************************************/
	
	static function getPostMeta($post)
	{
		$data=array();
		
		$prefix=PLUGIN_CHBS_CONTEXT.'_';
		
		if(!is_object($post)) $post=get_post($post);
		
		$meta=get_post_meta($post->ID);
		
		if(!is_array($meta)) $meta=array();
		
		foreach($meta as $metaIndex=>$metaData)
		{
			if(preg_match('/^'.$prefix.'/',$metaIndex))
				$data[preg_replace('/'.$prefix.'/',null,$metaIndex)]=$metaData[0];
		}
		
		switch($post->post_type)
		{
			case PLUGIN_CHBS_CONTEXT.'_route':
				
				self::unserialize($data,array('coordinate','vehicle','pickup_hour'));
	 
				$Route=new CHBSRoute();
				$Route->setPostMetaDefault($data);
				
			break;
			
			case PLUGIN_CHBS_CONTEXT.'_vehicle':
				
				self::unserialize($data,array('gallery_image_id','attribute','date_exclude','vehicle_availability_day_number'));
				
				$Vehicle=new CHBSVehicle();
				$Vehicle->setPostMetaDefault($data);
				
			break;
			
			case PLUGIN_CHBS_CONTEXT.'_vehicle_attr':
				
				self::unserialize($data,array('attribute_value'));

				$VehicleAttribute=new CHBSVehicleAttribute();
				$VehicleAttribute->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_vehicle_company':
				
				$VehicleCompany=new CHBSVehicleCompany();
				$VehicleCompany->setPostMetaDefault($data);
				
			break;
			
			case PLUGIN_CHBS_CONTEXT.'_booking_extra':
				
				self::unserialize($data,array('vehicle_id','service_type_id_enable','transfer_type_id_enable'));
				
				$BookingExtra=new CHBSBookingExtra();
				$BookingExtra->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_booking_form':
				
				self::unserialize($data,array('service_type_id','transfer_type_enable_1','transfer_type_enable_3','vehicle_category_id','vehicle_filter_enable','booking_extra_category_id','currency','route_id','business_hour','break_hour','location_fixed_pickup_service_type_1','location_fixed_dropoff_service_type_1','location_fixed_pickup_service_type_2','location_fixed_dropoff_service_type_2','driving_zone_restriction_pickup_location_country','driving_zone_restriction_waypoint_location_country','driving_zone_restriction_dropoff_location_country','date_exclude','payment_id','payment_stripe_method','google_map_route_avoid','style_color','form_element_panel','form_element_field','form_element_agreement','gratuity_customer_type','field_mandatory'));
				
				$BookingForm=new CHBSBookingForm();
				$BookingForm->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_booking':
				
				self::unserialize($data,array('booking_extra','coordinate','payment_stripe_data','payment_paypal_data','form_element_panel','form_element_field','form_element_agreement','booking_driver_log'));
  
				$Booking=new CHBSBooking();
				$Booking->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_location':
				
				self::unserialize($data,array('location_dropoff_disable_service_type_1','location_dropoff_disable_service_type_2'));
				
				$Location=new CHBSLocation();
				$Location->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_price_rule':
				
				self::unserialize($data,array('booking_form_id','service_type_id','transfer_type_id','route_id','vehicle_id','vehicle_company_id','location_fixed_pickup','location_fixed_dropoff','location_country_pickup','location_country_dropoff','location_geofence_pickup','location_geofence_dropoff','pickup_day_number','pickup_date','pickup_time','distance','distance_base_location','passenger','duration'));
				
				$PriceRule=new CHBSPriceRule();
				$PriceRule->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_av_rule':
				
				self::unserialize($data,array('booking_form_id','location_fixed_pickup','location_fixed_dropoff','location_geofence_pickup','location_geofence_dropoff','vehicle','booking_extra','payment'));
				
				$AVRule=new CHBSAVRule();
				$AVRule->setPostMetaDefault($data);
				
			break;
			   
			case PLUGIN_CHBS_CONTEXT.'_tax_rate':
				
				$TaxRate=new CHBSTaxRate();
				$TaxRate->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_email_account':
				
				$EmailAccount=new CHBSEmailAccount();
				$EmailAccount->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_driver':
				
				self::unserialize($data,array('notification_type','social_profile'));
				
				$Driver=new CHBSDriver();
				$Driver->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_coupon':
				
				self::unserialize($data,array('vehicle_id'));
				
				$Coupon=new CHBSCoupon();
				$Coupon->setPostMetaDefault($data);
				
			break;
		
			case PLUGIN_CHBS_CONTEXT.'_geofence':
				
				self::unserialize($data,array('shape_coordinate'));
				
				$Geofence=new CHBSGeofence();
				$Geofence->setPostMetaDefault($data);
				
			break;
		
		}
		
		return($data);
	}
	
	/**************************************************************************/
	
	static function unserialize(&$data,$unserializeIndex)
	{
		foreach($unserializeIndex as $index)
		{
			if(isset($data[$index]))
				$data[$index]=maybe_unserialize($data[$index]);
		}
	}
	
	/**************************************************************************/
	
	static function updatePostMeta($post,$name,$value)
	{
		$name=PLUGIN_CHBS_CONTEXT.'_'.$name;
		$postId=(int)(is_object($post) ? $post->ID : $post);
		
		update_post_meta($postId,$name,$value);
	}
	
	/**************************************************************************/
	
	static function removePostMeta($post,$name)
	{
		$name=PLUGIN_CHBS_CONTEXT.'_'.$name;
		$postId=(int)(is_object($post) ? $post->ID : $post);
		
		delete_post_meta($postId,$name);
	}
		
	/**************************************************************************/
	
	static function createArray(&$array,$index)
	{
		$array=array($index=>array());
		return($array);
	}

	/**************************************************************************/
}

/******************************************************************************/
/******************************************************************************/