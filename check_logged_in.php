<?php
function user_remembered() : bool {
    if(isset($_COOKIE['name'])) {
        return true;
    }
    return false;
}

function getMessage(): string {
    if(user_remembered()) {
        return "Hello, " . $_COOKIE['name'] . "<br>";
    }
    return "Hello!" . "<br>";
}

function getLogOutFormStyle(): string {
    if(!user_remembered()) {
        return "style='display:none;'";
    }
    return '';
}



