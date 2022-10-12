<?php

class OpenMaps
{

    private $URL = "https://www.google.it/maps/@";
    private $zoom = ",12z";

    function __construct($coordinates)
    {
        $this->URL = $this->URL . $coordinates . $this->zoom;
    }



    public function getURL()
    {
        return $this->URL;
    }
}
