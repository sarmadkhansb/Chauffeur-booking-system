<?php 
		echo $this->data['nonce'];
		
		$Date=new CHBSDate();	
?>	
		<div class="to">
			<div class="ui-tabs">
				<ul>
					<li><a href="#meta-box-price-rule-1"><?php esc_html_e('General','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-2"><?php esc_html_e('Conditions','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-3"><?php esc_html_e('Options','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-4"><?php esc_html_e('Vehicles','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-5"><?php esc_html_e('Booking extras','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-6"><?php esc_html_e('Payments','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-7"><?php esc_html_e('Other','chauffeur-booking-system'); ?></a></li>
				</ul>
				<div id="meta-box-price-rule-1">
					<ul class="to-form-field-list">
						<?php echo CHBSHelper::createPostIdField(__('Availability rule ID','chauffeur-booking-system')); ?>
					</ul>
				</div>
				<div id="meta-box-price-rule-2">
					<ul class="to-form-field-list">
						<li>
							<h5><?php esc_html_e('Booking forms','chauffeur-booking-system'); ?></h5>
							<span class="to-legend"><?php esc_html_e('Select forms.','chauffeur-booking-system'); ?></span>
							<div class="to-checkbox-button">
								<input type="checkbox" value="-1" id="<?php CHBSHelper::getFormName('booking_form_id_0'); ?>" name="<?php CHBSHelper::getFormName('booking_form_id[]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['booking_form_id'],-1); ?>/>
								<label for="<?php CHBSHelper::getFormName('booking_form_id_0'); ?>"><?php esc_html_e('- All forms -','chauffeur-booking-system') ?></label>
<?php
		foreach($this->data['dictionary']['booking_form'] as $index=>$value)
		{
?>
								<input type="checkbox" value="<?php echo esc_attr($index); ?>" id="<?php CHBSHelper::getFormName('booking_form_id_'.$index); ?>" name="<?php CHBSHelper::getFormName('booking_form_id[]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['booking_form_id'],$index); ?>/>
								<label for="<?php CHBSHelper::getFormName('booking_form_id_'.$index); ?>"><?php echo esc_html($value['post']->post_title); ?></label>
<?php		
		}
?>
							</div>
						</li>
						<li>
							<h5><?php esc_html_e('Fixed pickup location','chauffeur-booking-system'); ?></h5>
							<span class="to-legend"><?php esc_html_e('Select pickup location.','chauffeur-booking-system'); ?></span>
							<div class="to-clear-fix">
								<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('location_fixed_pickup[]'); ?>">
									<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['location_fixed_pickup'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['location'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['location_fixed_pickup'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
								</select>  
							</div>
						</li>  
						<li>
							<h5><?php esc_html_e('Drop off location','chauffeur-booking-system'); ?></h5>
							<span class="to-legend"><?php esc_html_e('Select drop off location.','chauffeur-booking-system'); ?></span>
							<div class="to-clear-fix">
								<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('location_fixed_dropoff[]'); ?>">
									<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['location_fixed_dropoff'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['location'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['location_fixed_dropoff'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
								</select>  
							</div>
						</li>  	
					   <li>
							<h5><?php esc_html_e('Pickup geofence','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php esc_html_e('Geofence for pickup locations. This option works for customer locations only.','chauffeur-booking-system'); ?>
							</span>
							<div class="to-clear-fix">
								<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('location_geofence_pickup[]'); ?>">
									<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['location_geofence_pickup'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['geofence'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['location_geofence_pickup'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
								</select>  
							</div>
						</li>
						<li>
							<h5><?php esc_html_e('Drop off geofence','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php esc_html_e('Geofence for return locations. This option works for customer locations only.','chauffeur-booking-system'); ?>
							</span>
							<div class="to-clear-fix">
								<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('location_geofence_dropoff[]'); ?>">
									<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['location_geofence_dropoff'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['geofence'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['location_geofence_dropoff'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
								</select>  
							</div>
						</li>   
					</ul>
				</div>
				<div id="meta-box-price-rule-3">
					<ul class="to-form-field-list">
						<li>
							<h5><?php esc_html_e('Next rule processing','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php echo __('This option determine, whether availability will be set up based on this rule only or plugin has to processing next rule based on priority (order).','chauffeur-booking-system'); ?>
							</span>			   
							<div>
								<div class="to-radio-button">
									<input type="radio" value="1" id="<?php CHBSHelper::getFormName('process_next_rule_enable_1'); ?>" name="<?php CHBSHelper::getFormName('process_next_rule_enable'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['process_next_rule_enable'],1); ?>/>
									<label for="<?php CHBSHelper::getFormName('process_next_rule_enable_1'); ?>"><?php esc_html_e('Enable','chauffeur-booking-system'); ?></label>
									<input type="radio" value="0" id="<?php CHBSHelper::getFormName('process_next_rule_enable_0'); ?>" name="<?php CHBSHelper::getFormName('process_next_rule_enable'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['process_next_rule_enable'],0); ?>/>
									<label for="<?php CHBSHelper::getFormName('process_next_rule_enable_0'); ?>"><?php esc_html_e('Disable','chauffeur-booking-system'); ?></label>
								</div>  
							</div>							  
						</li>							
					</ul>
				</div>
				<div id="meta-box-price-rule-4">
					<ul class="to-form-field-list">
						<li>
							<h5><?php esc_html_e('Vehicles','chauffeur-booking-system'); ?></h5>
							<span class="to-legend"><?php esc_html_e('Select vehicles and its availability.','chauffeur-booking-system'); ?></span>
							<div>
								<table class="to-table to-table-price">
									<tr>
										<th style="width:50%">
											<div>
												<?php esc_html_e('Vehicle','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Vehicle.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>
										<th style="width:50%">
											<div>
												<?php esc_html_e('Availability','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Availability.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>
									</tr>
<?php
		foreach($this->data['dictionary']['vehicle'] as $index=>$value)
		{
?>									
									<tr>
										<td>
											<div>
												<?php echo esc_html($value['post']->post_title); ?>
											</div>
										</td>
										<td>
											<div class="to-radio-button">
												<input type="radio" value="-1" id="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability][-1]'); ?>" name="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['vehicle'][$index]['availability'],-1); ?>/>
												<label for="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability][-1]'); ?>"><?php esc_html_e('Not set','chauffeur-booking-system'); ?></label>
												<input type="radio" value="1" id="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability][1]'); ?>" name="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['vehicle'][$index]['availability'],1); ?>/>
												<label for="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability][1]'); ?>"><?php esc_html_e('Available','chauffeur-booking-system'); ?></label>
												<input type="radio" value="0" id="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability][0]'); ?>" name="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['vehicle'][$index]['availability'],0); ?>/>
												<label for="<?php CHBSHelper::getFormName('vehicle['.$index.'][availability][0]'); ?>"><?php esc_html_e('Unavailable','chauffeur-booking-system'); ?></label>
											</div>
										</td>
									</tr>
<?php
		}
?>
								</table>
							</div>
						</li>
					</ul>
				</div>
				<div id="meta-box-price-rule-5">
					<ul class="to-form-field-list">
						<li>
							<h5><?php esc_html_e('Booking extras','chauffeur-booking-system'); ?></h5>
							<span class="to-legend"><?php esc_html_e('Select booking extras and its availability.','chauffeur-booking-system'); ?></span>
							<div>
								<table class="to-table to-table-price">
									<tr>
										<th style="width:50%">
											<div>
												<?php esc_html_e('Booking extra','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Vehicle.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>
										<th style="width:50%">
											<div>
												<?php esc_html_e('Availability','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Availability.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>
									</tr>
<?php
		foreach($this->data['dictionary']['booking_extra'] as $index=>$value)
		{
?>									
									<tr>
										<td>
											<div>
												<?php echo esc_html($value['post']->post_title); ?>
											</div>
										</td>
										<td>
											<div class="to-radio-button">
												<input type="radio" value="-1" id="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability][-1]'); ?>" name="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['booking_extra'][$index]['availability'],-1); ?>/>
												<label for="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability][-1]'); ?>"><?php esc_html_e('Not set','chauffeur-booking-system'); ?></label>
												<input type="radio" value="1" id="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability][1]'); ?>" name="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['booking_extra'][$index]['availability'],1); ?>/>
												<label for="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability][1]'); ?>"><?php esc_html_e('Available','chauffeur-booking-system'); ?></label>
												<input type="radio" value="0" id="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability][0]'); ?>" name="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['booking_extra'][$index]['availability'],0); ?>/>
												<label for="<?php CHBSHelper::getFormName('booking_extra['.$index.'][availability][0]'); ?>"><?php esc_html_e('Unavailable','chauffeur-booking-system'); ?></label>
											</div>
										</td>
									</tr>
<?php
		}
?>
								</table>
							</div>
						</li>
					</ul>
				</div>
				<div id="meta-box-price-rule-6">
					<ul class="to-form-field-list">
						<li>
							<h5><?php esc_html_e('Payments','chauffeur-booking-system'); ?></h5>
							<span class="to-legend"><?php esc_html_e('Select payments and its availability.','chauffeur-booking-system'); ?></span>
							<div>
								<table class="to-table to-table-price">
									<tr>
										<th style="width:50%">
											<div>
												<?php esc_html_e('Payment','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Vehicle.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>
										<th style="width:50%">
											<div>
												<?php esc_html_e('Availability','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Availability.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>
									</tr>
<?php
		foreach($this->data['dictionary']['payment'] as $index=>$value)
		{
?>									
									<tr>
										<td>
											<div>
												<?php echo esc_html($value[0]); ?>
											</div>
										</td>
										<td>
											<div class="to-radio-button">
												<input type="radio" value="-1" id="<?php CHBSHelper::getFormName('payment['.$index.'][availability][-1]'); ?>" name="<?php CHBSHelper::getFormName('payment['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['payment'][$index]['availability'],-1); ?>/>
												<label for="<?php CHBSHelper::getFormName('payment['.$index.'][availability][-1]'); ?>"><?php esc_html_e('Not set','chauffeur-booking-system'); ?></label>
												<input type="radio" value="1" id="<?php CHBSHelper::getFormName('payment['.$index.'][availability][1]'); ?>" name="<?php CHBSHelper::getFormName('payment['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['payment'][$index]['availability'],1); ?>/>
												<label for="<?php CHBSHelper::getFormName('payment['.$index.'][availability][1]'); ?>"><?php esc_html_e('Available','chauffeur-booking-system'); ?></label>
												<input type="radio" value="0" id="<?php CHBSHelper::getFormName('payment['.$index.'][availability][0]'); ?>" name="<?php CHBSHelper::getFormName('payment['.$index.'][availability]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['payment'][$index]['availability'],0); ?>/>
												<label for="<?php CHBSHelper::getFormName('payment['.$index.'][availability][0]'); ?>"><?php esc_html_e('Unavailable','chauffeur-booking-system'); ?></label>
											</div>
										</td>
									</tr>
<?php
		}
?>
								</table>
							</div>
						</li>
					</ul>					
				</div>
				<div id="meta-box-price-rule-7">
					<ul class="to-form-field-list">
						<li>
							<h5><?php esc_html_e('Booking period','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php esc_html_e('Set range (in days, hours or minutes) during which customer can send a booking.','chauffeur-booking-system'); ?><br/>
								<?php esc_html_e('Eg. range 1-14 days means that customer can send a booking from tomorrow during next two weeks.','chauffeur-booking-system'); ?><br/>
								<?php esc_html_e('Allowed are integer values from range 0-9999. Empty values means that booking time is not limited.','chauffeur-booking-system'); ?><br/>
							</span>
							<div>
								<span class="to-legend-field"><?php esc_html_e('From (number of days/hours/minutes - counting from now - since when customer can send a booking):','chauffeur-booking-system'); ?></span>
								<input type="text" maxlength="4" name="<?php CHBSHelper::getFormName('booking_period_from'); ?>" value="<?php echo esc_attr($this->data['meta']['booking_period_from']); ?>"/>
							</div>   
							<div>
								<span class="to-legend-field"><?php esc_html_e('To (number of days/hours/minutes - counting from now plus number of days/hours/minutes from previous field - until when customer can send a booking):','chauffeur-booking-system'); ?></span>
								<input type="text" maxlength="4" name="<?php CHBSHelper::getFormName('booking_period_to'); ?>" value="<?php echo esc_attr($this->data['meta']['booking_period_to']); ?>"/>
							</div>  
							<div class="to-radio-button">
								<input type="radio" value="1" id="<?php CHBSHelper::getFormName('booking_period_type_1'); ?>" name="<?php CHBSHelper::getFormName('booking_period_type'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['booking_period_type'],1); ?>/>
								<label for="<?php CHBSHelper::getFormName('booking_period_type_1'); ?>"><?php esc_html_e('Days','chauffeur-booking-system'); ?></label>
								<input type="radio" value="2" id="<?php CHBSHelper::getFormName('booking_period_type_2'); ?>" name="<?php CHBSHelper::getFormName('booking_period_type'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['booking_period_type'],2); ?>/>
								<label for="<?php CHBSHelper::getFormName('booking_period_type_2'); ?>"><?php esc_html_e('Hours','chauffeur-booking-system'); ?></label>
								<input type="radio" value="3" id="<?php CHBSHelper::getFormName('booking_period_type_3'); ?>" name="<?php CHBSHelper::getFormName('booking_period_type'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['booking_period_type'],3); ?>/>
								<label for="<?php CHBSHelper::getFormName('booking_period_type_3'); ?>"><?php esc_html_e('Minutes','chauffeur-booking-system'); ?></label>
							</div>							
						</li> 
						<li>
							<h5><?php esc_html_e('Minimum order value','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php echo __('Define minimum (net) value of the order.','chauffeur-booking-system'); ?><br/>
								<?php echo __('If the order sum will be lower than defined, plugin displays an error messages.','chauffeur-booking-system'); ?>
							</span>			   
							<div>
								<span class="to-legend-field"><?php esc_html_e('Minimum order value:','chauffeur-booking-system'); ?></span>
								<input type="text" name="<?php CHBSHelper::getFormName('minimum_order_value'); ?>" value="<?php echo esc_attr($this->data['meta']['minimum_order_value']); ?>"/>
							</div>
							<div>
								<span class="to-legend-field"><?php esc_html_e('Error message:','chauffeur-booking-system'); ?></span>
								<input type="text" name="<?php CHBSHelper::getFormName('minimum_order_error_message'); ?>" value="<?php echo esc_attr($this->data['meta']['minimum_order_error_message']); ?>"/>
							</div>								
						</li> 
					</ul>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($)
			{	
				/***/
				
				$('.to').themeOptionElement({init:true});
				
				/***/
				
				$('input[name="<?php CHBSHelper::getFormName('booking_form_id'); ?>[]"]').on('change',function()
				{
					var checkbox=$(this).parents('li:first').find('input[type="checkbox"]');
					
					var value=parseInt($(this).val());
	
					if(value===-1)
					{
						checkbox.prop('checked',false);
						checkbox.first().prop('checked',true);
					}
					else checkbox.first().prop('checked',false);	
			
					var checked=[];
					checkbox.each(function()
					{
						if($(this).is(':checked'))
							checked.push(parseInt($(this).val(),10));
					});
					
					if(checked.length===0)
					{
						checkbox.prop('checked',false);
						checkbox.first().prop('checked',true);
					}
					
					checkbox.button('refresh');
				});
				
				/***/
			});
		</script>