<?php

class FileHandling
{

    private $file;
    function __construct($file)
    {
        $this->file = $file;
    }
    function writeLocationOnFile($country,$city,$submitted,$coordinates):void
    {
        if (isset($submitted)) {
            $fileOpen = fopen($this->file, "w");
            fwrite($fileOpen, $country);
            fwrite($fileOpen, " ");
            fwrite($fileOpen, $city);
            fwrite($fileOpen, " ");
            fwrite($fileOpen, $coordinates);
            fclose($fileOpen);
        }
    }
    function readLocationFromFile():void{

    }

    function getCoordinatesFromFile($file) :string { //THIS HAS TO BE CORRECTED
        $fileReader = file($file); //read file line by line
		foreach ($file as $val) {
			if (trim($val) != '') { //ignore empty lines
				$expl = explode("|", $val);
				$firstWords[] = $expl[2]; //add third word to the stack/array (that's the coordinates)
			}
		}
		return $firstWords[0];
    }

}
