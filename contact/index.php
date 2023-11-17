<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'Nathan_Hommez');
define('DB_PASS', 'M?2mi7n86'); 
define('DB_NAME', 'nathan_hommez_contact');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$email = isset($_POST['email']) ? (string)$_POST['email'] : '';
$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$msgEmail = '';
$msgName = '';
$msgMessage = '';
$connect = isset($_POST['connect']) ? (array)$_POST['connect'] : array();
$msgmconnect = '';

// form is sent: perform formchecking!

if (isset($_POST['btnSubmit'])) {

    $allOk = true;
    // Check for a valid email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msgEmail = 'Gelieve een geldig emailadres in te voeren';
        $allOk = false;
    }
    // name not empty
    if (trim($name) === '') {
        $msgName = 'Gelieve een naam in te voeren';
        $allOk = false;
    }

    if (trim($message) === '') {
        $msgMessage = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }

    if (trim(implode(", ", $connect)) === '') {
        $msgmconnect = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }
    if (empty($connect)) {
        $msgmconnect = 'Gelieve minstens één checkbox te selecteren';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        $stmt = $db->prepare('INSERT INTO messages (email, sender, message, added_on, connect) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$email, $name, $message, (new DateTime())->format('Y-m-d H:i:s'), implode(", ", $connect)]);

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?name=' . urlencode($name));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }

    }

}


?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/@csstools/normalize.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../Images/logo.png" />
    <title>Contactformulier</title>
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;800&display=swap");
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
        <div class="container-contact">
            <h1>Contacteer Mij</h1>
            <p>Wilt u met mij samenwerken laat dit dan zeker weten.</p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div>
                    <label for="name">Naam:</label>
                    <input type="text" id="name" name="name" placeholder="Naam"
                        value="<?php echo htmlentities($name); ?>" class="input-text" />
                    <span class="message error"><?php echo $msgName; ?></span>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Email adres"
                        value="<?php echo htmlentities($email); ?>" class="input-text" />
                    <span class="message error"><?php echo $msgEmail; ?></span>
                </div>
                <div>
                    <label for="message">Bericht:</label>
                    <textarea name="message" id="message" placeholder="Je bericht" rows="5"
                        cols="40"><?php echo htmlentities($message); ?></textarea>
                    <span class="message error"><?php echo $msgMessage; ?></span>
                </div>
                <div>
                    <fieldset class="checkbox">
                        <legend>Waar heeft u mij gevonden?</legend>
                        <div>
                            <input type="checkbox" name="connect[]" id="instagram" value="instagram"
                                <?php echo (in_array('instagram', $connect)) ? 'checked' : '' ?> /> <label
                                for="instagram">Instagram</label>
                        </div>
                        <div>
                            <input type="checkbox" name="connect[]" id="github" value="github"
                                <?php echo (in_array('github', $connect)) ? 'checked' : '' ?> /><label
                                for="github">Github</label>
                        </div>
                        <div>
                            <input type="checkbox" name="connect[]" id="other" value="other"
                                <?php echo (in_array('other', $connect)) ? 'checked' : '' ?> />
                            <label for="other">Other</label>
                        </div>
                    </fieldset>
                    <span class="message error"><?php echo $msgmconnect; ?></span>
                </div>

                <input type="submit" id="btnSubmit" name="btnSubmit" value="Verstuur" />
            </form>
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