<?php
    $string = "TranSISI";

    function count_capitals($s) {
        return mb_strlen(preg_replace('![^a-z]+!', '', $s));
    }

    print(count_capitals($string));
?>