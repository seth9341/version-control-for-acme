<!DOCTYPE html>
<?php $ptitle= 'Product Management'; include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav>
				<?php echo $navList; ?>
		</nav>
    <body>
        <main>
            <div class="Product Management">
                    <!--is set message-->
                  <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <!--end-->
                <h1>Product Management</h1>
                <p>Welcome to our product management page. Please select an option below:
                <ul>
                    <li><a href="../products/index.php?action=add-category" >Add a New Category</a></li>
                    <li><a href="../products/index.php?action=add-product" >Add a New Product</a></li>
                </ul>
            </div>
        </main>

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';
            ?>
    </body>
</html>
