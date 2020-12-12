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
function changePiece($change, $request = null) {
    $i = 0;
    $mc = [];
    do {
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
                $comparisons = $request;
                break;
        }
       
        if(!is_array($request)) {
            $mod = $change%$comparison;
            $times = ($change-$mod)/$comparison;
            if($times > 1) {
                $mc[] = [ 
                            'nomminal' => $comparison, 
                            'times'    => $times 
                        ]; 
            } else {
                $mc[] = [ 
                            'nomminal' => $comparison, 
                            'times'    => $times 
                        ];
            }
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

        // return [    
        //             'comparison'   => $comparison, 
        //             'change'       => $change, 
        //             'mc'           => $mc, 
        //             'substraction' => $substraction,
        //             'request' => $request
        //         ];
        $i++;
    } while($change > 0);
    
    return $mc;
}

print_r(changePiece(306700, [['nominal' => 100000, 'times' => 2], ['nominal' => 50000, 'times' => 2], ['nominal' => 200, 'times' => 8]]));
echo "\n";
print_r(changePiece(306700, 20000));
echo "\n";
print_r(changePiece(306700));

?>