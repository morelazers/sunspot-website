<?php

class GraphsController extends AppController {
    
    public $uses = array(
        'LightValue', 
        'TempValue', 
        'AverageLightValue', 
        'AverageTempValue',
        'InteractionData',
        'LocationData',
        'SpotColour'
    );

    /*
    *   This should be the only display function that we need.
    */
    public function main(){

    }
	public function touch(){
	}
    /*public function interactions(){
        
        $interactions = $this->InteractionData->find('all', array('order' => array('InteractionData.timestamp DESC')));
        
        //debug($interactions);
        
        // Declare arrays
        $days = array();
        $hours = array();
        
        // hourly interaction count
        $hourCount = 0;
        $dayCount = 0;
        
        // current time
        $time = time();
        
        // yesterday
        $yesterday = date("j", ($time - 86400));
        
        // loop through interactions
        foreach ($interactions as $interaction){
        
            // get time of each interaction
            $timestamp = strtotime($interaction['InteractionData']['timestamp']);
            
            // get date of each interactions
            $day = date("j", $timestamp);
            
            // if it occurred yesterday add it to the array
            if($day === $yesterday){
                $hour = date("G", $timestamp);
                $hours[$hour][$hourCount] = $interaction;
                $hourCount++;
            }
            
            // add it to the array keyed by the day of the month
            $days[$day][$dayCount] = $interaction;
            $dayCount++;
        }
        
        /*
         * Get the details of the busiest day in the last month
         */
        
        /*
        $highCount = 0;
        
        $dailyCounts = array_map("count", $days);
        
        $highCount = max($dailyCounts);
        
        $flippedDailycounts = array_flip($dailyCounts);
        
        $mostDailyInteractions = $flippedDailycounts[$highCount];
        
        $listOfInteractions = $days[$mostDailyInteractions];
        
        $busiestDay = array('door' => 0, 'fridge' => 0, 'whiteboard' => 0, 'date' => $mostDailyInteractions);
        $busiestHour = array('door' => 0, 'fridge' => 0, 'whiteboard' => 0);
        
        foreach($listOfInteractions as $interaction){
            $busiestDay[strtolower($interaction['InteractionData']['object_name'])]++;
        }
        
        $this->set(
            array(
                'interactions' => $interactions,
                'busiestDay' => $busiestDay,
                'busiestHour' => $busiestHour
            )
        );
        
    }*/
    
    public function getHourlyLightData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $daysToGoBack = $this->request->data['daysToGoBack'];
            
            // get now
            $time = time();
            
            // get x days back
            $timestamp = $time - ($daysToGoBack * 86400);
            
            // get x + 1 days back
            $endTime = $time - (($daysToGoBack - 1) * 86400);
            
            // start date
            $startDate = date("Y-m-d", $timestamp);
            
            // end date of now
            $endDate = date("Y-m-d", $endTime);
            
            $conditions = array('LightValue.timestamp BETWEEN ? and ?' => array($startDate, $endDate));
            $averageLight = $this->LightValue->find('all', array('conditions' => $conditions));
            
            $zone1Vals = array();
            $zone2Vals = array();
            $zone3Vals = array();
            foreach($averageLight as $lightVal){
                $time = strtotime($lightVal['LightValue']['timestamp']);
                $date = date("G", $time);
                $hour = intval($date);
                
                if($lightVal['LightValue']['lab_zone'] === '1'){
                    $zone1Vals[$hour + 1] = $lightVal['LightValue']['reading_value'];
                } else if($lightVal['LightValue']['lab_zone'] === '2'){
                    $zone2Vals[$hour + 1] = $lightVal['LightValue']['reading_value'];
                } else if($lightVal['LightValue']['lab_zone'] === '3'){
                    $zone3Vals[$hour + 1] = $lightVal['LightValue']['reading_value'];
                }
            }
            
