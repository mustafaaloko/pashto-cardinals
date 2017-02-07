<?php

namespace Aloko\PashtoCardinals;

class PashtoCardinal
{
    protected $number;

    const ONES = ['Yaw', 'Dwa', 'Dre', 'Salor', 'Penza', 'Eshpag', 'Owa', 'Ata', 'Nah'];

    const TENS_SMALLER_THAN_TWENTYONE = ['Yawolas', 'Dwalas', 'Deyarlas', 'Sowarlas', 'Penzalas', 'Eshparlas', 'Owalas', 'Atalas', 'Nolas'];

    const TENS = ['Las', 'Shel', 'Dersh', 'Salwikht', 'Panzos', 'Eshpeta', 'Awyaa', 'Atyaa', 'Nawee'];

    const BIGGER_THAN_THOUSANDS = ['Zara', 'Million', 'Milliard'];

    public function __construct($number)
    {
        $this->number = (int) $number;    
    }

    public function convertToText() 
    {
        if ($this->number == 0) {
            return '';
        }

        $numberAsString = (string) $this->number;
        $numberAsArray = array_reverse(str_split($numberAsString));
        $numberLength = $this->getNumLength($this->number);

        if ($numberLength == 1) {
            return static::ONES[$this->number - 1];
        } else if ($numberLength == 2) {
            if ($numberAsArray[1] == '1') {
                return static::TENS_SMALLER_THAN_TWENTYONE[(int) $numberAsArray[0] - 1];
            } else if ($numberAsArray[1] == '2' && $numberAsArray[0] == '0') {
                return 'Shel';
            } else {
                $oneField = $numberAsArray[0] == '0' ? '' : static::ONES[$numberAsArray[0] - 1] . ' ';

                if ($numberAsArray[1] != '2') {
                    return $oneField . static::TENS[$numberAsArray[1] - 1];
                } else {
                    return $oneField . 'Wisht';
                }
            }
        } else if ($numberLength == 3) {
            $tensNum = substr((string) $this->number, -2);
            $tensText = (new self((int) $tensNum))->convertToText();

            if ($numberAsArray[2] == 1) {
                if ($tensText == '') {
                    return 'Sel';
                }

                return 'Yaw Salo ' . $tensText;
            } else {
                return trim(static::ONES[$numberAsArray[2] - 1] . ' Sawa ' . $tensText);
            }
        }  else if ($numberLength > 3) {
            $numbersChunked = array_map(function($num) {
                return strrev($num);
            }, str_split(strrev($numberAsString), 3));

            $numbersChunked = array_reverse($numbersChunked);

            foreach ($numbersChunked as $index => $value) {
                $numbers = $numbersChunked;
                array_shift($numbers);

                return trim((new self($value))->convertToText() . ' ' . static::BIGGER_THAN_THOUSANDS[count($numbersChunked) - 2] . ' ' . (new self(implode('', $numbers)))->convertToText());
            }
        }
    }

    protected function getNumLength($number) 
    {
        return strlen((string) $number);
    }
}
