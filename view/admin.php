<?php
            if ($_SESSION['clientData']['clientLevel'] == 3) {
                echo 'Admin';
            } else {
                echo 'User';
            }
?>

<?php $ptitle= 'My ACME Account'; include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav>
			<?php echo buildNav(); ?>
		</nav>
		<<main>
		<h1><?php echo "$clientFirstname $clientLastname";?></h1>
			<?php if (isset($message)) {echo $message;} ?>
			<?php if (isset($passwordMessage)) {echo $passwordMessage;} ?>
			<p>You are logged in! Here are your account details:</p>
			<ul>
				<li>First name: <strong><?php echo $clientFirstname; ?></strong></li>
				<li>Last name: <strong><?php echo $clientLastname; ?></strong></li>
				<li>Email: <strong><?php echo $clientEmail; ?></strong></li>
			</ul>
		</main>
<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
