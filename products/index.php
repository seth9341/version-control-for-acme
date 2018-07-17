<!-- * Products Controller -->
<?php
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}
    session_start();
    // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/acme-model.php';
    require_once '../model/products-model.php';
    //get the common functions
    require_once '../library/functions.php';
// Create or access a Session

$categories = getCategories();

$navList = buildNav($categories);
    
    switch ($action){
    case 'add-category':
        include '../view/add-category.php';
        break;
    case 'add-product':
        include '../view/add-product.php';
        break;
        case 'add-category':
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
            if (empty($categoryName)) {
                $message = '<p>Please enter a category name.</p>';
                include '../view/add-category.php';
                exit;
            }
            $newCategoryOutcome = newCategory($categoryName);
            if ($newCategoryOutcome === 1) {
                $message = "<p>Successfully added $categoryName as a new category.</p>";
                include '../view/add-category.php';
                exit;
            } else {
                $message = "<p>Failed to add $categoryName. Please try again.</p>";
                include '../view/add-category.php';
                exit;
            }            
        case 'add-product':
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_FLAG_ALLOW_FRACTION);
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_FLAG_ALLOW_FRACTION);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
            if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
                if (empty($categoryId)) {
                    $message = "<p>Error processing categories</p>";
                } else {
                    $message = '<p>All fields are required. Please fill all fields.</p>';
                    include '../view/add-product.php';
                    exit;
                }
            }
            $newProductOutcome = newProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
            if ($newProductOutcome === 1) {
                $message = "<p>The product $invName has been added to the inventory.</p>";
                include '../view/add-product.php';
                exit;
            } else {
                $message = "<p>Failed to add $invName. Please try again.</p>";
                include '../view/add-product.php';
                exit;
            }
        case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if(count($prodInfo)<1){
        $message = 'Sorry, no product information could be found.';
        }
        include '../view/product-update.php';
        exit;

        case 'updateProd':
 $catType = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_NUMBER_INT);
 $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
 $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
 $invImg = filter_input(INPUT_POST, 'invImg', FILTER_SANITIZE_STRING);
 $invThumb = filter_input(INPUT_POST, 'invThumb', FILTER_SANITIZE_STRING);
 $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
 $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
 $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
 $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
 $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
 $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
 $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

 if (empty($invName) || empty($invDescription) || empty($invImg) || empty($invThumb) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
  $message = '<p>Please complete all information for the item! Double check the category of the item.</p>';
  include '../view/product-update.php';
  exit;
 }
 $updateResult = updateProduct($invName, $invDescription, $invImg, $invThumb, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);
 if ($updateResult) {
  $message = "<p class='notice'>Congratulations, $invName was successfully updated.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 } else {
  $message = "<p class='notice'>Error. $invName was not updated.</p>";
  include '../view/product-update.php';
  exit;
 }
break;
case 'del':
 $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 $prodInfo = getProductInfo($invId);
 if (count($prodInfo) < 1) {
  $message = 'Sorry, no product information could be found.';
 }
 include '../view/product-delete.php';
 exit;
 break;

case 'feat':
        $oldName = currentFeature();
        clearFeature();
        $invID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        newFeature($invID);
        $newName = getCurrentFeature;
        $message = "<p class='displayMessage'>$oldName[invName] was removed as the featured product.</p>";
        $message .= "<p class='displayMessage'>$newName[invName] was successfully added as the featured product.</p>";
        $_SESSION['message'] = $message;
        header ('location: /acme/products/index.php');
break;
 
 case 'deleteProd':
 $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
 $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

 $deleteResult = deleteProduct($invId);
 if ($deleteResult) {
  $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 } else {
  $message = "<p class='notice'>Error: $invName was not deleted.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 }
 break;
case 'category':
 $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
 $products = getProductsByCategory($categoryName);
 if(!count($products)){
  $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
 } else {
  $prodDisplay = buildProductsDisplay($products);
 }
 // echo $prodDisplay;
 // exit;
 include '../view/category.php';
break;
     case 'productDetail':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $product = getProductInfo($invId);
        if (isset($product['invName'])) {
            $productInfo = buildProductDetailDisplay($product);
        } else {
            $productInfo = "That product doesn't exist!";
        }
        include '../view/product-detail.php';
break;
        case 'featureDetail':
        $invID = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $product = getFeaturedInfo($invFeatured);
        if (isset($product['invName'])) {
            $featureInfo = buildFeatureDisplay($product);
        } else {
            $featureInfo = "That item doesn't exist!";
        }
        // include '../view/product-detail.php';

break;
        default:
        $products = getProductBasics();
        if(count($products) > 0){
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th colspan="4">Product Name</th>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td>";
                $prodList .= "<td><a href='/acme/products?action=feat&id=$product[invId]' title='Click to set featured'>Set Featured</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
}

include '../view/product-management.php';
}
?>
