<?php
/*
    Author: Nathan
*/

class OverviewController extends AppController {
    //Setup database tables to use
    public $uses = array(
        'LightValue',
        'TempValue',
        'AverageLightValue',
        'AverageTempValue',
        'InteractionData',
	    'LocationData'
    );
    public $interactions = array();

    public function index(){
    }

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
