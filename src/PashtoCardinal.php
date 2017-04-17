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
        $this->number = (float) $number;    
    }

    /**
     * Convert the number to Pashto text (old API).
     * 
     * @return String
     */
    public function convertToText() 
    {
        return $this->convertNumToText();
    }

    /**
     * Convert the number to Pashto text (new API).
     * 
     * @return String
     */
    public function convertNumToText() 
    {
        if ($this->number == 0) {
            return '';
        }

        $numberAsString = (string) $this->number;
        $numberAsArray = $this->getNumAsArray($this->number);
        $numberLength = $this->getNumLength($this->number);

        if ($this->numberHasDecimalPoint($this->number)) {
            $whole = $this->getWholePart($this->number);
            $fractional = $this->getFractionalPart($this->number);

            return (new self($whole))->convertNumToText() . ' Asharya ' . $this->convertFractionalToText($fractional);
        }

        if ($this->numberIsSmallerThanTen($this->number)) {
            return static::ONES[$this->number - 1];
        } 

        if ($this->numberIsBetweenElevenAndNineteen($this->number)) {
            return static::TENS_SMALLER_THAN_TWENTYONE[(int) $numberAsArray[0] - 1];
        } 

        if ($this->numberIsTwenty($this->number)) {
            return static::TENS_SMALLER_THAN_TWENTYONE[9];
        }

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

    /**
     * Get the length of number.
     * 
     * @param  int  $number
     * @return String
     */
    protected function getNumLength($number) 
    {
        return strlen((string) $number);
    }

    /**
     * Get the number in array format. Ones starting at zero index and
     * others upto bigger indexes.
     * 
     * @param  int  $number
     * @return Array
     */
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

    protected function numberHasDecimalPoint($number) 
    {
        return sizeof(explode('.' , $number)) > 1;
    }

    /**
     * Get the whole part of a number, left of decimal point.
     * 
     * @param  int|string $number
     * @return string
     */
    public function getWholePart($number) 
    {
        return explode('.', $number)[0];    
    }

    /**
     * Get the fractional part of a number, right of decimal point.
     * 
     * @param  int|string $number
     * @return string
     */
    public function getFractionalPart($number) 
    {
        return explode('.', $number)[1];
    }

    /**
     * Convert the fractional parth of number to Pashto text.
     * 
     * @param  int|string $number
     * @return string
     */
    public function convertFractionalToText($number) 
    {
        $numberAsString = '';

        foreach (array_reverse($this->getNumAsArray($number)) as $index => $num) {
            $numberAsString .= ($index == 0 ? '' : ' ') . static::ONES[$num - 1];
        }

        return $numberAsString;
    }

    /**
     * Provide the felxibility so convert can be called in a static manner.
     * 
     * @param  String  $name
     * @param  String  $arguments
     * @return String
     */
    public static function __callStatic($name, $arguments)
    {
        if ($name == 'convert') {
            return (new PashtoCardinal($arguments[0]))->convertNumToText();
        }
    }
}
