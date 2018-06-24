<?php

/* 
 * model for accounts application
 */

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    $db = acmeConnect();
//    the SQL statement to be used with the database
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) VALUES (:firstname, :lastname, :email, :password)';
    // Create the prepared statement using the acme connection file
    $stmt = $db->prepare($sql);
//    the next four lines replace the placeholders in the SQL statement with
//    the actual values in the variables and tells the database what type of
//    data it is
$stmt->bindValue(':firstname', $clientFirstname, PDO::PARAM_STR);
$stmt->bindValue(':lastname', $clientLastname, PDO::PARAM_STR);
$stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
$stmt->bindValue(':password', $clientPassword, PDO::PARAM_STR);
//use the prepared statement to insert the data
    $stmt->execute();
//    now we find out if the insert worked by asking how many rows changed in
//    the table
     $rowsChanged = $stmt->rowCount();
//     close the database connection
     $stmt->closeCursor();
//     return the indication of success
 return $rowsChanged;
}

// Check for an existing email address
function checkExistingEmail($clientEmail) {
 $db = acmeConnect();
 $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
 $stmt->execute();
 $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
 $stmt->closeCursor();
 if(empty($matchEmail)){
 return 0;
     // echo 'Nothing found';
     exit;
 } else {
 return 1;
  // echo 'Match found';
  exit;
 }
}

// Get client data based on an email address
function getClient($clientEmail){
 $db = acmeConnect();
 $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
         FROM clients
         WHERE clientEmail = :email';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
 $stmt->execute();
 $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clientData;
}

function updateAccount($clientFirstname, $clientLastname, $email, $clientId) {
    $db = acmeConnect();
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail, clientId = :clientId WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $email, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function updatePassword($clientPassword, $clientId) {
    $db = acmeConnect();
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
