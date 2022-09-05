<?php

$data = 'String.';

$splt_data = str_split($data);

for ($i = 0; $i < count($splt_data); $i++) {
    for ($x = 0; $x < 10; $x++) {
        if ($splt_data[$i] == $x) {
            echo "<br> The \"$data\" value is containing numeric value.";
            echo "<br>" . $splt_data[$i] . ' and ' . $x;
            exit();
        }
    }
}

