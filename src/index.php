<?php
require __DIR__ . '/check.php';
require __DIR__ . '/openMaps.php';
require __DIR__ . '/fileHandling.php';

$fileHandler = new FileHandling("locationSaved.txt");
if (isset($_POST["submit1"])) {
    $check = new Place($_POST["city"], $_POST["country"]);
    if ($check->run()) {
        $fileHandler->writeLocationOnFile($_POST["country"], $_POST["city"], $_POST["submit1"], $check->getCoordinates()); //should work
        header("Location: frontend/choice.html");
    } else {
        header("Location: frontend/index.html");
        //dare messaggio di errore
    }
} else if (isset($_POST["submit2"])) {
    if (isset($_POST["position"])) {
        $maps = new OpenMaps($fileHandler->getCoordinatesFromFile("locationSaved.txt")); //it should read the coordinates from the file, might be wrong
        header("Location: " . $maps->getURL());
    } else if (isset($_POST["hotel"])) {
        //do what hotels do
    } else if (isset($_POST["hotel"]) || isset($_POST["position"])) {
        $maps = new OpenMaps($fileHandler->getCoordinatesFromFile("locationSaved.txt")); //it should read the coordinates from the file
        header("Location: " . $maps->getURL());
        //do what hotels do
    }
}
else{
    header("Location: frontend/index.html");
    //dare messaggio di errore
}
