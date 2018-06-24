<?php
if($_SESSION['clientData']['clientLevel'] < 2){
 header('location: /acme/');
 exit;
}
?>
<!DOCTYPE html>
    <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?> | Acme, Inc.</title>

<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<nav>
      <?php echo buildNav(); ?>

</nav>

<main>
<h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

        <form method="post" action="/acme/products/">
        <fieldset>

        <label for="invName">Product Name</label><br>
        <input type="text" readonly name="invName" id="invName" <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>><br>
        <label for="invDescription">Product Description</label><br>
        <textarea name="invDescription" readonly id="invDescription"><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea><br>

        <label>&nbsp;</label> 
        <input type="submit" class="regbtn" name="submit" value="Delete Product">

        <input type="hidden" name="action" value="deleteProd">
        <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">

        </fieldset>
        </form>
    </main>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';
            ?>
    </body>
</html>
