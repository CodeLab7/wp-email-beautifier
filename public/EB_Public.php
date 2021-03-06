<?php

class EB_Public extends EB_Abstruct{

	public function enqueue_styles(){
		wp_enqueue_style($this->plugin_name.'-style', plugin_dir_url(__FILE__).'css/eb-public.css', array(), $this->version, 'all');
	}

	public function enqueue_scripts(){
		wp_enqueue_script($this->plugin_name.'-script', plugin_dir_url(__FILE__).'js/eb-public.js', array('jquery'), $this->version, true);
	}

	public function mail_filter($attr){
		$mail = new EB_EmailMaker($attr);
		$attr['message'] = $mail->getBody();
		return $attr;
	}
}