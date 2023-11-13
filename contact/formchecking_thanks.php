<?php

	$name = isset($_GET['name']) ? $_GET['name'] : false;
	$age = isset($_GET['age']) ? $_GET['age'] : false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Formcheckingthanks</title>
    <meta charset="UTF-8" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contact.css">
    <style>
    body {
        color: white;
    }
    </style>
</head>

<body>
    <header>
        <nav>
            <a id="navimg" href="../"><img class="logo" src="../Images/logo_Nathan.png" alt="Homepage"
                    width="150" /></a>
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../cv/">Over mij</a></li>
                <li><a href="../projecten/">Projecten</a></li>
                <li><a href="../contact/contactform.php">Contact</a></li>
                <li><a href="../blog/">Blog</a></li>
            </ul>
            <form style="display: inline" action="./" method="get">
                <button class="vibrate-1 button">Sign in</button>
            </form>
        </nav>
    </header>
    <main>
        <div class="dankwoord">
            <h1>dankje voor het bericht.</h1>
            <h2></h2>
        </div>
    </main>
    <div class="nameantwoord">
        <?php
	// Name sent in
	if ($name) {
		echo '<p>We zulles zo snel mogelijk op u bericht antwoorden ' . htmlentities($name). '</p>';
	}

	// Age sent in
	else if ($age) {
		echo '<p>We zulles zo snel mogelijk op u bericht antwoorden, ' . htmlentities($age). ' year old stranger</p>';
	}

	// Nothing sent in
	else {
		echo '<p>We zulles zo snel mogelijk op u bericht antwoorden, stranger</p>';
	}
?>
    </div>
    <div id="debug">

        <?php

	/**
	 * Helper Functions
	 * ========================
	 */

		/**
		 * Dumps a variable
		 * @param mixed $var
		 * @return void
		 */
		function dump($var) {
			echo '<pre>';
			var_dump($var);
			echo '</pre>';
		}


	/**
	 * Main Program Code
	 * ========================
	 */

		// dump $_GET
		//dump($_GET);

?>

    </div>

</body>

</html>