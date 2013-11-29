<?php

class tweetDShell extends AppShell{

	public $uses = array('DataStat');

public function tweetDShell(){
	App::uses('Twitter','Vendor');
	App::uses('twitteroauth.php','Vendor');

	

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';
			$conditions = array("stat_name = 'dailyTempAvg'");


			$DailyTempValue = $this->DataStat->find('all', array('conditions' => $conditions));
			$DailyLightValue = $this->DataStat->find('all', array('conditions' => array("stat_name = 'dailyLightAvg'")));
			
			$DailyTempValue = $DailyTempValue[0]['DataStat']['stat_value'];
			$DailyLightValue = $DailyLightValue[0]['DataStat']['stat_value'];

			if(!empty($DailyLightValue)){
				try {
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$time = date("H:i:s");
					$message = $time . ' Summary for Today: Average Temperature was: ' . $DailyTempValue . ', Average light was: ' . $DailyLightValue . '.';
					$status = $twitter->send(utf8_encode($message));
					echo $status ? 'OK' : 'ERROR';
				} catch (Exception $e) {
					echo "Error: ".$e;
				}
			} else {
				echo "no values";
			}
	}



}