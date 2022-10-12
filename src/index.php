<?php
require __DIR__ . '\backend\check.php';
require __DIR__ . '\backend\openMaps.php';
require __DIR__ . '\backend\fileHandling.php';
require __DIR__ . '\backend\tabsHandler.php';

$file = "locationSaved.txt";
$file_handler = new FileHandling($file);
//this 'if' allows me to store the location inserted in the form by the user in locationSaved.txt
if (isset($_POST["submit1"])) { //submit1 is held inside index.html
    $check_location = new Place($_POST["city"], $_POST["country"]);

    if ($check_location->run()) {
        $file_handler->writeLocationOnFile($_POST["country"], $_POST["city"], $check_location->getCoordinates()); 
        header("Location: frontend/choice.html");
    } else {
        header("Location: frontend/index.html");
        //dare messaggio di errore
    }
    //this 'if' reads data from locationSaved.txt and redirects to third-party webpages giving them those data
} else if (isset($_POST["submit2"])) { //submit2 is held inside choice.html
    $tabs_handler = new tabsHandler();
    if (isset($_POST["hotel"]) && isset($_POST["position"])) {
        $maps = new OpenMaps($file_handler->getCoordinatesFromFile($file));
        $tabs_handler->runEverything($file_handler->getCityFromFile($file), $file_handler->getCountryFromFile($file), $maps->getURL());
    } else if (isset($_POST["position"])) {
        $maps = new OpenMaps($file_handler->getCoordinatesFromFile($file));
        $tabs_handler->showMaps($maps->getURL());
    } else if (isset($_POST["hotel"])) {
        $tabs_handler->showHotels($file_handler->getCityFromFile($file), $file_handler->getCountryFromFile($file));
    } else {
        header("Location: frontend/index.html");
        //dare messaggio di errore
    }
}
