<?php
//Accounts Controller

// Create or access a Session
 session_start();
 
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
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action){
 case 'login' : 
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
 default :
    include '../view/login.php';
}
