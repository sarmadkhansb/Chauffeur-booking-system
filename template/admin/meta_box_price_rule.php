<?php 
		echo $this->data['nonce'];
		
		$Date=new CHBSDate();
		$Length=new CHBSLength();
?>	
		<div class="to">
			<div class="ui-tabs">
				<ul>
					<li><a href="#meta-box-price-rule-1"><?php esc_html_e('General','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-2"><?php esc_html_e('Conditions','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-3"><?php esc_html_e('Prices','chauffeur-booking-system'); ?></a></li>
					<li><a href="#meta-box-price-rule-4"><?php esc_html_e('Options','chauffeur-booking-system'); ?></a></li>
				</ul>
				<div id="meta-box-price-rule-1">
					<ul class="to-form-field-list">
						<?php echo CHBSHelper::createPostIdField(__('Pricing rule ID','chauffeur-booking-system')); ?>
					</ul>
				</div>
				<div id="meta-box-price-rule-2">
					<div class="ui-tabs">
						<ul>
							<li><a href="#meta-box-price-rule-2-1"><?php esc_html_e('General','chauffeur-booking-system'); ?></a></li>
							<li><a href="#meta-box-price-rule-2-2"><?php esc_html_e('Vehicles','chauffeur-booking-system'); ?></a></li>
							<li><a href="#meta-box-price-rule-2-3"><?php esc_html_e('Locations','chauffeur-booking-system'); ?></a></li>
							<li><a href="#meta-box-price-rule-2-4"><?php esc_html_e('Date & time','chauffeur-booking-system'); ?></a></li>
							<li><a href="#meta-box-price-rule-2-5"><?php esc_html_e('Distance','chauffeur-booking-system'); ?></a></li>
							<li><a href="#meta-box-price-rule-2-6"><?php esc_html_e('Duration','chauffeur-booking-system'); ?></a></li>
							<li><a href="#meta-box-price-rule-2-7"><?php esc_html_e('Passengers','chauffeur-booking-system'); ?></a></li>
						</ul>	
						<div id="meta-box-price-rule-2-1">
							<ul class="to-form-field-list">
								<li>
									<h5><?php esc_html_e('Service types','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select service types.','chauffeur-booking-system'); ?></span>
									<div class="to-checkbox-button">
										<input type="checkbox" value="-1" id="<?php CHBSHelper::getFormName('service_type_id_0'); ?>" name="<?php CHBSHelper::getFormName('service_type_id[]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['service_type_id'],-1); ?>/>
										<label for="<?php CHBSHelper::getFormName('service_type_id_0'); ?>"><?php esc_html_e('- None -','chauffeur-booking-system') ?></label>
<?php
		foreach($this->data['dictionary']['service_type'] as $index=>$value)
		{
?>
										<input type="checkbox" value="<?php echo esc_attr($index); ?>" id="<?php CHBSHelper::getFormName('service_type_id_'.$index); ?>" name="<?php CHBSHelper::getFormName('service_type_id[]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['service_type_id'],$index); ?>/>
										<label for="<?php CHBSHelper::getFormName('service_type_id_'.$index); ?>"><?php echo esc_html($value[0]); ?></label>
<?php		
		}
?>
									</div>
								</li>  
								<li>
									<h5><?php esc_html_e('Transfer types','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select transfer types.','chauffeur-booking-system'); ?></span>
									<div class="to-checkbox-button">
										<input type="checkbox" value="-1" id="<?php CHBSHelper::getFormName('transfer_type_id_0'); ?>" name="<?php CHBSHelper::getFormName('transfer_type_id[]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['transfer_type_id'],-1); ?>/>
										<label for="<?php CHBSHelper::getFormName('transfer_type_id_0'); ?>"><?php esc_html_e('- None -','chauffeur-booking-system') ?></label>
<?php
		foreach($this->data['dictionary']['transfer_type'] as $index=>$value)
		{
?>
										<input type="checkbox" value="<?php echo esc_attr($index); ?>" id="<?php CHBSHelper::getFormName('transfer_type_id_'.$index); ?>" name="<?php CHBSHelper::getFormName('transfer_type_id[]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['transfer_type_id'],$index); ?>/>
										<label for="<?php CHBSHelper::getFormName('transfer_type_id_'.$index); ?>"><?php echo esc_html($value[0]); ?></label>
<?php		
		}
?>
									</div>
								</li> 
								<li>
									<h5><?php esc_html_e('Booking forms','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select booking forms.','chauffeur-booking-system'); ?></span>
									<div class="to-clear-fix">
										<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('booking_form_id[]'); ?>">
											<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['booking_form_id'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['booking_form'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['booking_form_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
										</select>  
									</div>
								</li>
								<li>
									<h5><?php esc_html_e('Routes','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select routes. This option works only for the "Flat rate" service type.','chauffeur-booking-system'); ?></span>
									<div class="to-clear-fix">
										<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('route_id[]'); ?>">
											<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['route_id'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['route'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['route_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
										</select>  
									</div>									
								</li>
							</ul>
						</div>
						<div id="meta-box-price-rule-2-2">
							<ul class="to-form-field-list">
								<li>
									<h5><?php esc_html_e('Vehicles','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select vehicles.','chauffeur-booking-system'); ?></span>
									<div class="to-clear-fix">
										<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('vehicle_id[]'); ?>">
											<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['vehicle_id'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['vehicle'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['vehicle_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
										</select>  
									</div>
								</li>
								<li>
									<h5><?php esc_html_e('Vehicle companies','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select owners of the vehicle.','chauffeur-booking-system'); ?></span>
									<div class="to-clear-fix">
										<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('vehicle_company_id[]'); ?>">
											<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['vehicle_company_id'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['vehicle_company'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['vehicle_company_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
										</select>  
									</div>									
								</li>
							</ul>
						</div>
						<div id="meta-box-price-rule-2-3">
							<ul class="to-form-field-list">
								<li>
									<h5><?php esc_html_e('Fixed pickup location','chauffeur-booking-system'); ?></h5>
									<span class="to-legend">
										<?php esc_html_e('Select fixed pickup location.','chauffeur-booking-system'); ?><br/>
										<?php esc_html_e('This option is available if the fixed locations are enabled in the booking form.','chauffeur-booking-system'); ?>
									</span>
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
									<h5><?php esc_html_e('Fixed drop-off location','chauffeur-booking-system'); ?></h5>
									<span class="to-legend">
										<?php esc_html_e('Select fixed drop-off location.','chauffeur-booking-system'); ?><br/>
										<?php esc_html_e('This option is available if the fixed locations are enabled in the booking form.','chauffeur-booking-system'); ?>
									</span>
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
									<h5><?php esc_html_e('Pickup country location','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select country of pickup location.','chauffeur-booking-system'); ?></span>
									<div class="to-clear-fix">
										<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('location_country_pickup[]'); ?>">
											<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['location_country_pickup'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['country'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['location_country_pickup'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
										</select>  
									</div>
								</li> 
								<li>
									<h5><?php esc_html_e('Drop-off country location','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select country of drop-off location.','chauffeur-booking-system'); ?></span>
									<div class="to-clear-fix">
										<select multiple="multiple" class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('location_country_dropoff[]'); ?>">
											<option value="-1" <?php CHBSHelper::selectedIf($this->data['meta']['location_country_dropoff'],-1); ?>><?php esc_html_e('- None -','chauffeur-booking-system'); ?></option>
<?php
		foreach($this->data['dictionary']['country'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['location_country_dropoff'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
										</select>  
									</div>
								</li> 
								<li>
									<h5><?php esc_html_e('Pickup geofence','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Geofence for pickup locations.','chauffeur-booking-system'); ?></span>
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
									<span class="to-legend"><?php esc_html_e('Geofence for drop off locations.','chauffeur-booking-system'); ?></span>
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
								<li>
									<h5><?php esc_html_e('Pickup ZIP codes','chauffeur-booking-system'); ?></h5>
									<span class="to-legend">
										<?php echo __('ZIP codes of pickup locations separated by semicolon.','chauffeur-booking-system'); ?>
									</span>			   
									<div>
										<div>
											<input type="text" name="<?php CHBSHelper::getFormName('location_zip_code_pickup'); ?>" value="<?php echo esc_attr($this->data['meta']['location_zip_code_pickup']); ?>"/>
										</div>
									</div>							  
								</li> 						
								<li>
									<h5><?php esc_html_e('Drop off ZIP codes','chauffeur-booking-system'); ?></h5>
									<span class="to-legend">
										<?php echo __('ZIP codes of drop off locations separated by semicolon.','chauffeur-booking-system'); ?>
									</span>			   
									<div>
										<div>
											<input type="text" name="<?php CHBSHelper::getFormName('location_zip_code_dropoff'); ?>" value="<?php echo esc_attr($this->data['meta']['location_zip_code_dropoff']); ?>"/>
										</div>
									</div>							  
								</li>
							</ul>
						</div>
						<div id="meta-box-price-rule-2-4">
							<ul class="to-form-field-list">
								<li>
									<h5><?php esc_html_e('Day number','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Select pickup day of the week.','chauffeur-booking-system'); ?></span>
									<div class="to-checkbox-button">
										<input type="checkbox" value="-1" id="<?php CHBSHelper::getFormName('pickup_day_number_0'); ?>" name="<?php CHBSHelper::getFormName('pickup_day_number[]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['pickup_day_number'],-1); ?>/>
										<label for="<?php CHBSHelper::getFormName('pickup_day_number_0'); ?>"><?php esc_html_e('- All days -','chauffeur-booking-system') ?></label>
<?php
		for($i=1;$i<=7;$i++)
		{
?>
										<input type="checkbox" value="<?php echo esc_attr($i); ?>" id="<?php CHBSHelper::getFormName('pickup_day_number_'.$i); ?>" name="<?php CHBSHelper::getFormName('pickup_day_number[]'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['pickup_day_number'],$i); ?>/>
										<label for="<?php CHBSHelper::getFormName('pickup_day_number_'.$i); ?>"><?php echo esc_html(date_i18n('l',strtotime('Sunday +'.$i.' days'))); ?></label>
<?php
		}
?>								
									</div>						
								</li>
								<li>
									<h5><?php esc_html_e('Dates','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Enter pickup dates.','chauffeur-booking-system'); ?></span>
									<div>
										<table class="to-table" id="to-table-date">
											<tr>
												<th style="width:40%">
													<div>
														<?php esc_html_e('From','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('From.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:40%">
													<div>
														<?php esc_html_e('To','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('To.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												</th>
												<th style="width:20%">
													<div>
														<?php esc_html_e('Remove','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Remove this entry.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>											
											</tr>
											<tr class="to-hidden">
												<td>
													<div>
														<input type="text" class="to-datepicker-custom" name="<?php CHBSHelper::getFormName('pickup_date[start][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" class="to-datepicker-custom" name="<?php CHBSHelper::getFormName('pickup_date[stop][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>
											</tr>						 
<?php
		if(isset($this->data['meta']['pickup_date']))
		{
			if(is_array($this->data['meta']['pickup_date']))
			{
				foreach($this->data['meta']['pickup_date'] as $index=>$value)
				{
?>
											<tr>
												<td>
													<div>
														<input type="text" class="to-datepicker-custom" name="<?php CHBSHelper::getFormName('pickup_date[start][]'); ?>" value="<?php echo esc_attr($Date->formatDateToDisplay($value['start'])); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" class="to-datepicker-custom" name="<?php CHBSHelper::getFormName('pickup_date[stop][]'); ?>" value="<?php echo esc_attr($Date->formatDateToDisplay($value['stop'])); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>
											</tr>	 
<?php				  
				}
			}
		}
?>
										</table>
										<div> 
											<a href="#" class="to-table-button-add"><?php esc_html_e('Add','chauffeur-booking-system'); ?></a>
										</div>
									</div>
								</li>						
								<li>
									<h5><?php esc_html_e('Hours','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php esc_html_e('Enter pickup hours.','chauffeur-booking-system'); ?></span>
									<div>
										<table class="to-table" id="to-table-hour">
											<tr>
												<th style="width:40%">
													<div>
														<?php esc_html_e('From','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('From.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:40%">
													<div>
														<?php esc_html_e('To','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('To.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:20%">
													<div>
														<?php esc_html_e('Remove','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Remove this entry.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>											
											</tr>
											<tr class="to-hidden">
												<td>
													<div>
														<input type="text" class="to-timepicker-custom" name="<?php CHBSHelper::getFormName('pickup_time[start][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" class="to-timepicker-custom" name="<?php CHBSHelper::getFormName('pickup_time[stop][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>
											</tr>  
<?php
		if(isset($this->data['meta']['pickup_time']))
		{
			if(is_array($this->data['meta']['pickup_time']))
			{
				foreach($this->data['meta']['pickup_time'] as $index=>$value)
				{
?>
											<tr>
												<td>
													<div>
														<input type="text" class="to-timepicker-custom" name="<?php CHBSHelper::getFormName('pickup_time[start][]'); ?>" value="<?php echo esc_attr($Date->formatTimeToDisplay($value['start'])); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" class="to-timepicker-custom" name="<?php CHBSHelper::getFormName('pickup_time[stop][]'); ?>" value="<?php echo esc_attr($Date->formatTimeToDisplay($value['stop'])); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>
											</tr>	 
<?php				  
				}
			}
		}
?>
										</table>
										<div> 
											<a href="#" class="to-table-button-add"><?php esc_html_e('Add','chauffeur-booking-system'); ?></a>
										</div>
									</div>
								</li>								
							</ul>
						</div>			
						<div id="meta-box-price-rule-2-5">
							<ul class="to-form-field-list">
								<li>
									<h5><?php esc_html_e('Distance','chauffeur-booking-system'); ?></h5>
									<span class="to-legend">
										<?php esc_html_e('Enter ride distance (from - to) between customer pickup and drop-off location.','chauffeur-booking-system'); ?><br/>
										<?php echo sprintf(esc_html__('If the "Price source type" (from "Prices" tab) option is set to "Calculation based on distance" plugin uses prices defined in this table as prices "%s", "%s", "%s".','chauffeur-booking-system'),$Length->label(-1,3),$Length->label(-1,4),$Length->label(-1,5)); ?>
										<?php esc_html_e('Otherwise plugin checks whether distance is defined in this table and use prices from "Prices" tab.','chauffeur-booking-system'); ?><br/>
										<?php esc_html_e('This condition is available for "Distance" and "Flat rate" service type only. Minimum step is set to 0.1.','chauffeur-booking-system'); ?>
									</span>
									<div>
										<table class="to-table" id="to-table-distance">
											<tr>
												<th style="width:20%">
													<div>
														<?php esc_html_e('From','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('From.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:20%">
													<div>
														<?php esc_html_e('To','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('To.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:20%">
													<div>
														<?php esc_html_e('Price alter type','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Price alter type.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>		
												<th style="width:20%">
													<div>
														<?php esc_html_e('Price','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Price.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>				
												<th style="width:20%">
													<div>
														<?php esc_html_e('Remove','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Remove this entry.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>											
											</tr>
											<tr class="to-hidden">
												<td>
													<div class="to-clear-fix">
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance[start][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div class="to-clear-fix">
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance[stop][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div class="to-clear-fix">
														<select class="to-dropkick-disable" name="<?php CHBSHelper::getFormName('distance[price_alter_type_id][]'); ?>" id="distance_price_alter_type_id">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf(2,$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
														</select>												  
													</div>
												</td>
												<td>
													<div class="to-clear-fix">
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance[price][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div class="to-clear-fix">
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>
											</tr>   
<?php
		if(isset($this->data['meta']['distance']))
		{
			if(is_array($this->data['meta']['distance']))
			{
				foreach($this->data['meta']['distance'] as $index=>$value)
				{
					if(CHBSOption::getOption('length_unit')==2)
					{
						$value['start']=round($Length->convertUnit($value['start'],1,2),1);
						$value['stop']=round($Length->convertUnit($value['stop'],1,2),1); 
					}
?>
											<tr>
												<td>
													<div class="to-clear-fix">
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance[start][]'); ?>" value="<?php echo esc_attr($value['start']); ?>"/>
													</div>									
												</td>
												<td>
													<div class="to-clear-fix">
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance[stop][]'); ?>" value="<?php echo esc_attr($value['stop']); ?>"/>
													</div>									
												</td>
												<td>
													<div class="to-clear-fix">
														<select name="<?php CHBSHelper::getFormName('distance[price_alter_type_id][]'); ?>" id="<?php CHBSHelper::getFormName('distance_price_alter_type_id_'.$index); ?>">
<?php
				foreach($this->data['dictionary']['alter_type'] as $alterTypeIndex=>$alterTypeValue)
				{
					echo '<option value="'.esc_attr($alterTypeIndex).'" '.(CHBSHelper::selectedIf($value['price_alter_type_id'],$alterTypeIndex,false)).'>'.esc_html($alterTypeValue[0]).'</option>';
				}
?>
														</select>												  
													</div>
												</td>
												<td>
													<div class="to-clear-fix">
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance[price][]'); ?>" value="<?php echo esc_attr($value['price']); ?>"/>
													</div>									
												</td>
												<td>
													<div class="to-clear-fix">
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>										
											</tr>	 
<?php				  
				}
			}
		}
?>
										</table>
										<div> 
											<a href="#" class="to-table-button-add"><?php esc_html_e('Add','chauffeur-booking-system'); ?></a>
										</div>
									</div>
								</li>
								<li>
									<h5><?php esc_html_e('Distance between base and pickup location','chauffeur-booking-system'); ?></h5>
									<span class="to-legend">
										<?php esc_html_e('Enter ride distance (from - to) between base and customer pickup location.','chauffeur-booking-system'); ?><br/>
										<?php esc_html_e('If the "Price source type" (from "Prices" tab) option is set to "Calculation based on distance between base and pickup location" plugin uses prices defined in this table as "Delivery" price.','chauffeur-booking-system'); ?>
										<?php esc_html_e('Otherwise plugin checks whether distance is defined in this table and use prices from "Prices" tab.','chauffeur-booking-system'); ?><br/>
										<?php esc_html_e('This condition is available once base location is set up. Minimum step is set to 0.1.','chauffeur-booking-system'); ?><br/>
									</span>
									<div>
										<table class="to-table" id="to-table-distance-base">
											<tr>
												<th style="width:25%">
													<div>
														<?php esc_html_e('From','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('From.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:25%">
													<div>
														<?php esc_html_e('To','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('To.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:30%">
													<div>
														<?php esc_html_e('Price','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Price.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:20%">
													<div>
														<?php esc_html_e('Remove','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Remove this entry.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>											
											</tr>
											<tr class="to-hidden">
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance_base_location[start][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance_base_location[stop][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance_base_location[price][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>
											</tr>   
<?php
		if(isset($this->data['meta']['distance_base_location']))
		{
			if(is_array($this->data['meta']['distance_base_location']))
			{
				foreach($this->data['meta']['distance_base_location'] as $index=>$value)
				{
					if(CHBSOption::getOption('length_unit')==2)
					{
						$value['start']=round($Length->convertUnit($value['start'],1,2),1);
						$value['stop']=round($Length->convertUnit($value['stop'],1,2),1); 
					}
?>
											<tr>
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance_base_location[start][]'); ?>" value="<?php echo esc_attr($value['start']); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance_base_location[stop][]'); ?>" value="<?php echo esc_attr($value['stop']); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('distance_base_location[price][]'); ?>" value="<?php echo esc_attr($value['price']); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>										
											</tr>	 
<?php				  
				}
			}
		}
?>
										</table>
										<div> 
											<a href="#" class="to-table-button-add"><?php esc_html_e('Add','chauffeur-booking-system'); ?></a>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div id="meta-box-price-rule-2-6">
							<ul class="to-form-field-list">
								<li>
									<h5><?php esc_html_e('Ride duration','chauffeur-booking-system'); ?></h5>
									<span class="to-legend"><?php echo __('Enter range of ride duration (in hours).','chauffeur-booking-system'); ?></span>
									<div>
										<table class="to-table" id="to-table-duration">
											<tr>
												<th style="width:40%">
													<div>
														<?php esc_html_e('From','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('From.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:40%">
													<div>
														<?php esc_html_e('To','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('To.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:20%">
													<div>
														<?php esc_html_e('Remove','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Remove this entry.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>											
											</tr>
											<tr class="to-hidden">
												<td>
													<div>
														<input type="text" maxlength="4" name="<?php CHBSHelper::getFormName('duration[start][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" maxlength="4" name="<?php CHBSHelper::getFormName('duration[stop][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>
											</tr>   
<?php
		if(isset($this->data['meta']['duration']))
		{
			if(is_array($this->data['meta']['duration']))
			{
				foreach($this->data['meta']['duration'] as $index=>$value)
				{
?>
											<tr>
												<td>
													<div>
														<input type="text" maxlength="5" name="<?php CHBSHelper::getFormName('duration[start][]'); ?>" value="<?php echo esc_attr($value['start']); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" maxlength="5" name="<?php CHBSHelper::getFormName('duration[stop][]'); ?>" value="<?php echo esc_attr($value['stop']); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>										
											</tr>	 
<?php				  
				}
			}
		}
?>
										</table>
										<div> 
											<a href="#" class="to-table-button-add"><?php esc_html_e('Add','chauffeur-booking-system'); ?></a>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div id="meta-box-price-rule-2-7">
							<ul class="to-form-field-list">
								<li>
									<h5><?php esc_html_e('Passengers number','chauffeur-booking-system'); ?></h5>
									<span class="to-legend">
										<?php esc_html_e('Enter passengers number.','chauffeur-booking-system'); ?><br/>
										<?php echo esc_html('This condition is available once passengers mode is enabled in booking form for particular service types.','chauffeur-booking-system'); ?><br/>
									</span>
									<div>
										<table class="to-table" id="to-table-passenger">
											<tr>
												<th style="width:40%">
													<div>
														<?php esc_html_e('From','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('From.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:40%">
													<div>
														<?php esc_html_e('To','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('To.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>
												<th style="width:20%">
													<div>
														<?php esc_html_e('Remove','chauffeur-booking-system'); ?>
														<span class="to-legend">
															<?php esc_html_e('Remove this entry.','chauffeur-booking-system'); ?>
														</span>
													</div>
												</th>											
											</tr>
											<tr class="to-hidden">
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('passenger[start][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('passenger[stop][]'); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>
											</tr>   
<?php
		if(isset($this->data['meta']['passenger']))
		{
			if(is_array($this->data['meta']['passenger']))
			{
				foreach($this->data['meta']['passenger'] as $index=>$value)
				{
?>
											<tr>
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('passenger[start][]'); ?>" value="<?php echo esc_attr($value['start']); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<input type="text" maxlength="12" name="<?php CHBSHelper::getFormName('passenger[stop][]'); ?>" value="<?php echo esc_attr($value['stop']); ?>"/>
													</div>									
												</td>
												<td>
													<div>
														<a href="#" class="to-table-button-remove"><?php esc_html_e('Remove','chauffeur-booking-system'); ?></a>
													</div>
												</td>										
											</tr>	 
<?php				  
				}
			}
		}
?>
										</table>
										<div> 
											<a href="#" class="to-table-button-add"><?php esc_html_e('Add','chauffeur-booking-system'); ?></a>
										</div>
									</div>
								</li>						
							</ul>
						</div>
					</div>		
				</div>
				<div id="meta-box-price-rule-3">
					<ul class="to-form-field-list">
						<li>
							<h5><?php esc_html_e('Price source type','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php esc_html_e('Select price source type.','chauffeur-booking-system'); ?><br/>
								<?php esc_html_e('If the "Exact range" option is set up, plugin has to find value in appropriate table and then use defined (for this value or range of values) price. If the value will not be found, plugin stops processing the rule.','chauffeur-booking-system'); ?><br/>
								<?php esc_html_e('If the "All ranges" option is set up, plugin calculate price based on all values in appropriate table. Processing of the rule will continue doesn\'t matter if the value will be found or not.','chauffeur-booking-system'); ?>	
							</span>
							<div class="to-clear-fix">
								<select name="<?php CHBSHelper::getFormName('price_source_type'); ?>">
<?php
		foreach($this->data['dictionary']['price_source_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_source_type'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
								</select>
							</div>
						</li>	
						<li>
							<h5><?php esc_html_e('Booking sum type','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php esc_html_e('Select type of booking sum.','chauffeur-booking-system'); ?><br/>
								<?php esc_html_e('For a "Variable" option final price of the ride depends on e.g: distance, time, number of passengers etc.','chauffeur-booking-system'); ?><br/>
								<?php esc_html_e('For a "Fixed" option final price of the ride is independent on any factor.','chauffeur-booking-system'); ?>
							</span>
							<div class="to-radio-button">
<?php
		foreach($this->data['dictionary']['price_type'] as $index=>$value)
		{
?>
								<input type="radio" value="<?php echo esc_attr($index); ?>" id="<?php CHBSHelper::getFormName('price_type_'.$index); ?>" name="<?php CHBSHelper::getFormName('price_type'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['price_type'],$index); ?>/>
								<label for="<?php CHBSHelper::getFormName('price_type_'.$index); ?>"><?php echo esc_html($value[0]); ?></label>
<?php		
		}
?>
							</div>
						</li>  
<?php
		$class=array(1=>array('to-price-type-1'),2=>array('to-price-type-2'));
		array_push($class[$this->data['meta']['price_type']==1 ? 2 : 1],'to-state-disabled');
?>				  
						<li>
							<h5><?php esc_html_e('Prices','chauffeur-booking-system'); ?></h5>
							<span class="to-legend"><?php esc_html_e('Prices.','chauffeur-booking-system'); ?></span>
							<div>
								<table class="to-table to-table-price">
									<tr>
										<th style="width:20%">
											<div>
												<?php esc_html_e('Name','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Name.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>
										<th style="width:8%">
											<div>
												<?php esc_html_e('Type','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Type.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>										
										<th style="width:35%">
											<div>
												<?php esc_html_e('Description','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Description.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>
										<th style="width:17%">
											<div>
												<?php esc_html_e('Price alter','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Price alter type.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>										
										<th style="width:10%">
											<div>
												<?php esc_html_e('Value','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Value.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>										
										<th style="width:10%">
											<div>
												<?php esc_html_e('Tax','chauffeur-booking-system'); ?>
												<span class="to-legend">
													<?php esc_html_e('Tax.','chauffeur-booking-system'); ?>
												</span>
											</div>
										</th>										  
									</tr> 
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[2]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Fixed price for a ride.','chauffeur-booking-system'); ?>
											</div>
										</td>		  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_fixed_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td> 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_fixed_value'); ?>" id="<?php CHBSHelper::getFormName('price_fixed_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_fixed_value']); ?>"/>
											</div>
										</td>												
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_fixed_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[2]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed (return)','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Fixed price for a return ride.','chauffeur-booking-system'); ?>
											</div>
										</td>	
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_fixed_return_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_return_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td> 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_fixed_return_value'); ?>" id="<?php CHBSHelper::getFormName('price_fixed_return_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_fixed_return_value']); ?>"/>
											</div>
										</td>	
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_fixed_return_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_return_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_return_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_return_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr> 
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[2]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed (return, new ride)','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Fixed price for a return, new ride.','chauffeur-booking-system'); ?>
											</div>
										</td>	 
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_fixed_return_new_ride_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_return_new_ride_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_fixed_return_new_ride_value'); ?>" id="<?php CHBSHelper::getFormName('price_fixed_return_new_ride_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_fixed_return_new_ride_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_fixed_return_new_ride_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_return_new_ride_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_return_new_ride_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_fixed_return_new_ride_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>									 
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Initial','chauffeur-booking-system'); ?>
											</div>
										</td>
										 <td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Fixed value which is added to the order sum.','chauffeur-booking-system'); ?>
											</div>
										</td>	
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_initial_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_initial_value'); ?>" id="<?php CHBSHelper::getFormName('price_initial_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_initial_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_initial_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Initial (return)','chauffeur-booking-system'); ?>
											</div>
										</td>
										 <td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Fixed value which is added to the order sum in case of "Return" transfer type.','chauffeur-booking-system'); ?>
											</div>
										</td>	
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_initial_return_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_return_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_initial_return_value'); ?>" id="<?php CHBSHelper::getFormName('price_initial_return_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_initial_return_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_initial_return_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_return_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_return_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_return_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>	
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Initial (return, new ride)','chauffeur-booking-system'); ?>
											</div>
										</td>
										 <td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Fixed value which is added to the order sum in case of "Return (new ride)" transfer type.','chauffeur-booking-system'); ?>
											</div>
										</td>	
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_initial_return_new_ride_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_return_new_ride_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_initial_return_new_ride_value'); ?>" id="<?php CHBSHelper::getFormName('price_initial_return_new_ride_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_initial_return_new_ride_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_initial_return_new_ride_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_return_new_ride_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_return_new_ride_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_initial_return_new_ride_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Delivery','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php echo sprintf(esc_html__('%s of ride from base to customer pickup location.','chauffeur-booking-system'),$Length->label(-1,1)); ?>
											</div>
										</td>	  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_delivery_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_delivery_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_delivery_value'); ?>" id="<?php CHBSHelper::getFormName('price_delivery_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_delivery_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_delivery_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_delivery_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_delivery_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_delivery_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>  
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Delivery (return)','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php echo sprintf(esc_html__('%s of ride from customer drop off location to base.','chauffeur-booking-system'),$Length->label(-1,1)); ?>
											</div>
										</td> 
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_delivery_return_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_delivery_return_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_delivery_return_value'); ?>" id="<?php CHBSHelper::getFormName('price_delivery_return_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_delivery_return_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_delivery_return_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_delivery_return_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_delivery_return_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_delivery_return_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>											 
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php echo $Length->label(-1,3); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per distance.','chauffeur-booking-system'); ?>
											</div>
										</td>	   
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_distance_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_distance_value'); ?>" id="<?php CHBSHelper::getFormName('price_distance_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_distance_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_distance_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr> 
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php echo $Length->label(-1,3); ?><?php esc_html_e(' (return)'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per distance for return ride.','chauffeur-booking-system'); ?>
											</div>
										</td>   
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_distance_return_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_return_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_distance_return_value'); ?>" id="<?php CHBSHelper::getFormName('price_distance_return_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_distance_return_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_distance_return_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_return_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_return_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_return_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>  
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php echo $Length->label(-1,3); ?><?php esc_html_e(' (return, new ride)'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per distance for return, new ride.','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_distance_return_new_ride_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_return_new_ride_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										  
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_distance_return_new_ride_value'); ?>" id="<?php CHBSHelper::getFormName('price_distance_return_new_ride_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_distance_return_new_ride_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_distance_return_new_ride_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_return_new_ride_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_return_new_ride_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_distance_return_new_ride_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>  
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Per hour','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per hour.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_hour_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										  
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_hour_value'); ?>" id="<?php CHBSHelper::getFormName('price_hour_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_hour_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_hour_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Per hour (return)','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per hour for return ride.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_hour_return_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_return_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>										  
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_hour_return_value'); ?>" id="<?php CHBSHelper::getFormName('price_hour_return_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_hour_return_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_hour_return_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_return_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_return_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
		{
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_return_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
		}
?>
												</select>												  
											</div>
										</td>										
									</tr>									
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Per hour (return, new ride)','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per hour for return, new ride.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_hour_return_new_ride_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_return_new_ride_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>										  
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_hour_return_new_ride_value'); ?>" id="<?php CHBSHelper::getFormName('price_hour_return_new_ride_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_hour_return_new_ride_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_hour_return_new_ride_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_return_new_ride_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_return_new_ride_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_hour_return_new_ride_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
												</select>												  
											</div>
										</td>										
									</tr>									
									<tr>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Per extra time (hour)','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?><br/>
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per hour for extra time.','chauffeur-booking-system'); ?>
											</div>
										</td>	 
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_extra_time_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_extra_time_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_extra_time_value'); ?>" id="<?php CHBSHelper::getFormName('price_extra_time_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_extra_time_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_extra_time_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_extra_time_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_extra_time_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_extra_time_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
												</select>												  
											</div>
										</td>										
									</tr>
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Per adult','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per adult.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_passenger_adult_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
					echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_passenger_adult_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_passenger_adult_value'); ?>" id="<?php CHBSHelper::getFormName('price_passenger_adult_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_passenger_adult_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_passenger_adult_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_passenger_adult_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_passenger_adult_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_passenger_adult_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
												</select>												  
											</div>
										</td>										
									</tr>
									<tr<?php echo CHBSHelper::createCSSClassAttribute($class[1]); ?>>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Per child','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Price per child.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_passenger_children_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_passenger_children_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_passenger_children_value'); ?>" id="<?php CHBSHelper::getFormName('price_passenger_children_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_passenger_children_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_passenger_children_tax_rate_id'); ?>">
<?php
		echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['meta']['price_passenger_children_tax_rate_id'],-1,false)).'>'.esc_html__('- Inherited -','chauffeur-booking-system').'</option>';
		echo '<option value="0" '.(CHBSHelper::selectedIf($this->data['meta']['price_passenger_children_tax_rate_id'],0,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
		foreach($this->data['dictionary']['tax_rate'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_passenger_children_tax_rate_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
												</select>												  
											</div>
										</td>										
									</tr>
									<tr>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('PayPal flat fee','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?><br/>
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Flat fee added to the sum of booking once customer selects PayPal payment.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_payment_paypal_fixed_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_payment_paypal_fixed_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_payment_paypal_fixed_value'); ?>" id="<?php CHBSHelper::getFormName('price_payment_paypal_fixed_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_payment_paypal_fixed_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix"></div>
										</td>										
									</tr>									
									<tr>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('PayPal percentage fee','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?><br/>
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Percentage fee (calculate based on booking sum) added to the sum of booking once customer selects PayPal payment.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_payment_paypal_percentage_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_payment_paypal_percentage_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_payment_paypal_percentage_value'); ?>" id="<?php CHBSHelper::getFormName('price_payment_paypal_percentage_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_payment_paypal_percentage_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix"></div>
										</td>										
									</tr>										
									<tr>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Stripe flat fee','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?><br/>
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Flat fee added to the sum of booking once customer selects Stripe payment.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_payment_stripe_fixed_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_payment_stripe_fixed_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_payment_stripe_fixed_value'); ?>" id="<?php CHBSHelper::getFormName('price_payment_stripe_fixed_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_payment_stripe_fixed_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix"></div>
										</td>										 
									</tr>									
									<tr>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Stripe percentage fee','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php esc_html_e('Fixed','chauffeur-booking-system'); ?><br/>
												<?php esc_html_e('Variable','chauffeur-booking-system'); ?>
											</div>
										</td>
										<td>
											<div class="to-clear-fix">
												<?php _e('Percentage fee (calculate based on booking sum) added to the sum of booking once customer selects Stripe payment.','chauffeur-booking-system'); ?>
											</div>
										</td>  
										<td>
											<div class="to-clear-fix">
												<select name="<?php CHBSHelper::getFormName('price_payment_stripe_percentage_alter_type_id'); ?>">
<?php
		foreach($this->data['dictionary']['alter_type'] as $index=>$value)
			echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['meta']['price_payment_stripe_percentage_alter_type_id'],$index,false)).'>'.esc_html($value[0]).'</option>';
?>
												</select>												  
											</div>
										</td>										 
										<td>
											<div class="to-clear-fix">
												<input maxlength="12" type="text" name="<?php CHBSHelper::getFormName('price_payment_stripe_percentage_value'); ?>" id="<?php CHBSHelper::getFormName('price_payment_stripe_percentage_value'); ?>" value="<?php echo esc_attr($this->data['meta']['price_payment_stripe_percentage_value']); ?>"/>
											</div>
										</td>										
										<td>
											<div class="to-clear-fix"></div>
										</td>									   
									</tr>										
								</table>
							</div>
						</li>
					</ul>
				</div>
				<div id="meta-box-price-rule-4">
					<ul class="to-form-field-list">
						<li>
							<h5><?php esc_html_e('Next rule processing','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php echo __('This option determine, whether prices will be set up based on this rule only or plugin has to processing next rule based on priority (order).','chauffeur-booking-system'); ?>
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
						<li>
							<h5><?php esc_html_e('Minimum order value','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php echo __('Define minimum (net) value of the order.','chauffeur-booking-system'); ?><br/>
								<?php echo __('If the order sum will be lower than defined, plugin adds a value to the initial fee which a difference between sum of defined and current order.','chauffeur-booking-system'); ?><br/>
								<?php echo __('This option is available for variable prices only.','chauffeur-booking-system'); ?>
							</span>			   
							<div>
								<div>
									<input type="text" name="<?php CHBSHelper::getFormName('minimum_order_value'); ?>" value="<?php echo esc_attr($this->data['meta']['minimum_order_value']); ?>"/>
								</div>
							</div>							  
						</li> 
						<li>
							<h5><?php esc_html_e('Calculation on request','chauffeur-booking-system'); ?></h5>
							<span class="to-legend">
								<?php echo __('This option hides price and disable selection of particular vehicle.','chauffeur-booking-system'); ?><br/>
								<?php echo __('Customer will be redirect to specified URL address once he chooses vehicle.','chauffeur-booking-system'); ?>
							</span>			   
							<div>
								<span class="to-legend-field"><?php esc_html_e('Status:','chauffeur-booking-system'); ?></span>
								<div class="to-radio-button">
									<input type="radio" value="1" id="<?php CHBSHelper::getFormName('calculation_on_request_enable_1'); ?>" name="<?php CHBSHelper::getFormName('calculation_on_request_enable'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['calculation_on_request_enable'],1); ?>/>
									<label for="<?php CHBSHelper::getFormName('calculation_on_request_enable_1'); ?>"><?php esc_html_e('Enable','chauffeur-booking-system'); ?></label>
									<input type="radio" value="0" id="<?php CHBSHelper::getFormName('calculation_on_request_enable_0'); ?>" name="<?php CHBSHelper::getFormName('calculation_on_request_enable'); ?>" <?php CHBSHelper::checkedIf($this->data['meta']['calculation_on_request_enable'],0); ?>/>
									<label for="<?php CHBSHelper::getFormName('calculation_on_request_enable_0'); ?>"><?php esc_html_e('Disable','chauffeur-booking-system'); ?></label>
								</div>
							</div>					   
							<div>
								<span class="to-legend-field"><?php esc_html_e('URL address:','chauffeur-booking-system'); ?></span>
								<div>
									<input type="text" name="<?php CHBSHelper::getFormName('calculation_on_request_redirect_url'); ?>" value="<?php echo esc_attr($this->data['meta']['calculation_on_request_redirect_url']); ?>"/>
								</div>
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
				
				toPreventCheckbox($('input[name="<?php CHBSHelper::getFormName('service_type_id'); ?>[]"]'));
				toPreventCheckbox($('input[name="<?php CHBSHelper::getFormName('transfer_type_id'); ?>[]"]'));
				toPreventCheckbox($('input[name="<?php CHBSHelper::getFormName('pickup_day_number'); ?>[]"]'));
				
				/***/
				
				$('#to-table-date').table();
				$('#to-table-hour').table();
				$('#to-table-distance').table();
				$('#to-table-distance-base').table();
				$('#to-table-passenger').table();
				$('#to-table-duration').table();
				
				/***/
				
				var timeFormat='<?php echo CHBSOption::getOption('time_format'); ?>';
				var dateFormat='<?php echo CHBSJQueryUIDatePicker::convertDateFormat(CHBSOption::getOption('date_format')); ?>';
				
				toCreateCustomDateTimePicker(dateFormat,timeFormat);
				
				/***/
				
				toTogglePriceType('.to input[name="<?php CHBSHelper::getFormName('price_type'); ?>"]','.to .to-table-price');
				
				/***/
			});
		</script>