            echo json_encode(array('zone1Vals' => $zone1Vals, 'zone2Vals' => $zone2Vals, 'zone3Vals' => $zone3Vals, 'daysBack' => $daysToGoBack));
        }
    }
    
    public function getHourlyTempData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $daysToGoBack = $this->request->data['daysToGoBack'];
            
            // get now
            $time = time();
            
            // get x days back
            $timestamp = $time - ($daysToGoBack * 86400);
            
            // get x + 1 days back
            $endTime = $time - (($daysToGoBack - 1) * 86400);
            
            // start date
            $startDate = date("Y-m-d", $timestamp);
            
            // end date of now
            $endDate = date("Y-m-d", $endTime);
            
            $conditions = array('TempValue.timestamp BETWEEN ? and ?' => array($startDate, $endDate));
            $averageTemp = $this->TempValue->find('all', array('conditions' => $conditions));
            
            $zone1Vals = array();
            $zone2Vals = array();
            $zone3Vals = array();
            foreach($averageTemp as $tempVal){
                $time = strtotime($tempVal['TempValue']['timestamp']);
                $date = date("G", $time);
                $hour = intval($date);
                
                if($tempVal['TempValue']['lab_zone'] === '1'){
                    $zone1Vals[$hour + 1] = $tempVal['TempValue']['reading_value'];
                } else if($tempVal['TempValue']['lab_zone'] === '2'){
                    $zone2Vals[$hour + 1] = $tempVal['TempValue']['reading_value'];
                } else if($tempVal['LightValutempVale']['lab_zone'] === '3'){
                    $zone3Vals[$hour + 1] = $tempVal['TempValue']['reading_value'];
                }
            }
            
            echo json_encode(array('zone1Vals' => $zone1Vals, 'zone2Vals' => $zone2Vals, 'zone3Vals' => $zone3Vals, 'daysBack' => $daysToGoBack));
        }
    }
    
    public function getDailyLightData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $averageLight = $this->AverageLightValue->find('all');
            
            $monthsToGoBack = $this->request->data['monthsToGoBack'];
            
            // get now
            $time = time();
            
            // get x days back
            $timestamp = $time - ($monthsToGoBack * (30 * 86400));
            
            // get x + 1 days back
            $endTime = $time - (($monthsToGoBack - 1) * (30 * 86400));
            
            // start date
            $startDate = date("Y-m-d", $timestamp);
            
            // end date of now
            $endDate = date("Y-m-d", $endTime);
            
            $conditions = array('AverageLightValue.timestamp BETWEEN ? and ?' => array($startDate, $endDate));
            $averageLight = $this->AverageLightValue->find('all', array('conditions' => $conditions));
            
            $lightVals = array();
            foreach($averageLight as $lightVal){
                $time = strtotime($lightVal['AverageLightValue']['timestamp']);
                $date = date("j", $time);
                $day = intval($date);
                
                $lightVals[$day + 1] = $lightVal['AverageLightValue']['reading_value'];
            }
            
            echo json_encode(array('values' => $lightVals, 'monthsBack' => $monthsToGoBack));
        }
    }
    
    public function getDailyTempData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $averageTemp = $this->AverageTempValue->find('all');
            
            $monthsToGoBack = $this->request->data['monthsToGoBack'];
            
            // get now
            $time = time();
            
            // get x days back
            $timestamp = $time - ($monthsToGoBack * (30 * 86400));
            
            // get x + 1 days back
            $endTime = $time - (($monthsToGoBack - 1) * (30 * 86400));
            
            // start date
            $startDate = date("Y-m-d", $timestamp);
            
            // end date of now
            $endDate = date("Y-m-d", $endTime);
            
            $conditions = array('AverageTempValue.timestamp BETWEEN ? and ?' => array($startDate, $endDate));
            $averageTemp = $this->AverageTempValue->find('all', array('conditions' => $conditions));
            
            
            $tempVals = array();
            foreach($averageTemp as $tempVal){
                $time = strtotime($tempVal['AverageTempValue']['timestamp']);
                $date = date("j", $time);
                $day = intval($date);
                
                $tempVals[$day + 1] = $tempVal['AverageTempValue']['reading_value'];
            }
            
            echo json_encode(array('values' => $tempVals, 'MonthsBack' => $monthsToGoBack));
        }
    }
    
    /*    
    public function getInteractionData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $interactionData = $this->InteractionData->find('all');
            
            echo json_encode(array('history' => $interactionData));
        }
    }
    */

    /*
    *
    *   Formally the OverviewController.php
    *
    */

    public $interactions = array();
