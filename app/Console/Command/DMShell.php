<?php

class DMShell extends Shell{
	
	public $uses = array('FollowerId', 'AverageLightValue','AverageTempValue');

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
	public function dMShell(){
		App::uses('Twitter2','Vendor');
		App::uses('twitteroauth.php','Vendor');

			//twitter credentials & OAuth settings 
			$consumerKey 		= 'f13aHtOr8H6P85kud4qx3Q'; 
			$consumerSecret 	= '5RxwNk4QGmfV0Y56K6ViPTOQrWpgvjqn7lfJp5ZwQ';
			//Access tokens "oauth_token"
			$accessToken 		= '2164730497-HmrMmBDCJooJmQPtU3S1QOOzlXHd62xzO7VY2u1';
			$accessTokenSecret 	= 'Sml2EmLI8YSGSlNwXxjJMImtUkV7l4zYRiz8juoLqsYBb';

			$method = 'direct_messages/new'; //method to be used
			//$website = "luisls.info"; //website URL
			//$web_enc = rawurlencode("http://luisls.info");
			//$fbLink = "https://www.facebook.com/luisls"; //facebook link
	try {
		$connection = new Twitter2($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
		$url = 'https://api.twitter.com/1.1/followers/list.json?cursor=-1&screen_name=sitestreams&skip_status=true&include_user_entities=false'; //URL of API to be used
		$requestMethod = 'GET'; //type of method to be used 'GET' or 'POST', 
		$followers = $connection->cachedRequest('followers/ids', array('user_id' => '2164730497')); //get followers through cachedRequest function(twitter.class.php)
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
}