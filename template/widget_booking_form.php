<?php
		echo $this->data['html']['start'];
		echo do_shortcode('['.PLUGIN_CHBS_CONTEXT.'_booking_form booking_form_id="'.(int)$this->data['instance']['booking_form_id'].'" currency="'.$this->data['instance']['booking_form_currency'].'" widget_mode="1" widget_style="'.$this->data['instance']['widget_style'].'" widget_booking_form_new_window="'.$this->data['instance']['booking_form_new_window'].'" widget_booking_form_url="'.$this->data['instance']['booking_form_url'].'" css_class="'.$this->data['instance']['css_class'].'"]');
		echo $this->data['html']['stop'];