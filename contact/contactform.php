<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'contact');

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

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        $stmt = $db->prepare('INSERT INTO messages (email, sender, message, added_on) VALUES (?, ?, ?, ?)');
        $stmt->execute([$email, $name, $message, (new DateTime())->format('Y-m-d H:i:s')]);

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
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" href="../css/style.css">
    <title>Contactformulier</title>
    <style>

    </style>
</head>

<body>
    <header>
        <nav>
            <a id="navimg" href="../"><img class="logo" src="../Images/logo Nathan$.png" alt="Homepage"
                    width="150" /></a>
            <ul>
                <li><a href="../cv/">Over mij</a></li>
                <li><a href="../projecten/">Projecten</a></li>
                <li><a href="../contact/contactform.php">Contact</a></li>
                <li><a href="../blog/">Blog</a></li>
            </ul>
            <div class="button">
                <form style="display: inline" action="./signin/" method="get"></form>
                <button class="vibrate-1">Sign in</button>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-contact">
            <h1>Contacteer ons</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name" placeholder="Naam" value="<?php echo $name; ?>"
                    class="input-text" />
                <span class="message error"><?php echo $msgName; ?></span>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email adres" value="<?php echo $email; ?>"
                    class="input-text" />

                <span class="message error"><?php echo $msgEmail; ?></span>



                <label for="message">Bericht:</label>
                <textarea name="message" id="message" placeholder="Je bericht" rows="5"
                    cols="40"><?php echo $message; ?></textarea>
                <span class="message error"><?php echo $msgMessage; ?></span>

                <input type="submit" id="btnSubmit" name="btnSubmit" value="Verstuur" />
            </form>
        </div>
    </main>
</body>


</html>