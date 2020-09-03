<?php

class EB_i18n {
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'EB',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
