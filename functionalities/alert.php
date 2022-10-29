<?php 

// function alert($data)
// {
//   if ($data['status']) {
//     $success = '';
//     unset($data['status']);
//     foreach ($data as $message) {
//       $success .= trim($message);
//     }
//     return array('status' => 'success', 'message' => $success);
//   } else {
//     $error  = '';
    
//     foreach ($data as $message) {
//       $error .= trim($message);
//     }
//     return array('status' => 'error', 'message' => $error);
//   }
// }

function alert($data)
{
    if ($data['status']) {
        $success = '';
        unset($data['status']);
        foreach ($data as $message) {
            $success .= trim($message);
        }
        return array('status' => 'success', 'message' => $success);
    } else {
        $error  = '';

        foreach ($data as $message) {
            $error .= trim($message);
        }
        return array('status' => 'error', 'message' => $error);
    }
}


?>