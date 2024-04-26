<?php

/******************************************************************************/
/******************************************************************************/

class CHBSBookingFormElement
{
	/**************************************************************************/
	
	function __construct()
	{
		$this->fieldType=array
		(
			1=>array(__('Text','chauffeur-booking-system')),
			2=>array(__('Select list','chauffeur-booking-system')),
		);		
		
		$this->fieldLayout=array
		(
			1=>array(__('1/1','chauffeur-booking-system'),1,'chbs-form-field-width-100'),
			2=>array(__('1/2+1/2','chauffeur-booking-system'),2,'chbs-form-field-width-50'),
			3=>array(__('1/3+1/3+1/3','chauffeur-booking-system'),3,'chbs-form-field-width-33')
		);		
	}
	
	/**************************************************************************/
	
	function getFieldType()
	{
		return($this->fieldType);
	}
	
	/**************************************************************************/
	
	function isFieldType($fieldType)
	{
		return(array_key_exists($fieldType,$this->getFieldType()) ? true : false);
	}
	
	/**************************************************************************/
	
	function getFieldLayout()
	{
		return($this->fieldLayout);
	}
	
	/**************************************************************************/
	
	function isFieldLayout($fieldLayout)
	{
		return(array_key_exists($fieldLayout,$this->getFieldLayout()) ? true : false);
	}
	
	/**************************************************************************/
	
	function getFieldLayoutData($fieldLayout,$data=1)
	{
		if(!$this->isFieldLayout($fieldLayout)) return($this->fieldLayout[1][$data]);
		return($this->fieldLayout[$fieldLayout][$data]);
	}
	
	/**************************************************************************/
	   
