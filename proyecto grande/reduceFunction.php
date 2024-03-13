<?php

function reducer_funtion($strs) {
    $reducer = $strs;
    if(strlen($reducer) > 15){
     $reducer = substr($reducer,0,12);
        return $reducer + "...";
    }else{
        return $reducer;
    }

}



?>