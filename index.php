<?php

// Get the database connection file
 require_once 'library/connections.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';
 //get the common functions
 require_once './library/functions.php';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action) {
     case 'Home':
         include 'view/home.php';
         break;
     case 'Template':
         include 'view/template.php';
         break;
 default :
     include 'view/home.php';
 } 

