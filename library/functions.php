<?php
/* 
 * common functions
 */
function checkEmail($email) {
    // Remove any illegal characters from the email address
    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    //Verify that the email is valid
    $validatedEmail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
    //return the validated email address
    return $validatedEmail;
}
function checkPassword($password) {
    // Check the password for a minimum of 8 characters, and one or more of each of the following: 
    // upper case, lower case, number, special character
    // Define the pattern to be matched
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    //Compare the pattern to the password and return boolean
    return preg_match($pattern, $password);
}
function buildNav() {
    $categories = getCategories();
    // Build a navmenu using the $categories array
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
    $db = acmeConnect();
    $sql = 'SELECT categoryName, categoryId FROM categories ORDER BY categoryName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    $stmt->closeCursor();
    return $categories;
}
