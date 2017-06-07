<?php

class Auto_schedule {
	private $CI;
	private $totalSecs = 3600;
	private $fillers = array();
	private $fillerFlag;

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
	
	private static function my_sort($a,$b){
		if ($a==$b) return 0;
		return ($a<$b)?-1:1;
	}
	
	public function do_sort($a){
		usort($a, array($this, 'my_sort'));
		return $a;
	}
	
	public function generateAdHour($timeslot, $day, $route) {
		$this->CI->load->model('nschedules_model');

		$where = array('status' => 0, 'timeslot' => $timeslot, 'route_id'=>$route);
		$ads = $this->CI->nschedules_model->getSchedules($where, $day);

		$count = count($ads);
		log_message('info', 'start filling ad airtime');
		for($i = 0; $i < $count; $i++) {
			log_message('info', 'start filling ad airtime for = '.$ads[$i]['ad_id']);
			$ads[$i]['totalAirTime'] = $this->provideAirtime((int)$ads[$i]['ad_duration']);
			$ads[$i]['totalLogoAirtime'] = $ads[$i]['totalAirTime'] - (int)$ads[$i]['ad_duration'];
			$ads[$i]['repeatCount'] = (int) 0;
		}

		$fillerFlag = $this->checkAdTotalAir($ads);

		$rundown = array();
		$i = $this->totalSecs;
		$x = 0;
		while($i > 0) {
			if($ads[$x]['display_type'] == 1) {
				if($ads[$x]['repeatCount'] < $ads[$x]['times_repeat']) {
					$ads[$x]['repeatCount'] = $ads[$x]['repeatCount'] + 1;
					$rundown[] = $ads[$x];
					$i -= $ads[$x]['totalAirTime'];
				}

				$filler = $this->getFiller();
				$i -= $filler['totalAirTime'];
				$filler['timeslot'] = $timeslot;
				$rundown[] = $filler;
				$x++;

			} else {
				$display = array();
				
				if($ads[$x]['repeatCount'] < $ads[$x]['times_repeat']) {
					$ads[$x]['repeatCount']++;
					$display[] = $ads[$x];
				
					$i -= $ads[$x]['totalAirTime'];
				}

				$x++;
				$y = $x;

				if(isset($ads[$y]) && count($ads[$y]) > 0) {
					if($ads[$y]['display_type'] != 2) {
						for($z = 0; $z < 2; $z++) {
							$filler = $this->getFiller();
							$i -= $filler['totalAirTime'];
							$filler['timeslot'] = $timeslot;
							$display[] = $filler;
						}
					} else {
						$limit = $y+2;
						for($j = $y; $j < $limit; $j++) {
							if($ads[$j]['display_type'] == 2) {
								if($ads[$x]['repeatCount'] < $ads[$x]['times_repeat']) {
									$ads[$j]['repeatCount']++;
									$display[] = $ads[$j];
									
									$i -= $ads[$j]['totalAirTime'];
								}
								$x++;
							} else {
								$fillerCount = 3 - count($display);

								while($fillerCount > 0) {
									$filler = $this->getFiller();
									$i -= $filler['totalAirTime'];
									$filler['timeslot'] = $timeslot;
									$display[] = $filler;
									$fillerCount--;
								}
							}
						}
					}
				} else {
					$fillerCount = 3 - count($display);

					while($fillerCount > 0) {
						$filler = $this->getFiller();
						$i -= $filler['totalAirTime'];
						$filler['timeslot'] = $timeslot;
						$display[] = $filler;
						$fillerCount--;
					}
					
					//$x = 0;
				}

				$rundown[] = $display;
			}

			if($x == $count)
				$x = 0;
		}
		
		return $rundown;
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