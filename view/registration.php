<!-- Registration view -->
<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav >
      <?php echo buildNav(); ?>
		</nav>
      <div id="login">

<h1>Acme Registration</h1>
<p>All fields are required</p>
<?php
if (isset($message)) {
    echo $message;
  }
  ?>
<form action="/acme/accounts/index.php" method="post">
  <fieldset>
      <label for="clientFirstname">First name</label>
      <input name="clientFirstname" id="clientFirstname"><br>
      <label for="clientLastname">Last name</label>
      <input name="clientLastname" id="clientLastname"><br>
      <label for="clientEmail">Email Address</label>
      <input type="Email" name="clientEmail" id="clientEmail"><br>
      <label for="clientPassword">Password</label>
      <input type="Password" name="clientPassword" id="clientPassword">
      <label>&nbsp;</label><br>
      <input type="submit" name="submit" class="regbtn" value="Register">
     <!-- add the action key - value pair -->
      <input type="hidden" name="action" value="register">
  </fieldset>
</form>

      </div>
<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
