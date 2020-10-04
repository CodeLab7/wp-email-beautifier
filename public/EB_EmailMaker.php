<?php

class EB_EmailMaker extends EB_Abstruct{


	private $settings;
	private $mail_meta;
	private $mail_body;
	private $mail_template;

	public function __construct($attr){
		$this->mail_body = $attr['message'];
		unset($attr['message']);
		$this->mail_meta = $attr;
	}

	public function getBody(){
		$result = $this->_header();
		$result .= $this->mail_body;
		$result .= $this->_footer();

		return $result;
	}

	private function _header(){
		ob_start();
		?>
        <table width="600" cellpadding="0" cellspacing="0" border="1"><tr><td>
		<?php
		return ob_get_clean();
	}

	private function _footer(){
		ob_start();
		?></td></tr></table>
		<?php
		return ob_get_clean();
	}


}