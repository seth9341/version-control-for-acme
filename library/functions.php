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
    $proddisp = "<h1 id='inventoryItemTitle'>$product[invName]</h1>";
    $proddisp .= "<section id=productDetail><img id='productImage' src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>";
    $proddisp .= "<ul>";
    $proddisp .= "<li>$product[invDescription]</li>";
    $proddisp .= "<li><hr></li>";
    $proddisp .= "<li>Made by: $product[invVendor]</li>";
    $proddisp .= "<li>Primary material: $product[invStyle]</li>";
    $proddisp .= "<li>Weight: $product[invWeight]</li>";
    $proddisp .= "<li>product size: $product[invSize]</li>";
    $proddisp .= "<li>Ships from: $product[invLocation]</li>";
    $proddisp .= "<li>Product left in stock: $product[invStock]</li>";
    $proddisp .= "<li id=prodPrice> $$product[invPrice]</li>";
    $proddisp .= "</ul></section>";
    return $proddisp;
}


// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
        $id .= "<p><a href='/acme/uploads?action=delete&id=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invItem" id="invItem">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
// Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
// Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
// Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
// Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
// Moves the file to the target folder
        move_uploaded_file($source, $target);
// Send file for further processing
        processImage($image_dir_path, $filename);
// Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
// Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
// Set up the variables
    $dir = $dir . '/';

// Set up the image path
    $image_path = $dir . '/' . $filename;

// Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

// Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

// Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {

// Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

// Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    }

// Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

// Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

// If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

// Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

// Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

// Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

// Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

// Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
// Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
// Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
// Free any memory associated with the old image
    imagedestroy($old_image);
}

function buildThumbnails($prodThumbnails, $prodName) {
    $variable = "<hr><ul id='productThumbnails'>";
    foreach ($prodThumbnails as $thumbnail) {
        $variable .= "<li><img src='$thumbnail[imgPath]' alt='Image of $prodName on Acme.com'></li>";
    }
    $variable .= '</ul>';
    return $variable;
}

function buildInventoryDisplay($inventorySelector){
    $pd = "<section id=productDetail><img id='productImage' src='$inventorySelector[invImage]' alt='Image of $inventorySelector[invName] on Acme.com'>";
    // $pd = "<h1 id='inventoryItemTitle'>$product[invName]</h1>";
    // $pd .= "<section id=productDetail><img id='productImage' src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>";
    $pd .= "<ul>";
    $pd .= "<li>$inventorySelector[invDescription]</li>";
    $pd .= "<li><hr></li>";
    $pd .= "<li>Made by: $inventorySelector[invVendor]</li>";
    $pd .= "<li>Primary material: $inventorySelector[invStyle]</li>";
    $pd .= "<li>Weight: $inventorySelector[invWeight]</li>";
    $pd .= "<li>product size: $inventorySelector[invSize]</li>";
    $pd .= "<li>Ships from: $inventorySelector[invLocation]</li>";
    $pd .= "<li>Product left in stock: $inventorySelector[invStock]</li>";
    $pd .= "<li id=prodPrice> $ $inventorySelector[invPrice]</li>";
    $pd .= "</ul></section>"; 
 return $pd;
}


function getFeaturedInfo($invName){
 $db = acmeConnect();
 $sql = 'SELECT invName FROM inventory where invFeatured = 1';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $featuredInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $featuredInfo;
}
function buildFeatureDetailDisplay($product) {
    $roddisp = "<h1 id='inventoryItemTitle'>$product[invName]</h1>";
    $roddisp .= "<section id=productDetail><img id='productImage' src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>";
    $roddisp .= "<ul>";
    $roddisp .= "<li>$product[invDescription]</li>";
    $roddisp .= "<li><hr></li>";
    $roddisp .= "<li>Made by: $product[invVendor]</li>";
    $roddisp .= "<li>Primary material: $product[invStyle]</li>";
    $roddisp .= "<li>Weight: $product[invWeight]</li>";
    $roddisp .= "<li>product size: $product[invSize]</li>";
    $roddisp .= "<li>Ships from: $product[invLocation]</li>";
    $roddisp .= "<li>Product left in stock: $product[invStock]</li>";
    $roddisp .= "<li id=prodPrice> $$product[invPrice]</li>";
    $roddisp .= "</ul></section>";
    return $roddisp;
}
