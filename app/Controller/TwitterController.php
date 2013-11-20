<?php 
App::uses('Twitter','Vendor');
App::uses('twitteroauth.php','Vendor');


class TwitterController extends AppController {


	public $uses = array('FollowerId', 'AverageLightValue','AverageTempValue');


	public function sendHourTweet(){

			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';

			$lastLightValue = $this->AverageLightValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));
			$lastTempValue = $this->AverageTempValue->find('all', array('order' =>'timestamp DESC', 'limit' => 1));
			
		try {

			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('Summary for the last two hours: Average Temperature was: ' . $lastTempValue . ', Average light was: ' . $lastLightValue);
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}


	//sendHourTweet();
	/*public function inDB($id){
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
		$connection = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

		$url = 'https://api.twitter.com/1.1/followers/list.json?cursor=-1&screen_name=sitestreams&skip_status=true&include_user_entities=false'; //URL of API to be used
		$requestMethod = 'GET'; //type of method to be used 'GET' or 'POST', 

		$followers = $connection->cachedRequest('followers/ids', array('user_id' => '2164730497')); //get followers through cachedRequest function(twitter.class.php)
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

	public function sendHourlyTweet($HourlyaverageTemp, $HourlyaverageLight, $HourlyinteractionCount ) {

		try {
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('Summary for the last hour: Average Temperature was: ' . $HourlyaverageTemp . ', Average light was: ' . $HourlyaverageLight . ', ' . $HourlyinteractionCount . 'objects were interacted with');
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}

	public function sendDailyTweet($DailyaverageTemp, $DailyaverageLight, $DailyinteractionCount ) {

		try {
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('Summary for today: Average Temperature was: ' . $DailyaverageTemp . ', Average light was:' . $DailyaverageLight . ',' .$DailyinteractionCount . 'objects were interacted with');
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}

	public function sendWeeklyTweet($WeeklyaverageTemp, $WeeklyaverageLight, $WeeklyinteractionCount ) {

		try {
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('Summary for the previous Week : Average Temperature was: ' . $WeeklyaverageTemp . ', Average light was:' . $WeeklyaverageLight . ',' .$WeeklyinteractionCount . 'objects were interacted with');
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}

	public function HighestTempBreak($RecordHighestTemp) {

		try {
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('Highest recorded temperature has been broken at:'.$RecordHighestTemp);
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}

	public function LowestTempBreak($RecordLowestTemp) {

		try {
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('Lowest recorded temperature has been broken at: '.$RecordLowestTemp);
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}

	public function HighestLightBreak($RecordHighestLight) {

		try {
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('Highest recorded light level has been broken, New value: '.$RecordHighestLight);
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}

	public function LowestLightBreak($RecordLowestLight) {

		try {
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('Lowest recorded light level has been broken, New value:'.$RecordLowestLight);
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}

	public function IntCountBreak($RecordCount) {

		try {
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			$status = $twitter->send('The record amount of interactions has been broken, New count: '.$RecordCount);
			echo $status ? 'OK' : 'ERROR';
		} catch (Exception $e) {
			echo "Error: ".$e;
		}
	}

*/

}

