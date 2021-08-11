<?php
    $arr = [
        ['f', 'g', 'h', 'i'],
        ['j', 'k', 'p', 'q'],
        ['r', 's', 't', 'u']
    ];
    
   function cari($arr,$input){
        $s = "";
        foreach($arr as $st){
            $s = $s ."". implode("", $st);
        }
        $input_array = str_split($input);
        foreach($input_array as $st){
            if (strpos($s, $st) === false){
                return false;
            }
        }
        return true;
   }
    echo (cari($arr, 'fghi') ? "true" : "false") . "\n"; 
    echo (cari($arr, 'fghp') ? "true" : "false") . "\n"; 
    echo (cari($arr, 'fjrstp') ? "true" : "false") . "\n"; 
?>