	function save($bookingFormId)
	{
		/***/
		
		$formElementPanel=array();
		$formElementPanelPost=CHBSHelper::getPostValue('form_element_panel');
		
		if(isset($formElementPanelPost['id']))
		{
			$Validation=new CHBSValidation();
			
			foreach($formElementPanelPost['id'] as $index=>$value)
			{
				if($Validation->isEmpty($formElementPanelPost['label'][$index])) continue;
				
				if($Validation->isEmpty($value))
					$value=CHBSHelper::createId();
				
				$formElementPanel[]=array('id'=>$value,'label'=>$formElementPanelPost['label'][$index]);
			}
		}
		
		CHBSPostMeta::updatePostMeta($bookingFormId,'form_element_panel',$formElementPanel); 
		
		$meta=CHBSPostMeta::getPostMeta($bookingFormId);
		
		/***/
		
		$formElementField=array();
		$formElementFieldPost=CHBSHelper::getPostValue('form_element_field');	
		
		if(isset($formElementFieldPost['id']))
		{
			$Validation=new CHBSValidation();
			$ServiceType=new CHBSServiceType();
			
			$panelDictionary=$this->getPanel($meta);
			
			foreach($formElementFieldPost['id'] as $index=>$value)
			{
				if(!isset($formElementFieldPost['label'][$index],$formElementFieldPost['field_type'][$index],$formElementFieldPost['mandatory'][$index],$formElementFieldPost['dictionary'][$index],$formElementFieldPost['message_error'][$index],$formElementFieldPost['panel_id'][$index])) continue;
				
				if($Validation->isEmpty($formElementFieldPost['label'][$index])) continue;
				
				if(!$this->isFieldType($formElementFieldPost['field_type'][$index])) continue;
			
				if(!$Validation->isBool((int)$formElementFieldPost['mandatory'][$index])) continue;
				else
				{
					if((int)$formElementFieldPost['mandatory'][$index]===1)
					{	
						if($Validation->isEmpty($formElementFieldPost['message_error'][$index])) continue;
					}
				}
				
				if($formElementFieldPost['field_type'][$index]===2)
				{
					if($Validation->isEmpty($formElementFieldPost['dictionary'][$index])) continue;
				}
				
				if(!$this->isFieldLayout($formElementFieldPost['field_layout'][$index])) continue;
				
				if(!$this->isPanel($formElementFieldPost['panel_id'][$index],$panelDictionary)) continue;

				/***/
				
				$serviceTypeIdEnable=preg_split('/\./',$formElementFieldPost['service_type_id_enable_hidden'][$index]);
				if(is_array($serviceTypeIdEnable))
				{
					foreach($serviceTypeIdEnable as $index2=>$value2)
					{
						if(!$ServiceType->isServiceType($value2))
							unset($serviceTypeIdEnable[$index2]);
					}
				}
				
				if(!is_array($serviceTypeIdEnable)) $serviceTypeIdEnable=array();
				
				/***/
				
				$geofencePickup=preg_split('/\./',$formElementFieldPost['geofence_pickup_hidden'][$index]);
				if(is_array($geofencePickup))
				{
					if(in_array(-1,$geofencePickup)) $geofencePickup=array(-1);
				}
				
				if(!is_array($geofencePickup)) $geofencePickup=array(-1);
				
				/***/
				
				$geofenceDropoff=preg_split('/\./',$formElementFieldPost['geofence_dropoff_hidden'][$index]);
				if(is_array($geofenceDropoff))
				{
					if(in_array(-1,$geofenceDropoff)) $geofenceDropoff=array(-1);
				}
				
				if(!is_array($geofenceDropoff)) $geofenceDropoff=array(-1);
				
				/***/
				
				if($Validation->isEmpty($value))
					$value=CHBSHelper::createId();
				
				$formElementField[]=array('id'=>$value,'label'=>$formElementFieldPost['label'][$index],'field_type'=>$formElementFieldPost['field_type'][$index],'mandatory'=>$formElementFieldPost['mandatory'][$index],'dictionary'=>$formElementFieldPost['dictionary'][$index],'field_layout'=>$formElementFieldPost['field_layout'][$index],'message_error'=>$formElementFieldPost['message_error'][$index],'panel_id'=>$formElementFieldPost['panel_id'][$index],'service_type_id_enable'=>$serviceTypeIdEnable,'geofence_pickup'=>$geofencePickup,'geofence_dropoff'=>$geofenceDropoff);
			}
		}  
		
		CHBSPostMeta::updatePostMeta($bookingFormId,'form_element_field',$formElementField); 
		
		/***/
		
		$formElementAgreement=array();
		$formElementAgreementPost=CHBSHelper::getPostValue('form_element_agreement');		
		
		if(isset($formElementAgreementPost['id']))
		{
			$Validation=new CHBSValidation();
			
			foreach($formElementAgreementPost['id'] as $index=>$value)
			{
				if(!isset($formElementAgreementPost['text'][$index])) continue;
				if($Validation->isEmpty($formElementAgreementPost['text'][$index])) continue;
				if(!$Validation->isBool($formElementAgreementPost['mandatory'][$index])) continue;
				
				if($Validation->isEmpty($value))
					$value=CHBSHelper::createId();
				
				$formElementAgreement[]=array('id'=>$value,'text'=>$formElementAgreementPost['text'][$index],'mandatory'=>$formElementAgreementPost['mandatory'][$index]);
			}
		}		
		
		CHBSPostMeta::updatePostMeta($bookingFormId,'form_element_agreement',$formElementAgreement);		
	}
	
	/**************************************************************************/
	
	function getPanel($meta)
	{
		$panel=array
		(
			array
			(
				'id'=>1,
				'label'=>__('[Contact details]','chauffeur-booking-system')
			),
			array
			(
				'id'=>2,
				'label'=>__('[Billing address]','chauffeur-booking-system')				
			)
		);
			 
		if(isset($meta['form_element_panel']))
		{
			foreach($meta['form_element_panel'] as $value)
				$panel[]=$value;
		}
		
		return($panel);
	}

	/**************************************************************************/
	
	function isPanel($panelId,$panelDictionary)
	{
		foreach($panelDictionary as $value)
		{
			if($value['id']==$panelId) return(true);
		}
		
		return(false);
	}
	
	/**************************************************************************/
	
	function getFieldValueByLabel($label,$meta)
	{
		if(is_array($meta))
		{
			foreach($meta['form_element_field'] as $value)
			{
				if($value['label']==$label) return($value['value']);
			}
		}
		
		return(null);
	}
		
	/**************************************************************************/
	
