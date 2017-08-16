<?php

function option_selected($value1, $value2){
    if($value2 == '') return '';
    if($value1 == $value2) return 'selected';
    return '';
}