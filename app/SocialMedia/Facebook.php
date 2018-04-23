<?php
namespace App\SocialMedia;

Class Facebook {
	private $client_id;
	private $client_secret;
	private $redirect_url;

	public function __construct($Facebook){
		$this->client_id = $Facebook['client_id'];
		$this->client_secret = $Facebook['client_secret'];
		$this->redirect_url = $Facebook['redirect'];
	}

	public function getClientId(){
		return $this->client_id;
	}
	public function getClientSecret(){
		return $this->client_secret;
	}
	public function redirect(){
		return $this->redirect_url;
	}
}