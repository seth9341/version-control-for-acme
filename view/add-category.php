<!DOCTYPE html>
<?php $ptitle= 'Add a category'; include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav>
            <?php echo buildNav() ?>
		</nav>
    <body>
        <main>
            <form action="../products/index.php" method="post">
                <div class="error">
                    <!--is set message-->
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                    <!--end php-->
                </div>
                <h1>Add a New Category</h1>
                <div class="field">
                    <label for="categoryName">
                        Category Name:<br>
                        <input type="text" id="categoryName" name="categoryName">
                        <br>
                    </label>
                </div>
                <div>
                    <!-- Add the action name - value pair -->
                    <input type="submit" name="submit" id="btn" value="Submit">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="add-cat">
                </div>
            </form>
        </main>

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';
            ?>
    </body>
</html>

