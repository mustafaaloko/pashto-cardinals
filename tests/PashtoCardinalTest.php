<?php

use Aloko\PashtoCardinals\PashtoCardinal;

class PashtoCardinalTest extends \PHPUnit_Framework_TestCase
{
    public function test_number_is_converted_to_text()
    {
    	$numberInText = PashtoCardinal::convert(8);
        $expected = 'Ata';

        $this->assertEquals($numberInText, $expected);
    }

    public function test_ones_conversion() 
    {
    	$this->assertEquals(PashtoCardinal::convert(1), 'Yaw');
        $this->assertEquals(PashtoCardinal::convert(2), 'Dwa');
        $this->assertEquals(PashtoCardinal::convert(3), 'Dre');
        $this->assertEquals(PashtoCardinal::convert(4), 'Salor');
        $this->assertEquals(PashtoCardinal::convert(5), 'Penza');
        $this->assertEquals(PashtoCardinal::convert(6), 'Eshpag');
        $this->assertEquals(PashtoCardinal::convert(7), 'Owa');
        $this->assertEquals(PashtoCardinal::convert(8), 'Ata');
        $this->assertEquals(PashtoCardinal::convert(9), 'Nah');
    }

    public function test_tens_lesser_than_twenty_one() 
    {
    	$this->assertEquals(PashtoCardinal::convert(11), 'Yawolas');
        $this->assertEquals(PashtoCardinal::convert(12), 'Dwalas');
        $this->assertEquals(PashtoCardinal::convert(13), 'Deyarlas');
        $this->assertEquals(PashtoCardinal::convert(14), 'Sowarlas');
        $this->assertEquals(PashtoCardinal::convert(15), 'Penzalas');
        $this->assertEquals(PashtoCardinal::convert(16), 'Eshparlas');
        $this->assertEquals(PashtoCardinal::convert(17), 'Owalas');
        $this->assertEquals(PashtoCardinal::convert(18), 'Atalas');
        $this->assertEquals(PashtoCardinal::convert(19), 'Nolas');
        $this->assertEquals(PashtoCardinal::convert(20), 'Shel');
    }

    public function test_tens_bigger_than_thirty() 
    {
    	$this->assertEquals(PashtoCardinal::convert(30), 'Dersh');
    	$this->assertEquals(PashtoCardinal::convert(50), 'Panzos');
    	$this->assertEquals(PashtoCardinal::convert(41), 'Yaw Salwikht');
    	$this->assertEquals(PashtoCardinal::convert(62), 'Dwa Eshpeta');
    	$this->assertEquals(PashtoCardinal::convert(73), 'Dre Awyaa');
    	$this->assertEquals(PashtoCardinal::convert(84), 'Salor Atyaa');
    	$this->assertEquals(PashtoCardinal::convert(97), 'Owa Nawee');
    }

    public function test_tens_between_twenty_and_thirty() 
    {
    	$this->assertEquals(PashtoCardinal::convert(21), 'Yaw Wisht');
    	$this->assertEquals(PashtoCardinal::convert(23), 'Dre Wisht');
    	$this->assertEquals(PashtoCardinal::convert(29), 'Nah Wisht');
    }

    public function test_hunderds_smaller_than_two_hundred() 
    {
        $this->assertEquals(PashtoCardinal::convert(100), 'Sel');
    	$this->assertEquals(PashtoCardinal::convert(101), 'Yaw Salo Yaw');
    	$this->assertEquals(PashtoCardinal::convert(122), 'Yaw Salo Dwa Wisht');
    	$this->assertEquals(PashtoCardinal::convert(154), 'Yaw Salo Salor Panzos');
    	$this->assertEquals(PashtoCardinal::convert(199), 'Yaw Salo Nah Nawee');
    }

    public function test_hundreds_bigger_than_two_hundred() 
    {
    	$this->assertEquals(PashtoCardinal::convert(200), 'Dwa Sawa');
    	$this->assertEquals(PashtoCardinal::convert(500), 'Penza Sawa');
    	$this->assertEquals(PashtoCardinal::convert(222), 'Dwa Sawa Dwa Wisht');
    	$this->assertEquals(PashtoCardinal::convert(404), 'Salor Sawa Salor');
    	$this->assertEquals(PashtoCardinal::convert(634), 'Eshpag Sawa Salor Dersh');
    	$this->assertEquals(PashtoCardinal::convert(813), 'Ata Sawa Deyarlas');
    	$this->assertEquals(PashtoCardinal::convert(999), 'Nah Sawa Nah Nawee');
    }

    public function test_numbers_more_than_hundreds() 
    {
        $this->assertEquals(PashtoCardinal::convert(1000), 'Yaw Zara');
        $this->assertEquals(PashtoCardinal::convert(6000), 'Eshpag Zara');
        $this->assertEquals(PashtoCardinal::convert(1234), 'Yaw Zara Dwa Sawa Salor Dersh');
        $this->assertEquals(PashtoCardinal::convert(4234), 'Salor Zara Dwa Sawa Salor Dersh');
        $this->assertEquals(PashtoCardinal::convert(999999), 'Nah Sawa Nah Nawee Zara Nah Sawa Nah Nawee');
        $this->assertEquals(PashtoCardinal::convert(78654321), 'Ata Awyaa Million Eshpag Sawa Salor Panzos Zara Dre Sawa Yaw Wisht');
        $this->assertEquals(PashtoCardinal::convert(9878654321), 'Nah Milliard Ata Sawa Ata Awyaa Million Eshpag Sawa Salor Panzos Zara Dre Sawa Yaw Wisht');
        $this->assertEquals(PashtoCardinal::convert(8000000000), 'Ata Milliard');
    }

    public function test_old_api() 
    {
        $this->assertEquals((new PashtoCardinal(222))->convertToText(), 'Dwa Sawa Dwa Wisht');
    }
}