	function createField($panelId,$serviceTypeId,$bookingForm)
	{
		$html=array(null,null);
		
		$Validation=new CHBSValidation();
		$GeofenceChecker=new CHBSGeofenceChecker();
		
		$data=CHBSHelper::getPostOption();
		
		if(!array_key_exists('form_element_field',$bookingForm['meta'])) return(null);
	
		$i=0;
		
		foreach($bookingForm['meta']['form_element_field'] as $value)
		{	
			if($value['panel_id']==$panelId)
			{
				if(array_key_exists('service_type_id_enable',$value))
				{
					if(is_array($value['service_type_id_enable']))
					{
						if(!in_array($serviceTypeId,$value['service_type_id_enable']))
							continue;
					}
				}
				
				$pickupLocation=$data['pickup_location_coordinate_service_type_'.$data['service_type_id']];
				if($GeofenceChecker->locationInGeofence($value['geofence_pickup'],$bookingForm['dictionary']['geofence'],$pickupLocation)===false) continue;
				
				$dropoffLocation=$data['dropoff_location_coordinate_service_type_'.$data['service_type_id']];
				if($GeofenceChecker->locationInGeofence($value['geofence_dropoff'],$bookingForm['dictionary']['geofence'],$dropoffLocation)===false) continue;
				
				$i++;
				
				$columnClass=$this->getFieldLayoutData($value['field_layout'],2);
				$columnNumber=(int)$this->getFieldLayoutData($value['field_layout'],1);
				
				if($i===1)
				{
					$html[1].='<div class="chbs-clear-fix">';
				}
				
				$name='form_element_field_'.$value['id'];
			 
				$html[1].=
				'
						<div class="chbs-form-field '.$columnClass.'">
							<label>'.esc_html($value['label']).((int)$value['mandatory']===1 ? ' *' : '').'</label>
				';
				
				if(($bookingForm['booking_edit']->isBookingEdit()) && (!array_key_exists($name,$data)))
				{
					$valueToSet=$bookingForm['booking_edit']->getBookingFormElementValue($value['id']);
				}
				else $valueToSet=CHBSHelper::getPostValue($name);

				if((int)$value['field_type']===2)
				{
					$fieldHtml=null;
					$fieldValue=preg_split('/;/',$value['dictionary']);

					foreach($fieldValue as $fieldValueValue)
					{
						if($Validation->isNotEmpty($fieldValueValue))
							$fieldHtml.='<option value="'.esc_attr($fieldValueValue).'"'.CHBSHelper::selectedIf($fieldValueValue,$valueToSet,false).'>'.esc_html($fieldValueValue).'</option>';
					}

					$html[1].=
					'
						<select name="'.CHBSHelper::getFormName($name,false).'">
							'.$fieldHtml.'
						</select>
					';	
				}
				else
				{
					$html[1].=
					'
						<input type="text" name="'.CHBSHelper::getFormName($name,false).'"  value="'.esc_attr($valueToSet).'"/>	
					';
				}
				
				$html[1].=
				'							
					</div>
				';	
				
				if($i===$columnNumber)
				{
					$html[1].='</div>';
					$i=0;
				}
			}
		}
		
		if(array_key_exists('form_element_panel',$bookingForm['meta']))
		{
			if(!in_array($panelId,array(1,2)))
			{
				foreach($bookingForm['meta']['form_element_panel'] as $value)
				{
					if($value['id']==$panelId)
					{
						$html[0].=
						'
							<div class="chbs-clear-fix">
								<label class="chbs-form-label-group">'.esc_html($value['label']).'</label> 
							</div>
						';
					}
				}
			}
		}
		
		return($html[0].$html[1]);
	}
	
	/**************************************************************************/
	
	function createAgreement($meta)
	{
		$html=null;
		$Validation=new CHBSValidation();
		
		if(!array_key_exists('form_element_agreement',$meta)) return($html);
		
		foreach($meta['form_element_agreement'] as $value)
		{
			$html.=
			'
				<div class="chbs-clear-fix">
					<span class="chbs-form-checkbox">
						<span class="chbs-meta-icon-tick"></span>
					</span>
					<input type="hidden" name="'.CHBSHelper::getFormName('form_element_agreement_'.$value['id'],false).'" value="0"/> 
					<div>'.$value['text'].'</div>
				</div>	  
			';
		}
		
		if($Validation->isNotEmpty($html))
		{
			$html=
			'
				<h4 class="chbs-agreement-header">'.esc_html__('Agreements','chauffeur-booking-system').'</h4>
				<div class="chbs-agreement">
					'.$html.'
				</div>
			';
		}
		
		return($html);
	}
	
