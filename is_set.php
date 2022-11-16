<?php
function user_remembered() : bool {
    if(isset($_COOKIE['name'])) {
        return true;
    }
    return false;
}