<?php
// Gästebuch-Datei definieren
$guestbookFile = 'guestbook.txt';

// Neuen Eintrag speichern, falls das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name']) && !empty($_POST['message'])) {
    $name = htmlspecialchars($_POST['name']); // Name bereinigen
    $message = htmlspecialchars($_POST['message']); // Nachricht bereinigen
    $entry = date('d.m.Y H:i:s') . " - <strong>$name</strong>: $message\n"; // Formatieren
    file_put_contents($guestbookFile, $entry, FILE_APPEND); // In die Datei schreiben
}

// Alle Gästebucheinträge lesen
$entries = file_exists($guestbookFile) ? file($guestbookFile, FILE_IGNORE_NEW_LINES) : [];
?>

<!--für den Abschnitt bis hier wurde ChatGPt für die Grundstruktur als Hilfsmittel verwendet-->

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Gästebuch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            padding: 10px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input, textarea {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .entries {
            margin-top: 20px;
        }
        .entry {
            margin-bottom: 10px;
            padding: 10px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>PHP Gästebuch</h1>

    <!-- Aktuelles Datum und Uhrzeit -->
    <p>Aktuelles Datum und Uhrzeit: <strong><?php echo date('d.m.Y H:i:s'); ?></strong></p>

    <!-- Formular für Gästebucheinträge -->
    <form method="POST" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>

        <label for="message">Nachricht:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br>

        <button type="submit">Eintrag hinzufügen</button>
    </form>

    <!-- Anzeige der Gästebucheinträge -->
    <div class="entries">
        <h2>Gästebucheinträge:</h2>
        <?php if (empty($entries)): ?>
            <p>Noch keine Einträge vorhanden.</p>
        <?php else: ?>
            <?php foreach ($entries as $entry): ?>
                <div class="entry"><?php echo $entry; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
