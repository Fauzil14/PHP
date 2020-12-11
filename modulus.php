<?php

// sitem pengmebalian kasir dengan modulus

// pecahan uang = 1000, 2000, 5000, 10000, 20000, 50000, 100000

// fungsi untuk mencari pecahan pembanding
function comparison($amount) {
    $denominations = [100000, 50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100];
    $comparisons = array_filter($denominations, function($value) use ($amount) {
        if($value <= $amount) {
            return $value;
        }
    });
    $comparisons = array_values($comparisons);
    return $comparisons[0];
}

// fungsi untuk mencari pecahan kembalian
function changePiece($change) {
    $i = 0;
    $mc = [];
    do {
        $comparison = comparison($change);
        
        $mod = $change%$comparison;
        $times = ($change-$mod)/$comparison;
        if($times > 1) {
            $mc[] = "Rp " . number_format($comparison, '2', ',' , '.') . " X " . $times; 
        } else {
            $mc[] = "Rp " . number_format($comparison, '2', ',', '.');
        }
        $change = $change%$comparison; 
        $i++;
    } while($change > 0);
    
    return $mc;
}

var_dump(changePiece(298700));
// print_r(comparison(99500));

?>