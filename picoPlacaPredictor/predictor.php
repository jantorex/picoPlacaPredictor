<?php
class Predictor{
	private $numPlaca = null;
	private $date = null;
	private $time = null;
	private $result = false;
	
	function __construct($placa, $date, $time){
		$this->date = $date;
		$this->time = $time;
		$this->verifyPlaca($placa);
	}
	
	public function getResult(){
		return $this->result;
	}
	
	private function verifyPlaca($placa){
		if (is_string($placa)){
			$numChar = strlen($placa);
			$numChar--;
			if ($numChar == 5 || $numChar == 6){
				$lastNumber = $placa[$numChar];
				if (is_numeric($lastNumber)){
					$this->numPlaca = $lastNumber;
					$this->verifyDate();
				}else{
					throw new InvalidArgumentException("The licence plate number is invalid.");
				}
			}else{
				throw new InvalidArgumentException("The licence plate number must have eather 6 or 7 characters.");
			}
		}else{
			throw new InvalidArgumentException("The licence plate number is invalid.");
		}
	}
	
	private function verifyDate(){
		try {
			$dateTime  = new DateTime($this->date);
		}catch (Exception $e){
			throw new InvalidArgumentException($e->getMessage());
		}
		$day_of_week = $dateTime->format("w");
		$resultTime = false;
		switch ($day_of_week){
			case 1:
				if ($this->numPlaca != 1 && $this->numPlaca != 2){
					$this->result = true;
				}else{
					$resultTime = $this->verifyTime();
					$this->result = $resultTime;
				}
				break;
			case 2:
				if ($this->numPlaca != 3 && $this->numPlaca != 4){
					$this->result = true;
				}else{
					$resultTime = $this->verifyTime();
					$this->result = $resultTime;
				}
				break;
			case 3:
				if ($this->numPlaca != 5 && $this->numPlaca != 6){
						$this->result = true;
				}else{
					$resultTime = $this->verifyTime();
					$this->result = $resultTime;
				}
				break;
			case 4:
				if ($this->numPlaca != 7 && $this->numPlaca != 8){
					$this->result = true;
				}else{
					$resultTime = $this->verifyTime();
					$this->result = $resultTime;
				}
				break;
			case 5:
				if ($this->numPlaca != 9 && $this->numPlaca != 0){
					$this->result = true;
				}else{
					$resultTime = $this->verifyTime();
					$this->result = $resultTime;
				}
				break;
		}
	}
	
	private function verifyTime(){
		try {
			$dateTime  = new DateTime($this->time);
		}catch (Exception $e){
			throw new InvalidArgumentException($e->getMessage());
		}
		$timelimitMorn1 = new DateTime("07:00");
		$timelimitMorn2 = new DateTime("09:30");
		$timelimitEve1 = new DateTime("16:00");
		$timelimitEve2 = new DateTime("19:30");

		if (($dateTime >= $timelimitMorn1 && $dateTime<= $timelimitMorn2) || ($dateTime>= $timelimitEve1 && $dateTime <= $timelimitEve2)){
			return false;
		}
		return true;
	}
}
?>