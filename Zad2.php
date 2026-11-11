<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dziennik ocen</title>
</head>
<body>

    <h2>Dodaj ocenę</h2>

    <form method="POST">

        Imię i nazwisko ucznia:<br>
        <input type="text" name="uczen" required>
        <br><br>

        Przedmiot:<br>
        <input type="text" name="przedmiot" required>
        <br><br>

        Ocena:<br>
        <select name="ocena">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
        <br><br>

        <input type="submit" name="zapisz" value="Zapisz ocenę">

    </form>

    <h2>Zapisane oceny</h2>


<?php

if (isset($_POST["zapisz"])) {

    $uczen = $_POST["uczen"];
    $przedmiot = $_POST["przedmiot"];
    $ocena = $_POST["ocena"];

    $plik = fopen("oceny.txt", "a");

    fwrite($plik, $uczen . ";" . $przedmiot . ";" . $ocena . "\n");

    fclose($plik);
}

if (file_exists("oceny.txt")) {

    $plik = fopen("oceny.txt", "r");

    $wyniki = "";

    while (!feof($plik)) {

        $wiersz = fgets($plik);

        if ($wiersz !== false) {

            $dane = explode(";", trim($wiersz));

            if (count($dane) == 3) {

                $uczen = $dane[0];
                $przedmiot = $dane[1];
                $ocena = $dane[2];

                $wyniki .= htmlspecialchars($uczen) . " | ";
                $wyniki .= htmlspecialchars($przedmiot) . " | ";
                $wyniki .= "ocena: " . htmlspecialchars($ocena) . "<br>";

            }
        }
    }

    fclose($plik);

} else {

    $wyniki = "Brak zapisanych ocen.";

}


    echo $wyniki; ?>

</body>
</html>

