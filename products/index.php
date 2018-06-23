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

    // buildNav();
    // // $navList = buildNav();
    // $categories = getCategories();
    // $catList = buildCategoryList();
    // $action = filter_input(INPUT_POST, 'action');
    // if ($action == NULL){
    //     $action = filter_input(INPUT_GET, 'action');
    //     if($action == NULL ) {
    //         $action= 'product-management';
    //     }
    // }

$categories = getCategories();

$navList = buildNav($categories);
    
    switch ($action){
        case 'add-product':
            $message = '';
            include '../view/add-product.php';
            break;
        case 'product-management':
            include '../view/product-management.php';
            break;
        case 'add-category':
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
            if (empty($categoryName)) {
                $message = '<p>Please enter a category name.</p>';
                include '../view/add-category.php';
                exit;
            }
            $newcat = newCategory($categoryName);
            if ($newcat === 1) {
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
            $newProduct = newProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
            if ($newProduct === 1) {
                $message = "<p>The product $invName has been added to the inventory.</p>";
                include '../view/add-product.php';
                exit;
            } else {
                $message = "<p>Failed to add $invName. Please try again.</p>";
                include '../view/add-product.php';
                exit;
            }
        default:
        $products = getProductBasics();
        if(count($products) > 0){
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
}
        include '../view/product-management.php';
}
?>
