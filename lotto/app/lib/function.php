<?php

function print_pre($expression, $return = false, $wrap = false)
{
    $css = 'border:1px dashed #06f;background:#69f;padding:1em;text-align:left;z-index:99999;font-size:12px;position:relative';
    if ($wrap) {
        $str = '<p style="' . $css . '"><tt>' . str_replace(
        array('  ', "\n"),
        array('&nbsp; ', '<br />'),
        htmlspecialchars(print_r($expression, true))
        ) . '</tt></p>';
    } else {
        $str = '<pre style="' . $css . '">' . print_r($expression, true) . '</pre>';
    }
    if ($return) {
        if (is_string($return) && $fh = fopen($return, 'a')) {
        fwrite($fh, $str);
        fclose($fh);
        }
        return $str;
    } else
        echo $str;
}

function SubstrCode($defCode){    
    $valNumberRe = substr($defCode,-3);
    return $valNumberRe;
}

function SubstrCode2Digit($defCode){    
    $valNumberRe = substr($defCode,-2);
    return $valNumberRe;
}

function SubstrCodefront($defCode){    
    $valNumberRe = substr($defCode,0,3);
    return $valNumberRe;
}

function setMonth(){
    $year = date('Y')+543;
    $month = date('m');

    $arrMonth = array();
    $arrYear = array();
    $result = $month;
    $arrMonth[] = $result;
    $arrYear[] = $year;
    for ($i=0; $i < 11; $i++) { 
        $result = $result-1;
        if($result == 0){
            $result = 12;
            $year = $year-1;
        }
        if($result<10){
            $arrMonth[] = '0'.$result;
        }else{
            $arrMonth[] = $result;
        }
        $arrYear[] = $year;
    }
    return genDate($arrMonth,$arrYear);
}

function genDate($arrMonth,$arrYear){
    $arrDatePicker = array();
    for ($indexOf=0; $indexOf < count($arrMonth); $indexOf++) { 
        $arrDatePicker[] = '01'.'-'.$arrMonth[$indexOf].'-'.$arrYear[$indexOf];
        $arrDatePicker[] = '16'.'-'.$arrMonth[$indexOf].'-'.$arrYear[$indexOf];
    }
    return $arrDatePicker;
}

?>