/*
    public function getDayList(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $time = time();
            $x = 0;
            $dates = array();
            for($x = 0; $x < 7; $x++){
                $timestamp = $time - ($x * 86400);
                $date = date("Y-m-d", $timestamp);
                array_push($dates, $date);
            }
            echo json_encode(array('dates' => $dates));
        }
    } */

    public function getHourList(){
    if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $curDate = $this->request->data['curDate'];
            $hours = array();
            for($x = 0; $x <24; $x++){
                $datetime = $curDate . " " . $x . ":00:00";
                if($this->getLight($datetime)!=null){
                    if($this->getTemp($datetime)!=null){
                        if($this->getInteractions($datetime)!=null){
                            if($this->getswitchData($datetime)!=null){
                            array_push($hours, $x . ":00:00");
                            }
                        }
                    }
                }
            }
            echo json_encode(array('hours' => $hours));
        }
    }

   /* public function getLight($datetime){
        $timestamp = date("Y-m-d H:i:s", strtotime($datetime));
        $conditions = array("(DAYOFYEAR(AverageLightValue.timestamp) =  DAYOFYEAR(?))" => $timestamp,
                    "(HOUR(AverageLightValue.timestamp) = HOUR(?))" => $timestamp);
        $light = $this->AverageLightValue->find('all', array('conditions' => $conditions));
        return $light;
    }
    public function getTemp($datetime){
        $timestamp = date("Y-m-d H:i:s", strtotime($datetime));
        $conditions = array('DAYOFYEAR(AverageTempValue.timestamp)= DAYOFYEAR(?)' => $timestamp,
                                'HOUR(AverageTempValue.timestamp) = HOUR(?)' => $timestamp);
        $temp = $this->AverageTempValue->find('all', array('conditions' => $conditions));
        return $temp;
    }*/
    public function getInteractions($datetime){
        $timestamp = date("Y-m-d H:i:s", strtotime($datetime));
        $conditions = array('DAYOFYEAR(InteractionData.timestamp) = DAYOFYEAR(?)' => $timestamp,
                                'HOUR(InteractionData.timestamp) = HOUR(?)' => $timestamp);
        $interactions = $this->InteractionData->find('all', array('conditions' => $conditions));
        return $interactions;
    }
    /*public function getLocations($datetime){
        $timestamp = date("Y-m-d H:i:s", strtotime($datetime));
        $conditions = array('DAYOFYEAR(LocationData.timestamp) = DAYOFYEAR(?)' => $timestamp,
                                'HOUR(LocationData.timestamp) = HOUR(?)' => $timestamp);
        $locations = $this->LocationData->find('all', array('conditions' => $conditions));
        return $locations;
    }
    public function getTempVal(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $curDateTime = $this->request->data['curDateTime'];
            $tempArray = $this->getTemp($curDateTime);
            $temp = $tempArray[0]['AverageTempValue']['reading_value'];
            echo json_encode(array('temp' => $temp));
        }
    }
*/

	public function getInteractionData(){
		if($this->request->is('ajax')){
			$this->layout = 'ajax';
			$this->autoRender = false;
			$i = 0;
			$interactionsReadings = array();
			$results = array();
			for($i = 1; $i<5; $i++){
			$conditions = array();
			$results = $this->InteractionData->find('first', 
						array('conditions' => $conditions, 
						'order' => array('InteractionData.timestamp' => 'desc')));
				array_push($interactionsReadings, $results);
			}
		echo json_encode(array('interactionsReadings' => $interactionsReadings));
		}	
	}
    /*public function getInteractionData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $curDateTime = date("Y-m-d H:i:s", ($timestamp = time()));
            $interactions = $this->getInteractions($curDateTime);
            $interactionArray = array();
            foreach($interactions as $interaction) {
                $time = strtotime($interaction['InteractionData']['timestamp']);
                array_push($interactionArray, '
                <li class="active '. strtolower($interaction['InteractionData']['object_name']) . '>
                    <div class="separator bottom">
                        <span class="date box-generic">
                        '
                            
                            . date("d M", $time) .
                        '
                        </span>
                        <span class="type glyphicons">
                            <span class="time">
                            
                            </span>
                        </span>
                    </div>
                    <div class="widget widget-heading-simple widget-body-white margin-none">
                        <div class="widget-body">
                            <div class="media">
                                <div class="media-object pull-left thumb">
                                    
                                </div>
                                <div class="media-body">
                                    '
                                        
                                       . strtolower($interaction['InteractionData']['object_name']) . ' was interacted with at '. date("G:i", $time) .' !'
                                    . '
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                ');
            }
            echo json_encode(array('interactions' => $interactionArray));

        }
    }*/

    public function getMovementData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $curDateTime = $this->request->data['curDateTime'];
            $movements = $this->getLocations($curDateTime);
            $movementArray = array();
            foreach($movements as $movement) {
                $time = strtotime($movement['LocationData']['timestamp']);
                array_push($movementArray, '
                <li class="active '. strtolower($movement['LocationData']['spot_address']) . '>
                    <div class="separator bottom">
                        <span class="date box-generic">
                        '
                            
                            . date("d M", $time) .
                        '
                        </span>
                        <span class="type glyphicons">
                            <span class="time">
                            
                            </span>
                        </span>
                    </div>
                    <div class="widget widget-heading-simple widget-body-white margin-none">
                        <div class="widget-body">
                            <div class="media">
                                <div class="media-object pull-left thumb">
                                    
                                </div>
                                <div class="media-body">
                                    '
                                        
                                       . strtolower($movement['LocationData']['spot_address']) . ' moved to zone '. $movement['LocationData']['lab_zone'] . ' at time ' . date("G:i", $time) .' !'
                                    . '
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                ');
            }
            echo json_encode(array('movements' => $movementArray));

        }
    }

    public function getLiveMovementData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;

            $timestamp = date("Y-m-d H:i:s", ($timestamp = time()));

            

           /* $conditions = array('DAYOFYEAR(LocationData.timestamp) = DAYOFYEAR(?)' => $timestamp,
                                    'HOUR(LocationData.timestamp) = HOUR(?)' => $timestamp);*/

            $conditions = array('timestamp >=' => $timestamp);
            $locations = $this->LocationData->find('all', array('conditions' => $conditions, 'limit' => 1));



            

            foreach($locations as $location){
                $zone = $location['LocationData']['lab_zone'];
                $spotAddr = $location['LocationData']['spot_address'];
                $time = $location['LocationData']['timestamp'];
            }

            

            //$locations = $this->LocationData->find('all', array('limit' => 1));

            if(!empty($locations)){
                $color = $this->SpotColour->find('all', array('conditions' => array('SpotColour.spot_address' => $spotAddr), 'limit' => 1, 'order' => 'SpotColour.timestamp DESC'));
                if(!empty($colour)){
                    $colourIndex = $colour['SpotColour']['colour_index'];
                    echo json_encode(array('zone' => $zone, 'spotAddr' => $spotAddr, 'timestamp' => $timestamp, 'colour' => $colourIndex));
                } else {
                    echo json_encode(array('zone' => $zone, 'spotAddr' => $spotAddr, 'timestamp' => $timestamp));
                }
                
            }
            
        }
        
    }

    public function getHourlyMovementData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;