	/**************************************************************************/
	
	function validateField($meta,$data)
	{
		$error=array();
		
		$Validation=new CHBSValidation();
		
		if(!array_key_exists('form_element_field',$meta)) return($error);
		
		foreach($meta['form_element_field'] as $value)
		{
			$name='form_element_field_'.$value['id'];
			
			if((int)$value['mandatory']===1)
			{
				if(array_key_exists($name,$data))
				{
					if(array_key_exists('service_type_id_enable',$value))
					{
						if(is_array($value['service_type_id_enable']))
						{
							if(!in_array($data['service_type_id'],$value['service_type_id_enable']))
								continue;
						}
					}
					
					if($value['panel_id']==2)
					{
						if((int)$data['client_billing_detail_enable']===1)
						{
							if($Validation->isEmpty($data[$name]))
								$error[]=array('name'=>CHBSHelper::getFormName($name,false),'message_error'=>$value['message_error']);							
						}
					}
					else
					{
						if($Validation->isEmpty($data[$name]))
							$error[]=array('name'=>CHBSHelper::getFormName($name,false),'message_error'=>$value['message_error']);
					}
				}
			}
		}
		
		return($error);
	}
	
	/**************************************************************************/
	
	function validateAgreement($meta,$data)
	{
		if(!array_key_exists('form_element_agreement',$meta)) return(false);
		
		foreach($meta['form_element_agreement'] as $value)
		{
			$name='form_element_agreement_'.$value['id'];  
			if((!array_key_exists('mandatory',$value)) || ((int)$value['mandatory']===1))
			{
				if((int)$data[$name]!==1) return(true);
			}
		}
		
		return(false);
	}
	
	/**************************************************************************/
	
	function sendBookingField($bookingId,$meta,$data)
	{
		if(!array_key_exists('form_element_field',$meta)) return;
		
		foreach($meta['form_element_field'] as $index=>$value)
		{
			$name='form_element_field_'.$value['id']; 
			$meta['form_element_field'][$index]['value']=$data[$name];
		}
		
		CHBSPostMeta::updatePostMeta($bookingId,'form_element_panel',$meta['form_element_panel']);
		CHBSPostMeta::updatePostMeta($bookingId,'form_element_field',$meta['form_element_field']);
	}
	
	/**************************************************************************/
	
	function sendBookingAgreement($bookingId,$meta,$data)
	{
		if(!array_key_exists('form_element_agreement',$meta)) return;
		
		foreach($meta['form_element_agreement'] as $index=>$value)
		{
			$name='form_element_agreement_'.$value['id']; 
			$meta['form_element_agreement'][$index]['value']=$data[$name];
			$meta['form_element_agreement'][$index]['text']=$value['text'];
		}
		
		CHBSPostMeta::updatePostMeta($bookingId,'form_element_agreement',$meta['form_element_agreement']);
	}
	
	/**************************************************************************/
	
	function displayField($panelId,$meta,$type=1,$argument=array(),$newLineChar='<br/>')
	{
		$html=null;
		
		if(!array_key_exists('form_element_field',$meta)) return($html);
		
		foreach($meta['form_element_field'] as $value)
		{
			if($value['panel_id']==$panelId)
			{
				if($type==1)
				{
					$html.=
					'
						<div>
							<span class="to-legend-field">'.esc_html($value['label']).'</span>
							<div class="to-field-disabled">'.esc_html($value['value']).'</div>								
						</div>	
					';
				}
				elseif($type==2)
				{
					$html.=
					'
						<tr>
							<td '.$argument['style']['cell'][1].'>'.esc_html($value['label']).'</td>
							<td '.$argument['style']['cell'][2].'>'.esc_html($value['value']).'</td>
						</tr>
					';					
				}
				elseif($type==3)
				{
					$html.=
					'
						<div>
							<div>'.esc_html($value['label']).'</div>
							<div>'.esc_html($value['value']).'</div>								
						</div>	
					';
				}
				elseif($type==4)
				{
					$html.='<b>'.esc_html($value['label']).':</b> '.esc_html($value['value']).$newLineChar;
				}
			}
		}
		
		return($html);
	}

	/**************************************************************************/
}

/******************************************************************************/
/******************************************************************************/