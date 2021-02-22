<?php

// sitem pengmebalian kasir dengan modulus

// pecahan uang = 1000, 2000, 5000, 10000, 20000, 50000, 100000

$denominations = [100000, 50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100];

// fungsi untuk memfilter pecahan berdasarkan request tanpa ketentuan jumlah(times)
function denomfil($filter) {
    global $denominations;
    
    $top = array_filter($denominations, function($value) use ($filter) {
        return in_array($value, $filter);
    });

    $bottom = array_filter($denominations, function($value) use ($top) {
        if($value < min($top)) {
            return $value;
        }
    });

    $denominations = array_merge($top, $bottom);

    return $denominations;
} 

// fungsi untuk mencari pecahan pembanding
function comparison($amount) {
    global $denominations;
    $comparisons = array_filter($denominations, function($value) use ($amount) {
        if($value <= $amount) {
            return $value;
        }
    });
    $comparisons = array_values($comparisons);
    return $comparisons[0];
}

// fungsi untuk mencari pecahan kembalian
function changePiece($change, $request = null) {
    $mc = [];
    do {
        // jika request tidak memiliki jumlah(times) maka filter denominations
        // if(is_array($request) && !isset($request['times'])) {
        //     // var_dump($request); die;
        //     denomfil($request);
        //     $request = null;
        // }

        // Note : swtich statement will not run if the value of the expression is null
        switch (TRUE) {
            case is_null($request):
                $comparison = comparison($change);
                break;
            case is_integer($request): 
                $comparison = $request;
                $request = null; // nullified the request variable so that the case didn't run after one iteration
                break;
            case is_array($request): 
                if(isset($request['times'])) {
                    $comparisons = $request;
                    echo "it has to be here";
                } else {
                    
                    denomfil($request);
                    $request = null;
                }
                break;
        }
       
        if(!is_array($request)) {
            $mod = $change%$comparison;
            $times = ($change-$mod)/$comparison;
            $mc[] = [ 
                        'nomminal' => $comparison, 
                        'times'    => $times 
                    ]; 
            
            $change = $change%$comparison;
        } else {
            $request = null; // nullified the request variable so that the case didn't run after one iteration
            foreach ($comparisons as $comparison) {
                $mc[] = [ 
                            'nominal' => $comparison['nominal'],
                            'times' => $comparison['times']
                        ];
                // get the total request as per nominal to array;
                $substraction[] = $comparison['nominal'] * $comparison['times'];
            }
            // sum up total request to a single nominal
            $substraction = array_sum($substraction);
            $change = $change - $substraction;
        }

    } while($change > 0);
    
    
    

    return $mc;
}

print_r(changePiece(306700, [['nominal' => 100000, 'times' => 2], ['nominal' => 50000, 'times' => 2], ['nominal' => 200, 'times' => 7]]));
echo "\n";
// print_r(changePiece(306700, 20000));
// echo "\n";
// print_r(changePiece(386700, [50000, 5000, 2000])); // bug here => the result didn't include 20000 because 300000%50000 = 0
// echo "\n";
// print_r(changePiece(306700));

// print_r(comparison([100000, 20000]));
// print_r(comparison(20000));
?>