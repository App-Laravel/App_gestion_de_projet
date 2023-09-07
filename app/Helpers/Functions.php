<?php

function displayRole($role = 2) {
    switch ($role) {
        case 1 : 
            return 'Administration'; 
            break;
        case 2 : 
            return 'User';
            break; 
    }
}

function displayStatus($status = 1) {
    switch ($status) {
        case 1 : 
            return 'Active'; 
            break;
        case 2 : 
            return 'Blocked';
            break; 
    }
}

function displayGender($gender = null) {
    switch ($gender) {
        case 1 :
            return 'Male'; 
            break;
        case 2 : 
            return 'Female';
            break;
        default:
            return '----------';
            break;
    }
}