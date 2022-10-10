<?php
require (dirname(__DIR__)) . '/vendor/autoload.php';

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

define("cellaMassima", 1804);

class ExcelAndDatabase
{

    private $arrayCity;
    private $arrayCountry;
    private $arrayLatitude;
    private $arrayLongitude;
    private $arrayCoordinate;




    private function readFromExcel(): void
    {
        //setting up objects for reading columns
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("uk-towns-sample.xlsx");
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load("uk-towns-sample.xlsx");
        $worksheet = $spreadsheet->getActiveSheet();
        try {
            $max = strval(cellaMassima);
            $this->arrayCity = $worksheet->rangeToArray('B2:B' . $max);
            $this->arrayCountry = $worksheet->rangeToArray('D2:D' . $max);
            $this->arrayLatitude = $worksheet->rangeToArray('H2:H' . $max);
            $this->arrayLongitude = $worksheet->rangeToArray('I2:I' . $max);
        } catch (Exception $e) {
            echo "columns couldn't be converted to arrays";
        }
    }

    private function formatCoordinate(): void
    { //per scrivere bene ogni coordinata
        $max = strval(cellaMassima);
        for ($i = 0; $i < $max - 1; $i++) {
            $this->arrayCoordinate[$i] = str_replace(',', '.', $this->arrayLatitude[$i][0]) . ',' . str_replace(',', '.', $this->arrayLongitude[$i][0]);
        }
        $this->arrayLatitude = NULL;
        $this->arrayLongitude = NULL;
    }

    private function connectToDatabase(): void
    {
        DB::$user = 'root';
        DB::$password = '';
        DB::$dbName = 'maps';
    }

    private function writeToDatabase(): void
    {
        $max = strval(cellaMassima);
        for ($i = 0; $i < $max - 1; $i++) {
            DB::query("INSERT INTO localita (coordinates,country,city) 
                 VALUES (%s,%s,%s)", $this->arrayCoordinate[$i], $this->arrayCountry[$i][0], $this->arrayCity[$i][0]);
        }
    }


    public function run(): void
    {
        $this->readFromExcel();
        $this->connectToDatabase();
        $this->formatCoordinate();
        $this->writeToDatabase();
    }
}
//PER FARE PARTIRE IL PROGRAMMA TOGLI I COMMENTI QUI SOTTO
//$excel = new ExcelAndDatabase();
//$excel->run();