/*            $daysToGoBack = $this->request->data['daysToGoBack'];
            
            // get now
            $time = time();
            
            // get x days back
            $timestamp = $time - ($daysToGoBack * 86400);
            
            // get x + 1 days back
            $endTime = $time - (($daysToGoBack - 1) * 86400);
            
            // start date
            $startDate = date("Y-m-d", $timestamp);
            
            // end date of now
            $endDate = date("Y-m-d", $endTime);
            
            //$conditions = array('LocationData.timestamp BETWEEN ? and ?' => array($startDate, $endDate));
            */
            $locationHistory = $this->LocationData->find('all');

            debug($locationHistory);

            $zone1Vals = array();
            $zone2Vals = array();
            $zone3Vals = array();
            foreach($locationHistory as $locationVal){
                if($locationVal['LocationData']['lab_zone'] === '1'){
                    $zone1Vals[] = $locationVal['LocationData']['reading_value'];
                } else if($locationVal['LocationData']['lab_zone'] === '2'){
                    $zone2Vals[] = $locationVal['LocationData']['reading_value'];
                } else if($locationVal['LocationData']['lab_zone'] === '3'){
                    $zone3Vals[] = $locationVal['LocationData']['reading_value'];
                }
            }

            if(!empty($locationHistory)){
                echo json_encode(array('zone1Vals' => $zone1Vals, 'zone2Vals' => $zone2Vals, 'zone3Vals' => $zone3Vals));
            }

        }
    }
	
