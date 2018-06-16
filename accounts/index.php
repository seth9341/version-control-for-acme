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

// Create or access a Session
 session_start();

    $categories = getCategories();
    $navList = buildNav();
    $action = filter_input(INPUT_POST, 'action');

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action){
 case 'Login' : 
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientEmail = checkEmail($clientEmail);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
$passwordCheck = checkPassword($clientPassword);

// Run basic checks, return if errors
if (empty($clientEmail) || empty($passwordCheck)) {
 $message = '<p class="notice">Please provide a valid email address and password.</p>';
 include '../view/login.php';
 exit;
}
  
// A valid password exists, proceed with the login process
// Query the client data based on the email address
$clientData = getClient($clientEmail);
// Compare the password just submitted against
// the hashed password for the matching client
$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
// If the hashes don't match create an error
// and return to the login view
if(!$hashCheck) {
  $message = '<p class="notice">Please check your password and try again.</p>';
  include '../view/login.php';
  exit;
}
// A valid user exists, log them in
$_SESSION['loggedin'] = TRUE;
// Remove the password from the array
// the array_pop function removes the last
// element from an array
array_pop($clientData);
// Store the array into the session
$_SESSION['clientData'] = $clientData;
// Send them to the admin view
include '../view/admin.php';
exit;

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
    setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
 $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
 header('Location: /acme/accounts/?action=login');
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
