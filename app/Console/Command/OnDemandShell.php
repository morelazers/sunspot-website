<?php 


class onDemandShell extends Shell {
	public $uses = array('FollowerId', 'AverageLightValue','AverageTempValue','DataStat', 'Actuators', 'LightValue', 'TempValue', 'InteractionData');

public function onDemandShell(){

		App::uses('Twitter','Vendor');
		App::uses('twitteroauth.php','Vendor');

			 $consumerKey 			= 'f13aHtOr8H6P85kud4qx3Q'; 
			 $consumerSecret 		= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			 $accessToken 			= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			 $accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';

			 $stats = array('light',
			 				'temp',
			 				'interaction');

			try{
				$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

				$lasttweet = $this->DataStat->find('first');
				//debug($lasttweet);
				$lasttweet = $lasttweet['DataStat']['stat_value'];
				//$id = array('since_id'=> intval($lasttweet));
			//	$response = $twitter->cachedRequest("statuses/mentions_timeline", $id, "GET");

				$response = $twitter->request("statuses/mentions_timeline", NULL, "GET");
				
				foreach($response as $val){
					if(($val->user->screen_name != 'LUISl_s')&&(!empty($val->entities->hashtags))) {
						if($val->entities->hashtags[0]->text == "demand" &&
							(in_array($val->entities->hashtags[1]->text, $stats))){
								$this->tweetLast($val->user->id, $val->entities->hashtags[1]->text);
						}
						elseif($val->entities->hashtags[0]->text == "WarmMyHands"){
							$this->toggleGloves(1);
						}
						elseif($val->entities->hashtags[0]->text == "CoolMyDrink"){
							$this->toggleFridge(1);
						}
						elseif($val->entities->hashtags[0]->text == "ImHot"){
							$this->toggleFan(1);
						}
					}
					$lastID = $val->id;
				}
				$this->Actuators->save(array(
					'DataStat.stat_value' => $lastID,
				    'DataStat.stat_name <=' => "last_tweet"
				    )
				);

			}catch (Exception $e) {
					echo "Error: ".$e;
				}
				//$this->redirect(array('controller' => 'graphs', 'action' => 'main'));
	}
	public function toggleGloves($val){
		$this->Actuators->updateAll(
		    array('Actuators.actuator_status' => 1),
		    array('Actuators.actuator_name <=' => "gloves")
		);
	}
	public function toggleFan($val){
		$this->Actuators->updateAll(
		    array('Actuators.actuator_status' => 1),
		    array('Actuators.actuator_name <=' => "fan")
		);
	}
	public function toggleFridge($val){
		$this->Actuators->updateAll(
		    array('Actuators.actuator_status' => 1),
		    array('Actuators.actuator_name <=' => "minifridge")
		);
	}
	public function tweetLast($userID, $requested){
		App::uses('Twitter2','Vendor');
		App::uses('twitteroauth.php','Vendor');
			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';


			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			
			switch($requested){
				case "light":
					$lastrecord = $this->LightValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));
					//debug($lastrecord);
					$lastvalue = $lastrecord[0]['LightValue']['reading_value'];
					$lasttime = $lastrecord[0]['LightValue']['timestamp'];
					break;
				case "temp":
					$lastrecord = $this->TempValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));
					$lastvalue = $lastrecord[0]['TempValue']['reading_value'];
					$lasttime = $lastrecord[0]['TempValue']['timestamp'];
					break;
				case "interaction":
					$lastrecord = $this->InteractionData->find('all', array('order' =>'timestamp DESC', 'limit' => 1));
					$lastvalue = $lastrecord[0]['InteractionData']['object_name'];
					$lasttime = $lastrecord[0]['InteractionData']['timestamp'];
					break;
			}
		$msg = "Last " . $requested . " value was " . $lastvalue . " at " . $lasttime;
			$options = array(
						"user_id" => $userID,
						"text" => utf8_encode($msg)); // .$web_enc
			$twitter->request("direct_messages/new", $options);

	}
}