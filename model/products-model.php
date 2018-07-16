<?php
// function buildCategoryList() {
//     $categories = getCategories();
//     $catList = '<select name="categoryId" id="categoryId">';
//     foreach ($categories as $category) {
//         $catList .= '<option value="'.urlencode($category['categoryId']).'">'.urlencode($category['categoryName']).'</option>';
//     }
//     $catList .= '</select>';
//     return $catList;
// }
function newCategory($categoryName){
    $db = acmeConnect();
    $sql = 'INSERT INTO categories (categoryName)
        VALUES ( :categoryName )';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
function newProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle) {
    $db = acmeConnect();
    $sql = 'INSERT INTO inventory(invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle)
    VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Update a product
function updateProduct($catType, $invName, $invDescription, $invImg, $invThumb, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId) {
// Create a connection
$db = acmeConnect();
// The SQL statement to be used with the database
$sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImg, invThumbnail = :invThumb, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :catType, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':catType', $catType, PDO::PARAM_INT);
$stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
$stmt->bindValue(':invImg', $invImg, PDO::PARAM_STR);
$stmt->bindValue(':invThumb', $invThumb, PDO::PARAM_STR);
$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
$stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
$stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
$stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
$stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
$stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
$stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

function deleteProduct($invId) {
 $db = acmeConnect();
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

function getProductBasics() {
 $db = acmeConnect();
 $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

// selecting a single product based on its id
// Get product information by invId
function getProductInfo($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

function getProductsByCategory($categoryName){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

function getCurrentFeature() {
 $db = acmeConnect();
 $sql = 'SELECT invName FROM inventory where invFeatured = 1';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $featuredProduct = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $featuredProduct;
}

function clearFeature() {
 $db = acmeConnect();
 $sql = 'UPDATE inventory SET invFeatured = NULL WHERE invFeatured = 1';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $stmt->closeCursor();
}

function newFeature($invId) {
 $db = acmeConnect();
 $sql = 'UPDATE inventory SET invFeatured = 1 WHERE invId = :invID';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invID', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $stmt->closeCursor();
}

