<?php
/* 
 * common functions
 */
function checkEmail($email) {
    //Remove any illegal characters from the email variable
    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    //Verify that the new sanitizedEmail variable is a valid email address
    $validatedEmail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
    //return the validated email address
    return $validatedEmail;
}
function checkPassword($password) {
    // Check the password for a minimum of 8 characters, and one or more of each of the following: 
    // upper case, lower case, number, special character
    //Define the pattern to be matched
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    //Compare the pattern and the password and return boolean
    return preg_match($pattern, $password);
}
function buildNav() {
    $categories = getCategories();
    // Build a navigation bar using the $categories array
    $navList = '<ul class="navbar">';
    $navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {
        $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    $navList .= '<p class=""></p>';
    return $navList;
}
function getCategories() {
    // Create a connection object from the acme connection function
    $db = acmeConnect();
    // The SQL statement to be used with the database
    $sql = 'SELECT categoryName, categoryId FROM categories ORDER BY categoryName ASC';
    // The next line creates the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement
    $stmt->execute();
    // The next line gets the data from the database and
    // stores it as an array in the $categories variable
    $categories = $stmt->fetchAll();
    // The next line closes the interaction with the database
    $stmt->closeCursor();
    // The next line sends the array of data back to where the function
    // was called (this should be the controller)
    return $categories;
}
