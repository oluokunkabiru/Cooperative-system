<?php
function input($data){
    $data=strip_tags("$data"); 
    $data = trim("$data");
    $data = stripslashes("$data");
    $data = htmlspecialchars("$data");
    return $data;
}

function checkInput($datainput,$input){

    if(empty($datainput))
    {
        $error=(string)$input." is required";
        return $error;
    }
    return "good";
}
?>