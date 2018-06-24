<?php $ptitle= 'My ACME Account'; include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav>
			<?php echo buildNav(); ?>
		</nav>
		<main>
            <?php
            if (isset($message)) {
                echo "<h3>" . $message . "</h3>";
            } elseif (isset($_SESSION['message'])) {
                echo "<h3>" . $_SESSION['message'] . "</h3>";
            }
            ?>
            <?php
            echo 'Welcome ' . $_SESSION['clientData']['clientFirstname'];
            echo ' ' . $_SESSION['clientData']['clientLastname'];
            echo '<ul>';
            foreach ($_SESSION['clientData'] as $name => $item) {
                if (($name != 'clientPassword') && ($name != 'clientId') && ($name != 'clientLevel')) {
                    echo '<li>' . $name . ': ' . $item . '</li>';
                }
            }
            echo '</ul>';
            ?>
            <?php
            echo "<a href='/acme/accounts/?action=updateAccount' title='Update Account Information'>Update Account Information</a>";

            if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<hr><h2>Admin tools:</h2>';
                echo "<a href='/acme/products/?action=product-management' title='View the Acme Products page.'>Click here to manage products in the inventory!</a>";
            }
            ?>

<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
