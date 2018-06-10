<?php $ptitle= 'ACME: Buy Here. Eat Roadrunner. '; include  $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
		<nav >
            <?php echo buildNav() ?>
		</nav>

			<div class="divtree">
			</div>
		<h1>Welcome to Acme!</h1>
		<div id="rocketfeature">
			<img src="/acme/images/site/rocketfeature.jpg" alt="Acme Rocket!">
			<div id="rockettext">
				<ul>
					<li><h2>Acme Rocket</h2></li>
					<li>Quick lighting fuse</li>
					<li>NHTSA approved seat belts</li>
					<li>Mobile launch stand included</li>
					<li id="actionbtn"><a href="/acme/#"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
				</ul>
			</div>
		</div>
		<div id=mayhem>
			<div id="recipes">
				<table>
					<tbody>
						<h5>Featured Recipes</h5>
						<tr>
							<td><a href="/acme/#"><img class="recipes" src="/acme/images/recipes/bbqsand.jpg" width="65px"></a></br>
							Pulled Roadrunner BBQ</td>
							<td><a href="/acme/#"><img class="recipes" src="/acme/images/recipes/potpie.jpg" width="65px"></a></br>
							Roadrunner Pot Pie</td>
						</tr>
						<tr>
							<td><a href="/acme/#"><img class="recipes" src="/acme/images/recipes/soup.jpg" width="65px"></a></br>
							Roadrunner Soup</td>
							<td><a href="/acme/#"><img class="recipes" src="/acme/images/recipes/taco.jpg" width="65px"></a></br>
							Roadrunner Tacos</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id = "reviews">
				<h5>Acme Rocket Reviews</h5>
					<ul>
						<li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
						<li>"That thing was fast!" (4/5)</li>
						<li>"Talk about fast delivery." (5/5)</li>
						<li>"I didn't even have to pull the meat apart." (4.5/5)</li>
						<li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
					</ul>
				
			</div>
		</div>
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
