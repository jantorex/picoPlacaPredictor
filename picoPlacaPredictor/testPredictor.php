<?php
use PHPUnit\Framework\TestCase;
require_once 'predictor.php';

class testPredictor extends TestCase{
	
	public function testNoPicoPlaca(){
		$result = new Predictor("PCG8641","2018-03-02","13:38");
		$this->assertEquals(true, $result->getResult());
		
		$result2 = new Predictor("PCG8643","2018-02-27","18:38");
		$this->assertEquals(false, $result2->getResult());
	}
	
	public function testIsPicoPlaca(){
		$result = new Predictor("PCG8641","2018-02-26","7:01");
		$this->assertEquals(false, $result->getResult());
		
		$result2 = new Predictor("PCG8645","2018-02-26","7:01");
		$this->assertEquals(true, $result2->getResult());
	}
	
	public function testFormatDate(){
		$this->expectException(InvalidArgumentException::class);
		new Predictor("PCG8641","string","13:38");
	}
	
	public function testFormatTime(){
		$this->expectException(InvalidArgumentException::class);
		new Predictor("PCG8641","2018-02-26","string");
	}
	
	public function testFormatPlaca(){
		$this->expectException(InvalidArgumentException::class);
		new Predictor("PCG86411","2018-02-26","13:38");
	}
	
	public function testFormatPlaca2(){
		$this->expectException(InvalidArgumentException::class);
		new Predictor("P8641","2018-02-26","13:38");
	}
	
	public function testFormatPlaca3(){
		$this->expectException(InvalidArgumentException::class);
		new Predictor("P8641l","2018-02-26","13:38");
	}
}
?>