/*
	Author: Ryan
*/

    public function getLiveLight(){
	if($this->request->is('ajax')){
		$this->layout = 'ajax';
        $this->autoRender = false;
		$i = 0;
		$lightReadings = array();
		$results = array();
		for($i = 1; $i < 4; $i++){
				$conditions = array('LightValue.lab_zone = ?' => $i);
				$results = $this->LightValue->find('first', 
										array('conditions' => $conditions, 
										'order' => array('LightValue.timestamp' => 'desc')));
				if(!empty($results) ){
					array_push($lightReadings, $results);
				}else{
					//print("No Light Data From Database");
				}
			}
		echo json_encode(array('lightReadings' => $lightReadings));
		}
	}
    public function getLiveTemp(){
	if($this->request->is('ajax')){
		$this->layout = 'ajax';
        $this->autoRender = false;
		$i = 0;
		$tempReadings = array();
		$results = array();
		for($i = 1; $i < 4; $i++){
				$conditions = array('TempValue.lab_zone = ?' => $i);
				$results = $this->TempValue->find('first', 
										array('conditions' => $conditions, 
										'order' => array('TempValue.timestamp' => 'desc')));
				if(!empty($results)){
					array_push($tempReadings, $results);
				}else{
					//print("No Temp Data From Database");
				}
			}
		echo json_encode(array('tempReadings' => $tempReadings));
		}
	}  

    public function getLiveSwitchPress(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;

            $timestamp = date("Y-m-d H:i:s", ($timestamp = time()));

            $conditions = array('timestamp >=' => $timestamp);
            $switchData = $this->SpotColour->find('all', array('conditions' => $conditions, 'limit' => 1));

            foreach($switchData as $switchPress){
                $colourIndex = $switchPress['SpotColour']['colour_index'];
                $spotAddr = $switchPress['SpotColour']['spot_address'];
                $time = $switchPress['SpotColour']['timestamp'];
            }

            if(!empty($switchData)){
                echo json_encode(array('colourId' => $colourIndex, 'spotAddr' => $spotAddr, 'timestamp' => $timestamp));
            }
        }
    }

