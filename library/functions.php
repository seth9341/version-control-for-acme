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
        $navList .="<li><a href='/acme/products/?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
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

function buildProductsDisplay($products){
 $pd = '<ul id="prod-display">';
 foreach ($products as $product) {
  $pd .= '<li>';
  $pd .= "<li><a href='/acme/products/?action=productDetail&invId=$product[invId]'> ";
  $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
  $pd .= '<hr>';
  $pd .= "<h2>$product[invName]</h2>";
  $pd .= "<span>$product[invPrice]</span>";
  $pd .= '</li>';
 }
 $pd .= '</ul>';
 return $pd;
}

function buildProductDetailDisplay($product) {
    $superCoolVariableName = "<h1 id='inventoryItemTitle'>$product[invName]</h1>";
    $superCoolVariableName .= "<section id=productDetail><img id='productImage' src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>\n";
    $superCoolVariableName .= "<ul>\n";
    $superCoolVariableName .= "<li>$product[invDescription]</li>\n";
    $superCoolVariableName .= "<li><hr></li>\n";
    $superCoolVariableName .= "<li>Made by: $product[invVendor]</li>\n";
    $superCoolVariableName .= "<li>Primary material: $product[invStyle]</li>\n";
    $superCoolVariableName .= "<li>Weight: $product[invWeight]</li>\n";
    $superCoolVariableName .= "<li>product size: $product[invSize]</li>\n";
    $superCoolVariableName .= "<li>Ships from: $product[invLocation]</li>\n";
    $superCoolVariableName .= "<li>Product left in stock: $product[invStock]</li>\n";
    $superCoolVariableName .= "<li id=prodPrice> $$product[invPrice]</li>";
    $superCoolVariableName .= "</ul></section>\n";
    return $superCoolVariableName;
}
