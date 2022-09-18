<?php

function data_spilator($data)
{

    $spilited_data = [];

    $data = trim($data);
    $data = explode(']', $data);

    for ($i = 0; $i < count($data); $i++) {
        $value = $data[$i];
        if (empty($value)) {
            continue;
        } else {
            $position = strpos($value, '[');

            $value = str_split($value);
            unset($value[$position]);
            $value = implode($value);
            array_push($spilited_data, $value);
        }
    }
    return $spilited_data;
}