/*
    Author: Nathan
*/


    public function index(){
    }

    public function getDayList(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $time = time();
            $x = 0;
            $dates = array();
            for($x = 0; $x < 31; $x++){
            $timestamp = $time - ($x * 86400);
            $date = date("Y-m-d", $timestamp);
            array_push($dates, $date);
            }
            echo json_encode(array('dates' => $dates));
        }
    }

    public function getHourListTemp(){
        if($this->request->is('ajax')){
                $this->layout = 'ajax';
                $this->autoRender = false;
            $curDate = $this->request->data['curDate'];
            $hours = array();
            for($x = 0; $x <24; $x++){
                $datetime = $curDate . " " . $x . ":00:00";
                if($this->getTemp($datetime)!=null){
                    array_push($hours, $x . ":00:00");
                }
            }
            echo json_encode(array('hours' => $hours));
        }
    }
    public function getHourListLight(){
        if($this->request->is('ajax')){
                $this->layout = 'ajax';
                $this->autoRender = false;
            $curDate = $this->request->data['curDate'];
            $hours = array();
            for($x = 0; $x <24; $x++){
                $datetime = $curDate . " " . $x . ":00:00";
                if($this->getLight($datetime)!=null){
                    array_push($hours, $x . ":00:00");
                }
            }
            echo json_encode(array('hours' => $hours));
        }
    }

    public function getLight($datetime){
    $timestamp = date("Y-m-d H:i:s", strtotime($datetime));
    $conditions = array("(DAYOFYEAR(LightValue.timestamp) =  DAYOFYEAR(?))" => $timestamp,
                "(HOUR(LightValue.timestamp) = HOUR(?))" => $timestamp);
    $light = $this->LightValue->find('all', array('conditions' => $conditions));
    return $light;
    }
    public function getTemp($datetime){
        $timestamp = date("Y-m-d H:i:s", strtotime($datetime));
        $conditions = array('DAYOFYEAR(TempValue.timestamp)= DAYOFYEAR(?)' => $timestamp,
                                'HOUR(TempValue.timestamp) = HOUR(?)' => $timestamp);
        $temp = $this->TempValue->find('all', array('conditions' => $conditions));
        return $temp;
    }
    

    public function getTempVal(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
        $curDateTime = $this->request->data['curDateTime'];
        $tempArray = $this->getTemp($curDateTime);
        $temp = $tempArray[0]['AverageTempValue']['reading_value'];
        echo json_encode(array('temp' => $temp));
        }
    }
    public function getLightVal(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
        $curDateTime = $this->request->data['curDateTime'];
        $lightArray = $this->getLight($curDateTime);
        $light = $lightArray[0]['AverageLightValue']['reading_value'];
        echo json_encode(array('light' => $light));
        }
    }
    public function getAverageTempData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
        $curDate = $this->request->data['curDate'];
        $timestamp = date("Y-m-d H:i:s", strtotime($curDate));
        $conditions = array('DAYOFYEAR(AverageTempValue.timestamp)= DAYOFYEAR(?)' => $timestamp);
        $temp = $this->AverageTempValue->find('all', array('conditions'=>$conditions));
        echo json_encode(array('averages' => $temp));
        }
    }
    
    /*
     * (http://goo.gl/OJ6Aqt).
     *
     */
    public function getAverageLightData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
        $curDate = $this->request->data['curDate'];
        $timestamp = date("Y-m-d H:i:s", strtotime($curDate));
        $conditions = array('DAYOFYEAR(AverageLightValue.timestamp)= DAYOFYEAR(?)' => $timestamp);
        $temp = $this->AverageLightValue->find('all', array('conditions'=>$conditions));
        echo json_encode(array('averages' => $temp));
        }
    }
    public function getRawTempData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $curDateTime = $this->request->data['curDateTime'];
            $timestamp = date("Y-m-d H:i:s", strtotime($curDateTime));
            $conditions = array("(DAYOFYEAR(TempValue.timestamp)= DAYOFYEAR(?))" => $timestamp,
                                    "(HOUR(TempValue.timestamp) = HOUR(?))" => $timestamp);
            $temp = $this->TempValue->find('all', array('conditions'=>$conditions));
            echo json_encode(array('raw' => $temp));
        }
    }
    public function getRawLightData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $curDateTime = $this->request->data['curDateTime'];
            $timestamp = date("Y-m-d H:i:s", strtotime($curDateTime));
            $conditions = array("(DAYOFYEAR(LightValue.timestamp)= DAYOFYEAR(?))" => $timestamp,
                                    "(HOUR(LightValue.timestamp) = HOUR(?))" => $timestamp);
            $temp = $this->LightValue->find('all', array('conditions'=>$conditions));
            echo json_encode(array('raw' => $temp));
        }
    }
    public function getLiveLightData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $time = $this->request->data['tmpTime'];
            $timestamp = date("Y-m-d H:i:s", ($time/1000));
            $conditions = array("LightValue.timestamp > ?" => $timestamp);
            $vals = $this->LightValue->find('all', array('conditions'=>$conditions,
                                             'order' => array("LightValue.timestamp" => 'asc')));
            echo json_encode(array('vals' => $vals));
        }
    }
    public function getLiveTempData(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $time = $this->request->data['tmpTime'];
            $timestamp = date("Y-m-d H:i:s", ($time/1000));
            $conditions = array("TempValue.timestamp > ?" => $timestamp);
            $vals = $this->TempValue->find('all', array('conditions'=>$conditions,
                                             'order' => array("TempValue.timestamp" => 'asc')));
            echo json_encode(array('vals' => $vals));
        }
    }
}

?>