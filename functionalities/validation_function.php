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
    
    $pattern = "/[^a-z\s_]/i";
    $result = preg_match($pattern, $data);


    if ($result) {
        return "The $name should be alphabetical only.";
    } else {
        return 1;
    }
}

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