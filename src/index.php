<?php
require __DIR__ . '\backend\check.php';
require __DIR__ . '\backend\openMaps.php';
require __DIR__ . '\backend\fileHandling.php';
require __DIR__ . '\backend\hotelHandler.php';

$file_handler = new FileHandling("locationSaved.txt");
//this 'if' allows me to store the location inserted in the form by the user in locationSaved.txt
if (isset($_POST["submit1"])) { //submit1 is held inside index.html
    $check_location = new Place($_POST["city"], $_POST["country"]);

    if ($check_location->run()) {
        $file_handler->writeLocationOnFile($_POST["country"], $_POST["city"], $check_location->getCoordinates()); //should work
        header("Location: frontend/choice.html");
    } else {
        header("Location: frontend/index.html");
        //dare messaggio di errore
    }
    //this 'if' reads data from locationSaved.txt and redirects to third-party webpages giving them those data
} else if (isset($_POST["submit2"])) { //submit2 is held inside choice.html

    if (isset($_POST["hotel"]) && isset($_POST["position"])) {
        $maps = new OpenMaps($file_handler->getCoordinatesFromFile("locationSaved.txt"));
        $hotel_handler = new hotelHandler($file_handler->getCityFromFile("locationSaved.txt"), $file_handler->getCountryFromFile("locationSaved.txt"));
        //bisognerebbe fare un nuova pagina dove ti linka a booking.com
        header("Location: " . $maps->getURL());
    } else if (isset($_POST["position"])) {
        $maps = new OpenMaps($file_handler->getCoordinatesFromFile("locationSaved.txt"));
        header("Location: " . $maps->getURL());
    } else if (isset($_POST["hotel"])) {
        $hotel_handler = new hotelHandler($file_handler->getCityFromFile("locationSaved.txt"), $file_handler->getCountryFromFile("locationSaved.txt"));
        $link_hotel = "https://www.booking.com/searchresults.en-gb.html?aid=356980&label=gog235jc-1FCAMoUEIRYXNodG9uLXVuZGVyLWx5bmVICVgDaHGIAQGYAQm4ARfIAQzYAQHoAQH4AQKIAgGoAgO4AtvnlJoGwAIB0gIkMTA1YjA1ZTctYThiOS00NGJlLTg1OGQtOGEwM2M1ZjY5NjYw2AIF4AIB&lang=en-gb&sid=bc7ff1bd94c70d3074accc02eed88354&sb=1&sb_lp=1&src=index&src_elem=sb&error_url=https%3A%2F%2Fwww.booking.com%2Findex.en-gb.html%3Faid%3D356980%26label%3Dgog235jc-1FCAMoUEIRYXNodG9uLXVuZGVyLWx5bmVICVgDaHGIAQGYAQm4ARfIAQzYAQHoAQH4AQKIAgGoAgO4AtvnlJoGwAIB0gIkMTA1YjA1ZTctYThiOS00NGJlLTg1OGQtOGEwM2M1ZjY5NjYw2AIF4AIB%26sid%3Dbc7ff1bd94c70d3074accc02eed88354%26sb_price_type%3Dtotal%26%26&ss=".$file_handler->getCityFromFile("locationSaved.txt")."&is_ski_area=0&checkin_year=&checkin_month=&checkout_year=&checkout_month=&group_adults=2&group_children=0&no_rooms=1&b_h4u_keep_filters=&from_sf=1&dest_id=&dest_type=&search_pageview_id=ef9e491fbdb90073&search_selected=false";
        header("Location: ".$link_hotel); //basta fare così?
        
    }
 else {
    header("Location: frontend/index.html");
    //dare messaggio di errore
}
}