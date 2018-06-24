<?php
if (!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] == 1)) {    header("location: /acme");
}
?>
<?php
// Build the categories option list
$catList = '<select name="categoryId" id="categoryId">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
    if (isset($categoryId)) {
        if ($category['categoryId'] === $categoryId) {
            $catList .= ' selected ';
        }
    } elseif (isset($invInfo['categoryId'])) {
        if ($category['categoryId'] === $invInfo['categoryId']) {
            $catList .= ' selected ';
        }
    }
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
?>
<!DOCTYPE html>
    <title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | Acme, Inc</title>

<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<nav>
      <?php echo buildNav(); ?>

</nav>

<main>
<h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

        <form method="post" action="/acme/products/">
        <label for="invName">Product Name</label><br>
        <input type="text" name="invName" id="invName" required <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>><br>
<?php echo $catList; ?><br>
<!-- I had to google how to do a textarea with the description -->
        <label for="invDescription">Product Description</label><br>
        <textarea name="invDescription"  rows="5" cols="20" required><?php if(isset($invDescription)){echo $invDescription;}elseif(isset($prodInfo['invDescription'])) {echo "$prodInfo[invDescription]"; } ?></textarea><br>
        <label for="invImage">Product Image</label><br>
        <input type="text" name="invImage" id="invImage"  <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; }?>><br>
        <label for="invThumbnail">Product Thumbnail</label><br>
        <input type="text" name="invThumbnail" id="invThumbnail"  <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?>><br>
        <label for="invPrice">Product Price</label><br>
        <input type="text" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?>><br>
        <label for="invStock">Product Stock</label><br>
        <input type="text" name="invStock" id="invStock" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?>><br>
        <label for="invSize">Product Size</label><br>
        <input type="text" name="invSize" id="invSize" required <?php if(isset($invSize)){ echo "value='$invSize'"; } elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?>><br>
        <label for="invWeight">Product Weight</label><br>
        <input type="text" name="invWeight" id="invWeight" required <?php if(isset($invWeight)){ echo "value='$invWeight'"; } elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?>><br>
        <label for="invLocation">Product Location</label><br>
        <input type="text" name="invLocation" id="invLocation" required <?php if(isset($invLocation)){ echo "value='$invLocation'"; } elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?>><br>
        <label for="invVendore">Product Vendore</label><br>
        <input type="text" name="invVendor" id="invVendor" required <?php if(isset($invVendor)){ echo "value='$invVendor'"; } elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?>><br>
        <label for="invStyle">Product Style</label><br>
        <input type="text" name="invStyle" id="invStyle" required <?php if(isset($invStyle)){ echo "value='$invStyle'"; } elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }?>><br>
            <input type="submit" name="submit" value="Update Product">
            <input type="hidden" name="action" value="updateProd">
<input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>"
</form>
    </main>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';
            ?>
    </body>
</html>
