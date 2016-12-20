<?php

namespace Aloko\PashtoCardinals;

class PashtoCardinal
{
    protected $number;

    const ONES = ['Yaw', 'Dwa', 'Dre', 'Salor', 'Penza', 'Eshpag', 'Owa', 'Ata', 'Nah'];

    const TENS_SMALLER_THAN_TWENTYONE = ['Yawolas', 'Dwalas', 'Deyarlas', 'Sowarlas', 'Penzalas', 'Eshparlas', 'Owalas', 'Atalas', 'Nolas'];

    const TENS = ['Las', 'Shel', 'Dersh', 'Salwikht', 'Panzos', 'Eshpeta', 'Awyaa', 'Atyaa', 'Nawee'];

    public function __construct(int $number)
    {
        $this->number = $number;    
    }

    public function convertToText() 
    {
        if ($this->number == 0) {
            return 'Separ';
        }

        $numberStr = (string) $this->number;
        $numberList = array_reverse(str_split($numberStr));

        if ($this->getNumLength($this->number) == 1) {
            return static::ONES[$this->number - 1];
        } else if ($this->getNumLength($this->number) == 2) {
            if ($numberList[1] == '1') {
                return static::TENS_SMALLER_THAN_TWENTYONE[(int) $numberList[0] - 1];
            } else if ($numberList[1] == '2' && $numberList[0] == '0') {
                return 'Shel';
            } else {
                $oneField = $numberList[0] == '0' ? '' : static::ONES[$numberList[0] - 1] . ' ';

                if ($numberList[1] != '2') {
                    return $oneField . static::TENS[$numberList[1] - 1];
                } else {
                    return $oneField . 'Wisht';
                }
            }
        } else if ($this->getNumLength($this->number) == 3) {
            $tensNum = substr((string) $this->number, -2);
            $tensText = (new self((int) $tensNum))->convertToText() == 'Separ' ? '' : ' ' . (new self((int) $tensNum))->convertToText();

            if ($numberList[2] == 1) {
                return 'Yaw Salo' . $tensText;
            } else {
                return static::ONES[$numberList[2] - 1] . ' Sawa' . $tensText;
            }
        }
    }

    protected function getNumLength($number) 
    {
        return strlen((string) $number);
    }
}
