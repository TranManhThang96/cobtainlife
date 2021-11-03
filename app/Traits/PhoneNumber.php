<?php

namespace App\Traits;

class PhoneNumber
{
    static function convertVNPhoneNumber($phoneNumber){
        $phoneNumber = trim($phoneNumber);
        $phoneNumber = str_replace(' ', '', $phoneNumber);
        $phoneNumber = str_replace('.', '', $phoneNumber);
        $phoneNumber = str_replace('-', '', $phoneNumber);
        $phoneNumber = str_replace('(', '', $phoneNumber);
        $phoneNumber = str_replace(')', '', $phoneNumber);
        $phoneNumber = str_replace('–', '', $phoneNumber);
        $phoneNumber = str_replace('+', '', $phoneNumber);
    
        //kiem tra neu bat dau bang 0
        if(substr($phoneNumber, 0, 1) == '0'){
            $phoneNumber2 = '84' . substr($phoneNumber, 1);
    
            if(self::isVnPhoneNumber($phoneNumber2)){
                return $phoneNumber2;
            }
        }
    
        return $phoneNumber;
    }
    
    static function isVnPhoneNumber($phoneNumber) {
        //kiem tra xem sdt hop le khong
        $viettel = '84(96|97|98|162|163|164|165|166|167|168|169|86|32|33|34|35|36|37|38|39)\d{7}';
        $mobifone = '84(90|93|120|121|122|126|128|89|70|76|77|78|79)\d{7}';
        $vinaphone = '84(91|94|123|124|125|127|129|88|81|82|83|84|85|80)\d{7}';
        $vietnamobile = '84(92|188|186|56|58|52)\d{7}';
        $gmobile = '84(99|199|59)\d{7}';
        $fixednumber = '842.{9}';
    
        $parten = "(($viettel)|($mobifone)|($vinaphone)|($vietnamobile)|($gmobile)|($fixednumber))";
    
        return preg_match('/^' . $parten . '$/i', $phoneNumber, $match);
    }
}
