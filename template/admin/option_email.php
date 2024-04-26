
		<ul class="to-form-field-list">
			<li>
				<h5><?php esc_html_e('Default sender e-mail account','chauffeur-booking-system'); ?></h5>
				<span class="to-legend">
					<?php esc_html_e('Select default e-mail account.','chauffeur-booking-system'); ?><br/>
					<?php esc_html_e('It will be used to sending email messages to clients about changing of booking status and to driver about assign/unassign to the booking.','chauffeur-booking-system'); ?>
				</span>
				<div class="to-clear-fix">
					<select name="<?php CHBSHelper::getFormName('sender_default_email_account_id'); ?>" id="<?php CHBSHelper::getFormName('sender_default_email_account_id'); ?>">
<?php
						echo '<option value="-1" '.(CHBSHelper::selectedIf($this->data['option']['sender_default_email_account_id'],-1,false)).'>'.esc_html__('- Not set -','chauffeur-booking-system').'</option>';
						foreach($this->data['dictionary']['email_account'] as $index=>$value)
							echo '<option value="'.esc_attr($index).'" '.(CHBSHelper::selectedIf($this->data['option']['sender_default_email_account_id'],$index,false)).'>'.esc_html($value['post']->post_title).'</option>';
?>
					</select>
				</div>
			</li> 
			<li>
				<h5><?php esc_html_e('Customer pre-arrival reminder','chauffeur-booking-system'); ?></h5>
				<span class="to-legend">
					<?php esc_html_e('Enable this option, if you want that your customer gets an e-mail reminder about service.','chauffeur-booking-system'); ?><br/>
				</span>
				<div class="to-clear-fix">
					<span class="to-legend-field"><?php esc_html_e('Status:','chauffeur-booking-system'); ?></span>
					<div class="to-radio-button">
						<input type="radio" value="1" id="<?php CHBSHelper::getFormName('email_service_reminder_customer_enable_1'); ?>" name="<?php CHBSHelper::getFormName('email_service_reminder_customer_enable'); ?>" <?php CHBSHelper::checkedIf($this->data['option']['email_service_reminder_customer_enable'],1); ?>/>
						<label for="<?php CHBSHelper::getFormName('email_service_reminder_customer_enable_1'); ?>"><?php esc_html_e('Enable','chauffeur-booking-system'); ?></label>
						<input type="radio" value="0" id="<?php CHBSHelper::getFormName('email_service_reminder_customer_enable_0'); ?>" name="<?php CHBSHelper::getFormName('email_service_reminder_customer_enable'); ?>" <?php CHBSHelper::checkedIf($this->data['option']['email_service_reminder_customer_enable'],0); ?>/>
						<label for="<?php CHBSHelper::getFormName('email_service_reminder_customer_enable_0'); ?>"><?php esc_html_e('Disable','chauffeur-booking-system'); ?></label>
					</div>
				</div>
				<div class="to-clear-fix">
					<span class="to-legend-field"><?php esc_html_e('Number of minutes (1-9999) before pickup date/time in which customer has to get an email reminder:','chauffeur-booking-system'); ?></span>
					<div>
						<input type="text" maxlength="4" name="<?php CHBSHelper::getFormName('email_service_reminder_customer_duration'); ?>" id="<?php CHBSHelper::getFormName('email_service_reminder_customer_duration'); ?>" value="<?php echo esc_attr($this->data['option']['email_service_reminder_customer_duration']); ?>"/>
					</div>
				</div>
			</li> 
			<li>
				<h5><?php esc_html_e('Driver pre-arrival reminder','chauffeur-booking-system'); ?></h5>
				<span class="to-legend">
					<?php esc_html_e('Enable this option, if you want that driver gets an e-mail reminder about service.','chauffeur-booking-system'); ?><br/>
				</span>
				<div class="to-clear-fix">
					<span class="to-legend-field"><?php esc_html_e('Status:','chauffeur-booking-system'); ?></span>
					<div class="to-radio-button">
						<input type="radio" value="1" id="<?php CHBSHelper::getFormName('email_service_reminder_driver_enable_1'); ?>" name="<?php CHBSHelper::getFormName('email_service_reminder_driver_enable'); ?>" <?php CHBSHelper::checkedIf($this->data['option']['email_service_reminder_driver_enable'],1); ?>/>
						<label for="<?php CHBSHelper::getFormName('email_service_reminder_driver_enable_1'); ?>"><?php esc_html_e('Enable','chauffeur-booking-system'); ?></label>
						<input type="radio" value="0" id="<?php CHBSHelper::getFormName('email_service_reminder_driver_enable_0'); ?>" name="<?php CHBSHelper::getFormName('email_service_reminder_driver_enable'); ?>" <?php CHBSHelper::checkedIf($this->data['option']['email_service_reminder_driver_enable'],0); ?>/>
						<label for="<?php CHBSHelper::getFormName('email_service_reminder_driver_enable_0'); ?>"><?php esc_html_e('Disable','chauffeur-booking-system'); ?></label>
					</div>
				</div>
				<div class="to-clear-fix">
					<span class="to-legend-field"><?php esc_html_e('Number of minutes (1-9999) before pickup date/time in which driver has to get an email reminder:','chauffeur-booking-system'); ?></span>
					<div>
						<input type="text" maxlength="4" name="<?php CHBSHelper::getFormName('email_service_reminder_driver_duration'); ?>" id="<?php CHBSHelper::getFormName('email_service_reminder_driver_duration'); ?>" value="<?php echo esc_attr($this->data['option']['email_service_reminder_driver_duration']); ?>"/>
					</div>
				</div>
			</li> 
		</ul>