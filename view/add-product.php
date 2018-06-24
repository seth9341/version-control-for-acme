<?php
if (!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] == 1)) {
    header("location: /acme");
}
?>
<!DOCTYPE html>
<?php $ptitle= 'Add a product'; include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav>
            <?php echo buildNav() ?>
		</nav>

        <main>
            <form action="../products/index.php" method="post">
                <div>
                    <!--is set message-->
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                    <!--end php-->
                </div>
                <h1>Add a New Product</h1>
                <div>
                    <label for="invName">
                        Product's Name:<br>
                        <input type="text" id="invName" name="invName">
                        <br>
                    </label>
                    <label for="invDescription">
                        Product's Description:<br>
                        <textarea id="invDescription" name="invDescription">Product's description</textarea>
                        <!-- <input type="text" id="invDescription" name="invDescription"> -->
                        <br>
                    </label>
                    
                    <label for="invImage">
                        Product's Image (path to image):<br>
                        <input type="text" id="invImage" name="invImage" value="example:/acme/images/site/no-image.png">
                        <br>
                    </label>
                    <label for="invThumbnail">
                        Product's Thumbnail (path to thumbnail):<br>
                        <input type="text" id="invThumbnail" name="invThumbnail"  value="example: /acme/images/site/no-image.png">
                        <br>
                    </label>
                    <label for="invPrice">
                        Product's Price:<br>
                        <input type="text" id="invPrice" name="invPrice">
                        <br>
                    </label>
                    <label for="invStock">
                        Amount of product in stock:<br>
                        <input type="text" id="invStock" name="invStock">
                        <br>
                    </label>
                    <label for="invSize">
                        Product's Size:<br>
                        <input type="text" id="invSize" name="invSize">
                        <br>
                    </label>
                    <label for="invWeight">
                        Product's Weight:<br>
                        <input type="text" id="invWeight" name="invWeight">
                        <br>
                    </label>
                    <label for="invLocation">
                        Product's Location:<br>
                        <input type="text" id="invLocation" name="invLocation">
                        <br>
                    </label>
                    <label for="categoryId">
                        Product's Category:
                        <?php echo $catList; ?>
                        <br>
                    </label>
                    <label for="invVendor">
                        Product's Vendor:<br>
                        <input type="text" id="invVendor" name="invVendor">
                        <br>
                    </label>
                    <label for="invStyle">
                        Product's Style:<br>
                        <input type="text" id="invStyle" name="invStyle">
                        <br>
                    </label>
                </div>
                <div>
                    <!-- Add the action name - value pair -->
                    <input type="submit" name="submit" id="btn" value="Submit">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="add-prod">
                </div>
            </form>
        </main>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';
            ?>
    </body>
</html>

