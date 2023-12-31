<?php

// Constanten (connectie-instellingen databank)
define ('DB_HOST', 'localhost');
define('DB_USER', 'Nathan_Hommez');
define('DB_PASS', 'M?2mi7n86');
define('DB_NAME', 'nathan_hommez_contact');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' .  $e->getMessage();
    exit;
}

// Opvragen van alle taken uit de tabel tasks
$stmt = $db->prepare('SELECT sender, email, message, connect, added_on FROM messages ORDER BY added_on DESC');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <title>Mijn berichten</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="icon" href="../Images/logo.png" />
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
            <form style="display: inline" action="./" method="get">
                <button class="vibrate-1 button">Sign in</button>
            </form>
        </nav>
    </header>
    <main>
        <div class="messagepage">
            <h1>My messages</h1>
            <?php if (sizeof($items) > 0) { ?>
            <ul>
                <?php foreach ($items as $item) { ?>
                <li>
                    Naam: <?php echo htmlentities($item['sender']); ?><br>
                    Email: <?php echo htmlentities($item['email']); ?><br>
                    Bericht: <?php echo htmlentities($item['message']); ?><br>
                    App: <?php echo htmlentities($item['connect']); ?><br>
                    Tijd: <?php echo (new DateTime($item['added_on']))->format('d-m-Y H:i:s'); ?>
                </li>
                <?php } ?>
            </ul>
            <?php
    } else {
        echo '<p>Nog geen berichten ontvangen.</p>' . PHP_EOL;
    }
    ?>
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