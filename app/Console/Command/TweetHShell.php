<?php

class tweetHShell extends Shell{

	public $uses = array('AverageLightValue','AverageTempValue');

public function tweetHShell(){
	App::uses('Twitter','Vendor');
	App::uses('twitteroauth.php','Vendor');

	

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';

			$lastLightValue = $this->AverageLightValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));
			$lastTempValue = $this->AverageTempValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));

			$lastLightValue = $lastLightValue[0]['AverageLightValue']['reading_value'];
			$lastTempValue = $lastTempValue[0]['AverageTempValue']['reading_value'];

			if(!empty($lastLightValue)){
				try {
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$time = date("H:i");
					$message = $time . ' Summary for the last hour: Average Temperature was: ' . $lastTempValue . 'C, Average light level was: ' . $lastLightValue . 'Lux.';
					$status = $twitter->send(utf8_encode($message));
					echo $status ? 'OK' : 'ERROR';
					$this->out('tweet sent successfully.');
				} catch (Exception $e) {
					echo "Error: ".$e;
				}
			} else {
				echo "no values";
			}
	}



}