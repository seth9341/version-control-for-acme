    <title><?php echo $categoryName; ?> Products | Acme, Inc.</title>

<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<nav>
      <?php echo buildNav(); ?>
</nav>
		<h1><?php echo $categoryName; ?> Products</h1>

		<?php if(isset($message)){
		 echo $message; } 
		 ?>

		<?php if(isset($prodDisplay)){ 
		 echo $prodDisplay; 
		} ?>

<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
