<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'admin-class.php';
$admin = new itg_admin();
$function = filter_input(INPUT_POST, 'function');
$state = filter_input(INPUT_POST, 'state');
$district = filter_input(INPUT_POST, 'district');

switch ($function) {
    case 'addState':
        $admin->addState($state);
        break;
    case 'getState':
        $admin->getStates();
        break;
    case 'addDistrict':
        $admin->addDistrict($state,$district);
        break;
    default:
        break;
}

