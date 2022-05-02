<?php 
/* function check_empty(){

}

function check_numeric(){
    //数値かどうか？

    
} */

//関数htmlspecialcharsを省略するためだけの関数
function h($val){
    return htmlspecialchars($val,ENT_QUOTES);
}

//桁数チェック
function check_digit($val,$digit=''){
    if (strlen($val) > $digit) {
        $err_msg = '※ 数値(半角)'.$digit.'桁以内で入力してください。';
        return $err_msg;
    }
    return false;
}

//妥当性チェック(引数：入力数値,制限したい桁数)
function check_date($date_val,$digit=''){
    
    if (!is_numeric($date_val)) {   //数値で入力されているか？
        $err_msg = '※ 日付を数値(半角)で入力してください。';
        return $err_msg;
    }
    elseif (strlen($date_val) !== $digit) {  //(今回なら)8桁かどうか？
        $err_msg = '※ 日付は数値(半角)'.$digit.'桁で入力してください。';
        return $err_msg;
    }

    //8桁の数値で入力された日付をYYYYmmddに分割
    $year = substr($date_val,0,4);
    $month = substr($date_val,4,2);
    $day = substr($date_val,6,2);
    if(!checkdate((int)$month,(int)$day,(int)$year)){
        $err_msg = '※ 正確な日付を入力してください。';
        return $err_msg;
    }
    return false;
}
?>