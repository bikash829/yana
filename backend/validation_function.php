<?php
// numeric validation 
function numeric_value($data)
{
    if (is_numeric($data)) {
        return 1;
    } else {
        return "The \"$data\" value is not numeric.";
    }
}

// numeric validation 
function alphabetic_velue($data, $name)
{
    // $splt_data = str_split($data);
    // for ($i = 0; $i < count($splt_data); $i++) {
    //     for ($x = 0; $x < 10; $x++) {
    //         if ($splt_data[$i] == "$x") {
    //             return "The \"$data\" value is containing numeric value.";
    //             exit();
    //         }
    //     }
    // }
    $pattern = "/[^a-z\s_]/i";
    $result = preg_match($pattern, $data);


    if ($result) {
        return "The $name should be alphabetical only.";
    } else {
        return 1;
    }
}

// alphabetical validation 
// function alphabetic_velue($data)
// {
//     if (ctype_alpha($data)) {
//         return 1;
//     } else {
//         return "The \"$data\" value must alphabetical";
//     }
// }


// min length 

function min_len($data, $len)
{
    if (strlen($data) >= $len) {
        return 1;
    } else {

        return "The given value's characther minimum length must be $len charecter long.";
    }

    print_r($data);
    exit();
}


// max length
function max_len($data, $len)
{
    if (strlen($data) < $len) {
        return 1;
    } else {

        return "The given value's characther maximum length could be $len charecter long.";
    }
}


//text filter 
function input_test_primary($data)
{
    $data = trim($data);
    // $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}


function contact_no_validation($data)
{
}


function input_test($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}


function empty_value($data){
    if(isset($data)){
        return $data;
    }else{
        return null;
    }

}