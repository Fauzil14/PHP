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

function prima_v1() {
    global $n;
    for($i = 2; $i <= $n; $i++) {
        if( count(kelipatan($i)) == 2 ) {
            $prima[] = $i;
        }
    }
    return $prima;
}

function prima_v2() {
    global $n;
    for($i = 2; $i <= $n; $i++) {
        if( kelipatan($i)[0] == 1 && kelipatan($i)[1] == $i ) {
            $prima[] = $i;
        }
    }
    return $prima;
}

print_r(prima_v1()); echo "\n";
print_r(prima_v2());
?>