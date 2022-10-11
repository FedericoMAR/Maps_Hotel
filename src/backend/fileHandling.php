<?php

class FileHandling
{

    private $file;
    function __construct($file)
    {
        $this->file = $file;
    }
    function writeLocationOnFile($country,$city,$coordinates):void
    {
            $fileOpen = fopen($this->file, "w");
            fwrite($fileOpen, $country);
            fwrite($fileOpen, " ");
            fwrite($fileOpen, $city);
            fwrite($fileOpen, " ");
            fwrite($fileOpen, $coordinates);

    }
    function readLocationFromFile():void{

    }

    function getCoordinatesFromFile($file) :string { //THIS HAS TO BE CORRECTED
        $f = fopen($file, 'r');
        $line = fgets($f);
        fclose($f);
        $line = explode(" ",$line);
        return $line[2];
    }
    function getCityFromFile($file):string{
        $f = fopen($file, 'r');
        $line = fgets($f);
        fclose($f);
        $line = explode(" ",$line);
        return $line[1];
    }

    function getCountryFromFile($file):string{
        $f = fopen($file, 'r');
        $line = fgets($f);
        fclose($f);
        $line = explode(" ",$line);
        return $line[0];
    }

}
