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
    <link rel="icon" href="../Images/logo.png" />
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;800&display=swap");

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
                <li><a href="../contact/">Contact</a></li>
                <li><a href="../blog/">Blog</a></li>
            </ul>
            <form style="display: inline" action="#" method="get">
                <button class="vibrate-1 button">Sign in</button>
            </form>
        </nav>
    </header>
    <main>
        <div class="dankwoord">
            <h1>Dankje voor het bericht.</h1>
        </div>
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
        <div class="gif">
            <!-- dit is niet van mij -->
            <img src="../Images/gif-email.gif" alt="email gif">
            <!-- dit is niet van mij -->
        </div>
    </main>
    <footer>
        <div class="container-footer">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="../Images/logo_Nathan.png" alt="Your Logo" width="200" />
                </div>
                <div class="footer-about">
                    <h3>About Me</h3>
                    <p>hallo, dit is mijn portfolio website voor webintroduction.</p>
                </div>
                <div class="footer-contact">
                    <h3>Contact</h3>
                    <ul>
                        <li>
                            <a href="mailto:NathanHommez@gmail.com">Email: NathanHommez@gmail.com</a>
                        </li>
                        <li>Phone: +32 123 32 11 12</li>
                        <li>
                            Address: 1600 Pennsylvania Avenue,<br />
                            N.W. Washington, DC 20500
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>