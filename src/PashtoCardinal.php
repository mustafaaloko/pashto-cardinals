<?php

namespace Aloko\PashtoCardinals;

class PashtoCardinal
{
    protected $number;

    const ONES = ['Yaw', 'Dwa', 'Dre', 'Salor', 'Penza', 'Eshpag', 'Owa', 'Ata', 'Nah'];

    const TENS_SMALLER_THAN_TWENTYONE = ['Yawolas', 'Dwalas', 'Deyarlas', 'Sowarlas', 'Penzalas', 'Eshparlas', 'Owalas', 'Atalas', 'Nolas', 'Shel'];

    const TENS = ['Las', 'Shel', 'Dersh', 'Salwikht', 'Panzos', 'Eshpeta', 'Awyaa', 'Atyaa', 'Nawee'];

    const BIGGER_THAN_THOUSANDS = ['Zara', 'Million', 'Milliard'];

    public function __construct($number)
    {
        $this->number = (int) $number;    
    }

    public function convertToText() 
    {
        return $this->convertNumToText();
    }
    
    public function convertNumToText() 
    {
        if ($this->number == 0) {
            return '';
        }

        $numberAsString = (string) $this->number;
        $numberAsArray = $this->getNumAsArray($this->number);
        $numberLength = $this->getNumLength($this->number);

        if ($this->numberIsSmallerThanTen($this->number)) {
            return static::ONES[$this->number - 1];
        } 

        if ($this->numberIsBetweenElevenAndNineteen($this->number)) {
            return static::TENS_SMALLER_THAN_TWENTYONE[(int) $numberAsArray[0] - 1];
        } 

        if ($this->numberIsTwenty($this->number)) {
            return static::TENS_SMALLER_THAN_TWENTYONE[9];
        }

        // if ($this->numberIsBetweenTwentyOneAndThirty) {

        // }

        if ($this->numberIsBetweenTwentyOneAndNintyNine($this->number)) {
            $oneField = $numberAsArray[0] == '0' ? '' : static::ONES[$numberAsArray[0] - 1] . ' ';

            if ($numberAsArray[1] != '2') {
                return $oneField . static::TENS[$numberAsArray[1] - 1];
            } else {
                return $oneField . 'Wisht';
            }
        } 

        if ($numberLength == 3) {
            $tensNum = substr((string) $this->number, -2);
            $tensText = (new self((int) $tensNum))->convertNumToText();

            if ($numberAsArray[2] == 1) {
                if ($tensText == '') {
                    return 'Sel';
                }

                return 'Yaw Salo ' . $tensText;
            } else {
                return trim(static::ONES[$numberAsArray[2] - 1] . ' Sawa ' . $tensText);
            }
        } 

        if ($this->numberIsThousandOrBigger($this->number)) {
            $numbersChunked = array_map(function($num) {
                return strrev($num);
            }, str_split(strrev($numberAsString), 3));

            $numbersChunked = array_reverse($numbersChunked);

            foreach ($numbersChunked as $index => $value) {
                $numbers = $numbersChunked;
                array_shift($numbers);

                return trim((new self($value))->convertNumToText() . ' ' . static::BIGGER_THAN_THOUSANDS[count($numbersChunked) - 2] . ' ' . (new self(implode('', $numbers)))->convertNumToText());
            }
        }
    }

    protected function getNumLength($number) 
    {
        return strlen((string) $number);
    }

    protected function getNumAsArray($number)
    {
        return array_reverse(str_split((string) $number));
    }

    protected function numberIsSmallerThanTen($number)
    {
        return $this->getNumLength($number) == 1;
    }

    protected function numberIsBetweenTenAndNintyNine($number)
    {
        return $this->getNumLength($number) == 2;
    }

    protected function numberIsBetweenElevenAndNineteen($number)
    {
        $numberAsArray = $this->getNumAsArray($number);

        return $this->numberIsBetweenTenAndNintyNine($number) && ($numberAsArray[1] == '1');
    }

    protected function numberIsTwenty($number)
    {
        $numberAsArray = $this->getNumAsArray($number);

        return $this->numberIsBetweenTenAndNintyNine($number) && ($numberAsArray[1] == '2' && $numberAsArray[0] == '0');
    }

    protected function numberIsBetweenTwentyOneAndNintyNine($number) 
    {
        return $this->numberIsBetweenTenAndNintyNine($number) && 
            (! $this->numberIsTwenty($number) && ! $this->numberIsBetweenElevenAndNineteen($number));
    }

    protected function numberIsThousandOrBigger($number)
    {
        return $this->getNumLength($number) > 3;
    }

    public static function __callStatic($name, $arguments)
    {
        if ($name == 'convert') {
            return (new PashtoCardinal($arguments[0]))->convertNumToText();
        }
    }
}
