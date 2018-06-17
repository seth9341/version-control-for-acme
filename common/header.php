               <!-- ....
             ,''. :   __
                 \|_.'  `:       _.----._//_
                .'  .'.`'-._   .'  _/ -._ \)-.----O
               '._.'.'      '--''-'._   '--..--'-`
                .'.'___    /`'---'. / ,-'`
    snd       _<__.-._))../ /'----'/.'_____:'.
       \_    :            \ ]              :  '.
         \___:             \\              :    '.
             :              \\__           :    .'
             :_______________|__]__________:  .'
                        .' __ '.           :.'
                      .' .'  '. '.
                    .' .'      '. '.
                  .' .'          '. '.
               _.' .'______________'. '._
              [_0______________________0_]
			  "from https://www.asciiart.eu/cartoons/looney-tunes"
			  -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> <?php echo($ptitle);?> </title>
		<meta name="description" content="Acme">
		<meta name="viewport" content="width=device-width, initial-scale=1">
				<link href="https://fonts.googleapis.com/css?family=Stardos+Stencil" rel="stylesheet">
				<link href="https://fonts.googleapis.com/css?family=Bangers" rel="stylesheet">
				<link href="/acme/css/normalize.css" rel="stylesheet">
                                <link href="/acme/css/main.css" rel="stylesheet">

	</head>
	<body>
		<header id="header">
                    <a href="/acme/"><img id="logo" width="200" src="/acme/images/site/logo.gif" alt="ACME - Buy Here. Eat Roadrunner!"></a>
                    <div id="myAccount">
        <?php
        if (isset($_SESSION['loggedin'])) {
            echo "<a href='/acme/accounts/?action=Admin'>Welcome " . $_SESSION['clientData']['clientFirstname'];
            echo "<img src='/acme/images/site/account.gif' alt='account' height='30' width='35'/></a>\n\t\t";
            echo "<a href='/acme/accounts/?action=Logout'>Logout</a>";
        } else {
            echo "<a href='/acme/accounts/?action=Login'>My Account";
            echo "<img src='/acme/images/site/account.gif' alt='account' height='30' width='35'/></a>";
        }
        ?>
                    </div>
		</header>
	<main>

