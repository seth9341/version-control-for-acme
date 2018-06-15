<?php

    /*
     * Accounts Controller
     */

    // Get the database connections file
    require_once '../library/connections.php';
    // Get the acme model
    require_once '../model/acme-model.php';
    // Get the accounts model
    require_once '../model/accounts-model.php';
    //get the common functions
    require_once '../library/functions.php';

    $categories = getCategories();
    $navList = buildNav();
    $action = filter_input(INPUT_POST, 'action');

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action){
 case 'Login' : 
    include '../view/login.php';
  break;
 case 'Registration' :
    include '../view/registration.php';
     break;
 case 'register':
     
     // filter and store the data
     $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
     $clientLastname = filter_input(INPUT_POST, 'clientLastname');
     $clientEmail = filter_input(INPUT_POST, 'clientEmail');
     $clientPassword = filter_input(INPUT_POST, 'clientPassword');

     // Check for an existing email in the database            
        $existingEmail = checkExistingEmail($clientEmail);
    // Check for existing email address in the table
        if($existingEmail){
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/registration.php';
        exit;
    }


     // Check for missing data
if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
 $message = '<p>Please provide information for all empty form fields.</p>';
 include '../view/registration.php';
 exit; 
}

// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

// Check and report the result
if($regOutcome === 1){
 $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
 include '../view/login.php';
 exit;
} else {
 $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
 include '../view/registration.php';
 exit;
}

break;
 default :
    include '../view/login.php';
}
