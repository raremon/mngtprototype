<?php

class Auto_schedule {
	private $CI;
	private $totalSecs = 3600;
	private $fillers = array();
	private $fillerFlag;
	
	// public $tmp = array();
	
	private $oink = array();

	public function __construct() {
		$this->CI =& get_instance();

		$this->setFillers();
		$this->fillerFlag = 0;
	}
	
	public function getTotalAirTime($ads){
		
		$total = 0;
		foreach($ads as $a){
			$total += $a['times_repeat']*$a['paid_duration'];
		}
		
		return $total;
		
	}

	public function rearrange_list($stack, $tmp){
		
		$temp = $tmp;
		
		foreach( $stack as $key => $s ){
			foreach( $tmp as $t ){			
				
				// echo "<br />".$s['id']."-".$t['id'];
								
				if( $s['id']!=$t['id'] ){
					if( $tmp[count($tmp)-1]['id']!=$s['id'] ){
						unset($stack[$key]);
						array_push($temp, $s);
					}
					break;
				}
				/* if( $s['id']!=$t['id'] ){
					// array_splice( $original, 3, 0, $inserted ); 
					array_splice( $tmp, $tmp[$ky+1], 0, $s ); 
					// if( $tmp[count($tmp)-1]['id']!=$s['id'] ){
					unset($stack[$key]);
						// array_push($temp, $s);
					// }
					break; 
				}		*/		
			}
		}
		return array($stack,$temp);
	}
	
	private static function my_sort($a,$b){
		if ($a==$b) return 0;
		return ($a<$b)?-1:1;
	}
	
	public function do_sort($a){
		usort($a, array($this, 'my_sort'));
		return $a;
	}
	
	public function custom_sort($list){
		
		$sorted = array();
		array_push($sorted,$list[0]);
		$init = $list[0];
		array_splice($list,0,1);
		
		while(count($list) != 0){
			
			$ctr = 0;
			foreach($list as $row){
				// if( $init == $row)
				$diff = array_diff_assoc($init, $row);
			
				if( $diff==0 ){    
				   $ctr += 1;
				}
				else{
				   array_push($sorted,$row);
				   $init = $row;
				   //echo $list[$ctr]." ".$ctr." ";
				   array_splice($list,$ctr,1);
				}
			}
		}
		return $sorted;
	}
	
	public function boosort($list){
		
		// $new = array();
		
		// $tmp = $list[0];
		// array_push($this->oink, $tmp);
		// array_splice($list, 0, 1);
		
		// echo "<br />count: ".count($this->oink);
		
		for($i=0; $i<=count($list); $i++){
			// echo "<br />list ".count($list);	
			$list = $this->haha($list);
			// array_push($new, $n);
			// echo "<br />New count: ".count($this->oink);
		}
		
		
		// echo count($list);
		// exit;
		// while( count($list)>0 ){
			// $ctr=0;
			// foreach($list as $row){
				// if( $row == $tmp ){
					// $ctr += 1;
				// }else{
					// array_push($new, $row);
					// $tmp = $row;
					// array_splice($list, $ctr, 1);
				// }
				// echo "<p>List count: ".count($list)."</p>";
					
			// }			
				
		// }
		
		return $this->oink;
	}
	
	private function haha($list){
		
		// echo "<br />Total list in haha: ".count($list);
		// echo "<br />count list in list[0]: ".count($list[0]);
		// print_r($list[0]);
		// exit;
		$tmp = array();
		$tmp = $list[0];
		array_push($this->oink,$tmp);
		// echo "<br />Oink count...: ".count($this->oink);
		array_splice($list, 0, 1);
		
		$ctr=0;
		foreach($list as $row){
			// echo $ctr;
			if( $row == $tmp ){
				$ctr += 1;
			}else{
				$tmp = $row;
				array_push($this->oink, $row);
				array_splice($list, $ctr, 1);
			}	
			
		}
		
		return $list;  			
	}

	private function checkAdTotalAir($ads) {
		$total = 0;
		log_message('info', 'check total start');
		foreach($ads as $ad) {
			log_message('debug', 'ad id = '.$ad['ad_id']);
			log_message('debug', 'ad total airtime = '.$ad['totalAirTime']);
			log_message('debug', 'ad repeat count = '.$ad['times_repeat']);

			$adTotal = $ad['totalAirTime'] * $ad['times_repeat'];

			$total += $adTotal;

			log_message('debug', 'total length = '.$total);
		}

		log_message('info', 'check total end');

		if($total == $this->totalSecs)
			return false;

		return true;
	}

	private function getFiller() {
		log_message('info', 'start get filler');
		log_message('debug', 'fillerFlag = '.$this->fillerFlag);
		log_message('debug', 'fillers = '.print_r($this->fillers, true));
		
		$count = count($this->fillers) - 1;
		$index = rand(0, $count);
		
		log_message('debug', 'filler random index = '.$index);
		
		$filler = $this->fillers[$index];

		return $filler;
	}

	private function setFillers() {
		$this->CI->load->model('fillers_model');

		$fillers = $this->CI->fillers_model->getFillers(array('status' => 0));

		$count = count($fillers);
		for($i = 0; $i < $count; $i++) {
			$fillers[$i]['totalAirTime'] = $this->provideAirtime($fillers[$i]['filler_duration']);
		}

		$this->fillers = $fillers;
	}

	private function provideAirtime($duration) {

		$totalAdLength = 0;
		$length = $duration;

		log_message('debug', 'init length = '.$length);
		log_message('debug', 'init total length = '.$totalAdLength);

		while($length > 0) {

			if($length >= 60 && $length > 45) {
				$length -= 60;
				$totalAdLength += 60;

				log_message('debug', '60 length = '.$length);
				log_message('debug', '60 total length = '.$totalAdLength);
			}

			if($length <= 45 && $length > 30) {
				$length -= 45;
				$totalAdLength += 45;

				log_message('debug', '45 length = '.$length);
				log_message('debug', '45 total length = '.$totalAdLength);
			}

			if($length <= 30 && $length > 15) {
				$length -= 30;
				$totalAdLength += 30;

				log_message('debug', '30 length = '.$length);
				log_message('debug', '30 total length = '.$totalAdLength);
			}

			if($length <= 15 && $length > 30 && $length >= 10) {
				$length -= 15;
				$totalAdLength += 15;

				log_message('debug', '15 length = '.$length);
				log_message('debug', '15 total length = '.$totalAdLength);
			}

			if($length <= 10 && $length > 0){
				$totalAdLength += 10;
				$length = 0;

				log_message('debug', '10 length = '.$length);
				log_message('debug', '10 total length = '.$totalAdLength);
			}
		}

		return $totalAdLength;
	}
}