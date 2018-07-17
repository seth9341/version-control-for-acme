<!DOCTYPE html>
<?php $ptitle= 'Product Management'; include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        <nav>
            <?php echo buildNav() ?>
        </nav>
        <main id="prod-display">
            <?php echo $productInfo; ?>

        </main>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';
            ?>
