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
$stmt = $db->prepare('SELECT sender, email, message, added_on FROM messages ORDER BY added_on DESC');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <title>Mijn berichten</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/contact.css">
</head>

<body>
    <div class="messagepage">
        <h1>My messages</h1>
        <?php if (sizeof($items) > 0) { ?>
        <ul>
            <?php foreach ($items as $item) { ?>
            <li>
                Naam: <?php echo htmlentities($item['sender']); ?><br>
                Email: <?php echo htmlentities($item['email']); ?><br>
                Bericht: <?php echo htmlentities($item['message']); ?><br>
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
</body>

</html>