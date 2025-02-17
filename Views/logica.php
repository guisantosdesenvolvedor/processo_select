<?php
$array = [50, 1, 5, 65, 35, 22, 100, 300, 250];
$n = count($array); 

for ($i = 0; $i < $n - 1; $i++) {
    $menor = $i;

    for ($j = $i + 1; $j < $n; $j++) {
        if ($array[$j] < $array[$menor]) {
            $menor = $j;
        }
    }

    if ($menor != $i) {
        $temp = $array[$i];
        $array[$i] = $array[$menor];
        $array[$menor] = $temp;
    }
}

print_r($array);
?>