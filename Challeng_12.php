<?php
// PART-1
echo "<hr/>";

//Function-1
function DecimalBinary ($number=12) {
    (int)$binary = 0;
    $reverseBinary ="";
    $condition = $number;
    while($condition >= 1) {
        if ($number % 2 == 0 || $number % 2 == 1) {
            $reverseBinary .= $number % 2;
            $number = $number / 2;
        } 
        else {
            return $reverseBinary;
        }
        $condition = (int)$condition / 2; 
        (int)$binary = strrev($reverseBinary);
    }
    return $binary;
}
echo DecimalBinary ();

echo "<br/>";

//Function-2

function DecimalRoman($num) { 
    //prosiren kod do 3999999
    $_M = ["", "_M", "_M_M", "_M_M_M"];
    $_C = ["", "_C", "_C_C", "_C_C_C", "_C_D", "_D", "_D_C", "_D_C_C", "_D_C_C_C", "_C_M"];
    $_X = ["", "_X", "_X_X", "_X_X_X", "_X_L", "_L", "_L_X", "_L_X_X", "_L_X_X_X", "_X_C"];
    //prosiren kod do 3999999  
    $M = ["", "M", "MM", "MMM","M_V","_V","_VM","_VMM","_VMMM","M_X",];
    //$M = ["", "M", "MM", "MMM"]; za funkcija do 3999
    $C = ["", "C", "CC", "CCC", "CD", "D","DC", "DCC", "DCCC", "CM"];
    $X = ["", "X", "XX", "XXX", "XL", "L","LX", "LXX", "LXXX", "XC"];
    $I = ["", "I", "II", "III", "IV", "V","VI", "VII", "VIII", "IX"];

    //prosiren kod do 3999999 za TASK-3
    if($num <= 3999999) {
        $milions = $_M[$num / 1000000];
        $hundredThousands = $_C[($num % 1000000) / 100000];
        $tenThousands = $_X[($num % 100000) / 10000];
        $thousands = $M[($num % 10000) / 1000];
        $hundreds = $C[($num % 1000) / 100];
        $tens = $X[($num % 100) / 10];
        $ones = $I[$num % 10];
        $romanNumber = $milions . $hundredThousands . $tenThousands . $thousands . $hundreds . $tens . $ones; 
        return $romanNumber;
    } 
    else {
        echo "Error only numbers under 4000000!!!";
    }   
    // privicen kod do 3999

    // if($num <= 3999) {
    //     $thousands = $M[$num / 1000];
    //     $hundreds = $C[($num % 1000) / 100];
    //     $tens = $X[($num % 100) / 10];
    //     $ones = $I[$num % 10];
    //     $romanNumber = $thousands . $hundreds . $tens . $ones; 
    //     return $romanNumber;
    // } 
    // else {
    //     echo "Error only numbers under 4000!!!";
    // }   
}
echo DecimalRoman(151);

echo "<br/>";
echo "<hr/>";

// PART-2

// Function-1
function BinaryDecimal($binaryNumber) {
    $count = 0;
    (int)$number = 0;
    while ($binaryNumber > 0) {
        $count++;
        $modNum = $binaryNumber % 10;
        $number += ($modNum*2**($count-1)); 
        (int)$binaryNumber = (int)($binaryNumber / 10);  
    } 
    return $number;
}
echo BinaryDecimal(11001100110011);

echo "<br/>";

//Function-2
function romanDecimal($romanNumber ='XVII') {
    $romanNumbers = ['_M'=>1000000,'_C_M'=>900000,'_D'=>500000,'_C_D'=>400000,'_C'=>100000,'_X_C'=>90000,'_L'=>50000,'_X_L'=>40000,'_X'=>10000,'M_X'=>9000,'_V'=>5000,'M_V'=>4000,'M'=>1000,'CM'=>900,'D'=>500,'CD'=>400,'C'=>100,'XC'=>90,'L'=>50,'XL'=>40,'X'=>10,'IX'=>9,'V'=>5,'IV'=>4,'I'=>1];

    (int)$arabic = 0;
    $romanNumber = strtoupper($romanNumber); 
    $limit ="_M_M_M_M";
    $control = strpos($romanNumber, "_M_M_M_M");

    if($control === 0) {
        echo 'ERROR!';
    } 
    else {
        foreach($romanNumbers as $key=>$value) {
            while(strpos($romanNumber, $key) === 0) {
                (int)$arabic +=intval($value);
                $romanNumber = substr($romanNumber, strlen($key));
            }
        }
        return (int)$arabic; 
    }       
}
echo romanDecimal('_m_X_cClXVII');

echo "<br/>";
echo "<hr/>";

// PART-3

$numeralia = [1110011, 3591, 'XLVII', -3125689, 10010, '_m_m_X_CLDVii', '+0159', -2597, '-0147', -456789, 3999999,'_M_M_M_C_M_X_CM_XCMXCIX'];
function chekIt($numeralia) {
    foreach($numeralia as $numeralia) {

        if(is_numeric($numeralia)) {
            if((preg_match("/^[0-1]+$/", $numeralia)) && (preg_match('/[+¬-]/', $numeralia) === 0)) { 
                echo "Binary number.", "<br/>";
                echo BinaryDecimal($numeralia);
                echo "<br/>";
                echo DecimalRoman(BinaryDecimal($numeralia));
                echo "<br/><br/>";
            }
            elseif(preg_match("/^[0-9+¬-]+$/", $numeralia)&&(((substr($numeralia, 0,2))!=="-0") && (substr($numeralia, 0,2))!=="+0")) {
                echo "Decimal number.", "<br/>";
                if($numeralia < 0) {
                    $numeralia = $numeralia * (-1);
                }
                echo DecimalBinary($numeralia), "<br/>";
                echo DecimalRoman($numeralia);
                echo "<br/><br/>";
            }
            else if((substr($numeralia, 0,2) == "-0") || (substr($numeralia, 0,2) == "+0")) {
                echo "Error!";
                echo "<br/><br/>";
            }
        } else {
            echo "Roman number.", "<br/>";
            echo romanDecimal($numeralia), "<br/>";
            echo DecimalBinary( romanDecimal($numeralia));
            echo "<br/><br/>";
        }
    } 
}
echo chekIt($numeralia);