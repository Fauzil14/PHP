<?php

$n = 20;
$i = 2;

function kelipatan($number) {
    for($i = 1; $i <= $number; $i++) {
        if($number % $i == 0) {
            $kelipatan[] = $i;
        }
    }
    return $kelipatan;
}

for($i = 2; $i <= $n; $i++) {
    if( count(kelipatan($i)) == 2) {
        $prima[] = $i;
    }
}

print_r($prima);
?>