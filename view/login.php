<!DOCTYPE html>
<!-- login view -->

<?php $ptitle= 'Login'; include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav>
			<?php echo buildNav(); ?>
		</nav>
        <h1>Login</h1>
        <h3>(All Fields are required)</h3>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
        <form action="/acme/accounts/" method="post">
            <fieldset>
                <label for="clientEmail">Email Address</label><br>
                <input type="email" required placeholder="Type Your Email" name="email" id="clientEmail" size="30"><br>
                <label for="clientPassword">Password</label><br>
                <input type="password" required placeholder="Type Your Password" name="password"  id="clientPassword" size="30" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            </fieldset>
                    <button type="submit" >Login</button>
                    <input type="hidden" name="action" value="login"> <br>
            <!-- <span>forgot password? <a href="/#" "email me">send reset email</a></span><br> -->
            <span>Don't have an account? Click below to register.</span><br>
            <input type="submit" value="Register" onclick="window.location.href='/acme/accounts?action=Registration'" />
        </form>

<?php include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>

<!--
          ___                              _...__
       .-'   '--._                       .'_     '-.
     .'     .--._ '-._                 .'.' \       '.
    /      /__   `'.  '.              / /    `\       \
   /      /   '-.    `\ \           /'/'       \      |
   |     |       '.    `\`\        / /     _.-'|      |
   |     |         \     \ \      / /    .'    |      /
    \    /          '.   | |,-~-,/ /   .'      \     /
     '--'           __\               /__       '._.'
                  ."  '.             .'  ".
                  |      '.       .'      |
                   \ ',    '.   .'    .' /
                   /'-.""-._ \ / _.-"".-'\
        _.=='''--,/ '/_.--._\'V'/_.--._\' \,--'''--._
      .'            _'-.__0_;\ /;_0__.-' _'          '.
     /     ,____..-'\'.      """      -'/'--..____,    \
    /     '          \       .=.       /          `     \
    |             __  '-.   .-=-.   .-'  __             |
     \      _.--''  ''---'. .-=-. .'---''  ''--._      /
      '----'            .-'  ___  '-.            `----'
         jgs           (    '   '    )
                        '.    _    .'
                          '--/ \--'
                             |#|
                             \_/
 -->
