<!-- 
       db        ,ad8888ba,  88b           d88 88888888888  
      d88b      d8"'    `"8b 888b         d888 88           
     d8'`8b    d8'           88`8b       d8'88 88           
    d8'  `8b   88            88 `8b     d8' 88 88aaaaa      
   d8YaaaaY8b  88            88  `8b   d8'  88 88"""""      
  d8""""""""8b Y8,           88   `8b d8'   88 88           
 d8'        `8b Y8a.    .a8P 88    `888'    88 88           
d8'          `8b `"Y8888Y"'  88     `8'     88 88888888888  
 -->

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

