<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<?php $ptitle= 'Product Management'; include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav>
            <?php echo buildNav() ?>
		</nav>
    <body>
        <main>
            <!-- <div class="Product Management"> -->
        <h1>Product Management</h1>
        <p>Welcome to our product management page. Please select an option below: <br><br>
        <ul>
        <li><a href="../products/index.php?action=add-category" >Add a New Category</a></li>
        <li><a href="../products/index.php?action=add-product" >Add a New Product</a></li>
        </ul> <br>
            <?php
            if (isset($message)) {
             echo $message;
            } if (isset($prodList)) {
             echo $prodList;
            }
            ?>
            <!-- </div> -->
        </main>

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';
            ?>
    </body>
</html>
<?php unset($_SESSION['message']); ?>
