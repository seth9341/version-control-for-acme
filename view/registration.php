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
    <form method="post" action="/acme/accounts/">
      <fieldset>
        <label for="clientFirstname">First name</label><br>
              <input type="text"  required placeholder="First Name" name="firstname" id="firstname" <?php
                     if (isset($firstname)) {
                         echo "value='$firstname'";
                     }
                     ?>><br>
      <label for="clientLastname">Last name</label><br>
              <input type="text"  required placeholder="Last Name" name="lastname" id="lastname" <?php
                     if (isset($lastname)) {
                         echo "value='$lastname'";
                     }
                     ?>> <br>
      <label for="clientEmail">Email Address</label><br>
              <input type="email" required placeholder="Email Address" name="email" 
                     id="email"  <?php
                     if (isset($email)) {
                         echo "value='$email'";
                     }
                     ?>><br>
      <label for="clientPassword">Password</label><br>
              <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> <br>
              <input type="password" required placeholder="Password" name="password"  id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
              <button type="submit">Create Account</button>
              <!-- Add the action name - value pair -->
              <input type="hidden" name="action" value="Register">
        </fieldset>
      </form>

      </div>
<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
