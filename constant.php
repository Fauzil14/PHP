<?php
/* 
Konstanta dalam PHP hanya dapat berisi tipe data sederhana (disebut juga jenis tipe skalar), 
yakni: boolean, integer, float dan string. 
Hal ini berbeda dengan variabel, 
yang dapat juga berisi tipe data turunan seperti array, objek atau resources.
*/

// Best Practice = Untuk mengantisipasi apakah nama konstanta sudah dibuat atau belum
defined('const_val') ? NULL : define('const_val', 5);

$arr = [1, 2, 3, 4, const_val, 6, 7, 8, 9, 10];

$arr = array_map(function($value){
        return $value + 2; 
    }, $arr);

print_r($arr); echo "\n";

const FIFTH = 5; // hanya bisa digunakan di dalam top-level scope, tidak bisa digunakan dalam funcntion, looping atau if else

class Test {
    
    public $arr = [1, 2, 3, 4, FIFTH, 6, 7, 8, 9, 10];
    
    public function eksponen($eks) {
        define('const_val2', 5); // define bisa digunakan dalam function
        foreach($this->arr as $value) {
            $new[] = $value * $eks;
        }
        return $new;
    }
}

$obj = new Test;
$arr2 = $obj->eksponen(2);

print_r($arr2);

?>