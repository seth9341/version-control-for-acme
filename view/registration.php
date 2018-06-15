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
      <label for="clientFirstname">First name</label><br>
      <input name="clientFirstname" id="clientFirstname"><br>
      <label for="clientLastname">Last name</label><br>
      <input name="clientLastname" id="clientLastname"><br>
      <label for="clientEmail">Email Address</label><br>
      <input type="email" name="clientEmail" id="clientEmail"><br>
      <label for="clientPassword">Password</label><br>
      <label>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</label><br>
      <!-- <input type="password" name="clientPassword" id="clientPassword"> -->
      <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
      <label>&nbsp;</label><br>
      <input type="submit" name="submit" class="regbtn" value="Register">
      <!--add the action key - value pair-->
      <input type="hidden" name="action" value="register">
  </fieldset>
</form>

      </div>
<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
