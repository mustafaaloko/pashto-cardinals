<?php

use Aloko\PashtoCardinals\PashtoCardinal;

class PashtoCardinalTest extends \PHPUnit_Framework_TestCase
{
    public function test_number_is_converted_to_text()
    {
    	$numberInText = (new PashtoCardinal(8))->convertToText();
        $expected = 'Ata';

        $this->assertEquals($numberInText, $expected);
    }

    public function test_ones_conversion() 
    {
    	$this->assertEquals((new PashtoCardinal(1))->convertToText(), 'Yaw');
        $this->assertEquals((new PashtoCardinal(2))->convertToText(), 'Dwa');
        $this->assertEquals((new PashtoCardinal(3))->convertToText(), 'Dre');
        $this->assertEquals((new PashtoCardinal(4))->convertToText(), 'Salor');
        $this->assertEquals((new PashtoCardinal(5))->convertToText(), 'Penza');
        $this->assertEquals((new PashtoCardinal(6))->convertToText(), 'Eshpag');
        $this->assertEquals((new PashtoCardinal(7))->convertToText(), 'Owa');
        $this->assertEquals((new PashtoCardinal(8))->convertToText(), 'Ata');
        $this->assertEquals((new PashtoCardinal(9))->convertToText(), 'Nah');
    }

    public function test_tens_lesser_than_twenty_one() 
    {
    	$this->assertEquals((new PashtoCardinal(11))->convertToText(), 'Yawolas');
        $this->assertEquals((new PashtoCardinal(12))->convertToText(), 'Dwalas');
        $this->assertEquals((new PashtoCardinal(13))->convertToText(), 'Deyarlas');
        $this->assertEquals((new PashtoCardinal(14))->convertToText(), 'Sowarlas');
        $this->assertEquals((new PashtoCardinal(15))->convertToText(), 'Penzalas');
        $this->assertEquals((new PashtoCardinal(16))->convertToText(), 'Eshparlas');
        $this->assertEquals((new PashtoCardinal(17))->convertToText(), 'Owalas');
        $this->assertEquals((new PashtoCardinal(18))->convertToText(), 'Atalas');
        $this->assertEquals((new PashtoCardinal(19))->convertToText(), 'Nolas');
        $this->assertEquals((new PashtoCardinal(20))->convertToText(), 'Shel');
    }

    public function test_tens_bigger_than_thirty() 
    {
    	$this->assertEquals((new PashtoCardinal(30))->convertToText(), 'Dersh');
    	$this->assertEquals((new PashtoCardinal(50))->convertToText(), 'Panzos');

    	$this->assertEquals((new PashtoCardinal(41))->convertToText(), 'Yaw Salwikht');
    	$this->assertEquals((new PashtoCardinal(62))->convertToText(), 'Dwa Eshpeta');
    	$this->assertEquals((new PashtoCardinal(73))->convertToText(), 'Dre Awyaa');
    	$this->assertEquals((new PashtoCardinal(84))->convertToText(), 'Salor Atyaa');
    	$this->assertEquals((new PashtoCardinal(97))->convertToText(), 'Owa Nawee');
    }

    public function test_tens_between_twenty_and_thirty() 
    {
    	$this->assertEquals((new PashtoCardinal(21))->convertToText(), 'Yaw Wisht');
    	$this->assertEquals((new PashtoCardinal(23))->convertToText(), 'Dre Wisht');
    	$this->assertEquals((new PashtoCardinal(29))->convertToText(), 'Nah Wisht');
    }

    public function test_hunderds_smaller_than_two_hundred() 
    {
    	$this->assertEquals((new PashtoCardinal(101))->convertToText(), 'Yaw Salo Yaw');
    	$this->assertEquals((new PashtoCardinal(122))->convertToText(), 'Yaw Salo Dwa Wisht');
    	$this->assertEquals((new PashtoCardinal(154))->convertToText(), 'Yaw Salo Salor Panzos');
    	$this->assertEquals((new PashtoCardinal(199))->convertToText(), 'Yaw Salo Nah Nawee');
    }

    public function test_hundreds_bigger_than_two_hundred() 
    {
    	$this->assertEquals((new PashtoCardinal(200))->convertToText(), 'Dwa Sawa');
    	$this->assertEquals((new PashtoCardinal(500))->convertToText(), 'Penza Sawa');
    	$this->assertEquals((new PashtoCardinal(222))->convertToText(), 'Dwa Sawa Dwa Wisht');
    	$this->assertEquals((new PashtoCardinal(404))->convertToText(), 'Salor Sawa Salor');
    	$this->assertEquals((new PashtoCardinal(634))->convertToText(), 'Eshpag Sawa Salor Dersh');
    	$this->assertEquals((new PashtoCardinal(813))->convertToText(), 'Ata Sawa Deyarlas');
    }
}
