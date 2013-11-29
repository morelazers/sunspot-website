<?php 
App::uses('Twitter','Vendor');
App::uses('Twitter2','Vendor');
App::uses('twitteroauth.php','Vendor');


class TwitterController extends AppController {


	public $uses = array('FollowerId', 'AverageLightValue','AverageTempValue','DataStat', 'Actuators', 'LightValue', 'TempValue', 'InteractionData');

	/*$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
	$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
	$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
	$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';*/

	function getAllTweets(){
		if($this->request->is('ajax')){
			$this->layout = 'ajax';
			$this->autoRender = false;
		
			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';

			try{
				$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

				$response = $twitter->request("statuses/mentions_timeline", NULL, "GET");

				echo json_encode($response);
			}catch (Exception $e) {
				echo "Error: ".$e;
			}	
		}
	}

		public function getTweets(){

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';

			 $stats = array('light',
			 				'temp',
			 				'interaction');

			try{
				$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

				$lasttweet = $this->DataStat->find('first');
				debug($lasttweet);
				$lasttweet = $lasttweet['DataStat']['stat_value'];
				//$id = array('since_id'=> intval($lasttweet));

			//	$response = $twitter->cachedRequest("statuses/mentions_timeline", $id, "GET");

				$response = $twitter->request("statuses/mentions_timeline", NULL, "GET");

				//debug($response);
				
				foreach($response as $val){
					if(($val->user->screen_name != 'LUISl_s')&&(!empty($val->entities->hashtags))) {
						if($val->entities->hashtags[0]->text == "demand" &&
							(in_array($val->entities->hashtags[1]->text, $stats))){
								$this->tweetLast($val->user->id, $val->entities->hashtags[1]->text);
						}
						if(strtolower($val->entities->hashtags[0]->text) == "warmmyhands"){
							$this->toggleGloves(1);
						}if(strtolower($val->entities->hashtags[0]->text) == "coolmyface"){
							$this->toggleFan(1);
						}if(strtolower($val->entities->hashtags[0]->text) == "coolmybiscuits"){
							$this->toggleFridge(1);
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
		    array('Actuators.actuator_name <=' => "fridge")
		);
	}
	public function tweetLast($userID, $requested){
			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';


			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			
			switch($requested){
				case "light":
					$lastrecord = $this->LightValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));
					debug($lastrecord);
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
/*
	public function sendHourTweet(){

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';

			$lastLightValue = $this->AverageLightValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));
			$lastTempValue = $this->AverageTempValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));

			$lastLightValue = $lastLightValue[0]['AverageLightValue']['reading_value'];
			$lastTempValue = $lastTempValue[0]['AverageTempValue']['reading_value'];

			//echo "Last light value: " . $lastLightValue . "<br>";
			//echo "Last temp value: " . $lastTempValue . "<br>";

			if(!empty($lastLightValue)){
				try {
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$time = date("H:i:s");
					$message = $time . ' Summary for the last hour: Average Temperature was: ' . $lastTempValue . 'C, Average light level was: ' . $lastLightValue . '.';
					$status = $twitter->send(utf8_encode($message));
					echo $status ? 'OK' : 'ERROR';
				} catch (Exception $e) {
					echo "Error: ".$e;
				}
			} else {
				echo "no values";
			}
	}
	
	
	public function inDB($id){
		$condition = array(
					'followerID = ?' => $id
					);
		$res = $this->FollowerId->find('all', array('conditions' => $condition));
		if($res!=null){
			return true;
		}
		else{
			return false;
		}
	}
	public function directM(){

			//twitter credentials & OAuth settings 
			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';

			$method = 'direct_messages/new'; //method to be used
			$website = "luisls.info"; //website URL
			$web_enc = rawurlencode("http://luisls.info");
			$fbLink = "https://www.facebook.com/luisls"; //facebook link

	try {
		$connection = new Twitter2($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

		$url = 'https://api.twitter.com/1.1/followers/list.json?cursor=-1&screen_name=sitestreams&skip_status=true&include_user_entities=false'; //URL of API to be used
		$requestMethod = 'GET'; //type of method to be used 'GET' or 'POST', 

		$followers = $connection->cachedRequest('followers/ids', array('user_id' => '2164730497')); //get followers through cachedRequest function(twitter.class.php)
		
		//$resultfollowers = json_decode($followers, true); 
		//$resultfollowers = (array) json_decode($followers);
		debug($followers);
		foreach($followers['ids'] as $val){
			if($this->inDB($val)==false){
				$record = Array( 'FollowerId' => 
						Array(
							'followerID' => $val
						));
				$this->FollowerId->saveAll($record);

				$options = array(
					"user_id" => $val,
					"text" => "Welcome to LUISIs, check out our website and facebook page"); // .$web_enc
				$connection->request($method, $options); //request to twitter passing the method and options
			}
		}
		} catch (Exception $e) {
				echo "Error: ".$e;
			}
	}

	/*public function sendDailyTweet() {

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';
			$conditions = array("stat_name = 'dailyTempAvg'")

			$DailyTempValue = $this->DataStat->find('all', array('conditions' => $conditions,
														'order' =>'timestamp DESC', 'limit' => 1));
			$DailyLightValue = $this->DataStat->find('all', array('conditions' => array("stat_name = 'dailyLightAvg'"),
														'order' =>'timestamp DESC', 'limit' => 1));
			
			$DailyTempValue = $DailyTempValue[0]['DailyTempValue']['stat_value'];
			$DailyLightValue = $DailyLightValue[0]['DailyLightValue']['stat_value'];

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

	public function HighestTempBreak() {

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';
			$conditions = array("stat_name = 'highestTemp'")

			$HighestTemp = $this->DataStat->find('all', array('conditions' => $conditions,
														'order' =>'timestamp DESC', 'limit' => 1));
			
			$HighestTemp = $HighestTemp[0]['highestTemp']['stat_value'];

			if(!empty($HighestTemp)){
				try {
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$time = date("H:i:s");
					$message = $time . 'The Highest Temperature has been broken at: '. $HighestTemp . 'C.';
					$status = $twitter->send(utf8_encode($message));
					echo $status ? 'OK' : 'ERROR';
				} catch (Exception $e) {
					echo "Error: ".$e;
				}
			} else {
				echo "no values";
			}
	}

	public function LowestTempBreak() {

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';
			$conditions = array("stat_name = 'lowestTemp'")

			$LowestTemp = $this->DataStat->find('all', array('conditions' => $conditions,
														'order' =>'timestamp DESC', 'limit' => 1));
			
			$LowestTemp = $LowestTemp[0]['lowestTemp']['stat_value'];

			if(!empty($LowestTemp)){
				try {
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$time = date("H:i:s");
					$message = $time . 'The lowest temperature has been broken at: '. $LowestTemp . 'C.';
					$status = $twitter->send(utf8_encode($message));
					echo $status ? 'OK' : 'ERROR';
				} catch (Exception $e) {
					echo "Error: ".$e;
				}
			} else {
				echo "no values";
			}
	}

	public function HighestLightBreak() {

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';
			$conditions = array("stat_name = 'highestlight'")

			$highestLight = $this->DataStat->find('all', array('conditions' => $conditions,
														'order' =>'timestamp DESC', 'limit' => 1));
			
			$highestLight = $highestLight[0]['highestLight']['stat_value'];

			if(!empty($highestLight)){
				try {
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$time = date("H:i:s");
					$message = $time . 'The highest light level has been broken at: '. $highestLight . '.';
					$status = $twitter->send(utf8_encode($message));
					echo $status ? 'OK' : 'ERROR';
				} catch (Exception $e) {
					echo "Error: ".$e;
				}
			} else {
				echo "no values";
			}
	}

	public function LowestLightBreak() {

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';
			$conditions = array("stat_name = 'lowestLight'")

			$lowestLight = $this->DataStat->find('all', array('conditions' => $conditions,
														'order' =>'timestamp DESC', 'limit' => 1));
			
			$lowestLight = $lowestLight[0]['lowestLight']['stat_value'];

			if(!empty($lowestLight)){
				try {
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$time = date("H:i:s");
					$message = $time . 'The lowest light level has been broken at: '. $lowestLight . '.';
					$status = $twitter->send(utf8_encode($message));
					echo $status ? 'OK' : 'ERROR';
				} catch (Exception $e) {
					echo "Error: ".$e;
				}
			} else {
				echo "no values";
			}
	}

	public function IntCountBreak() {

		
			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';
			$conditions = array("stat_name = 'weeklyInteractions'")

			$weeklyInteractions = $this->DataStat->find('all', array('conditions' => $conditions,
														'order' =>'timestamp DESC', 'limit' => 1));

			$weeklyInteractions = $weeklyInteractions[0]['weeklyInteractions']['stat_value'];

			if(!empty($weeklyInteractions)){
				try {
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$time = date("H:i:s");
					$message = $time . 'There has been '. $weeklyInteractions . 'Interactions this week.';
					$status = $twitter->send(utf8_encode($message));
					echo $status ? 'OK' : 'ERROR';
				} catch (Exception $e) {
					echo "Error: ".$e;
				}
			} else {
				echo "no values";
			}
	}*/
}

