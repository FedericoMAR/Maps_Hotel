<?php
require "../../vendor/autoload.php";

class Place
{

	private $input_city = NULL;
	private $input_country = NULL;
	private $coordinate = NULL;

	function __construct($input_city, $input_country)
	{
		$input_country = $this->setCase($input_country);
		$input_city = $this->setCase($input_city);
		$this->input_city = $input_city;
		$this->input_country = $input_country;
	}

	public function getCity(): string
	{
		return $this->input_city;
	}
	public function getCountry(): string
	{
		return $this->input_country;
	}
	public function getCoordinates(): string
	{
		return $this->coordinate[0]["coordinates"];
	}
	public function setCoordinates($country, $city): void
	{
		$this->coordinate = DB::query("SELECT coordinates FROM localita
		WHERE country = %s AND city = %s", $country, $city);
	}

	private function checkCountry(): string 
	{
		$countries = DB::query("SELECT country from localita GROUP BY country");
		foreach ($countries as $country) {
			if ($this->input_country == $country["country"]) {
				return $country["country"];
			}
		}
		throw new Exception("input_country doesn't exist");
	}

	private function checkCity($country) : string 
	{
		$cities = DB::query("SELECT city FROM localita 
		WHERE country = %s", $country);
		foreach ($cities as $city) {
			if ($this->input_city === $city["city"]) {
				return $city["city"];
			}
		}
		throw new Exception("input_city doesn't exist");
	}

	//usata nel costruttore
	private function setCase($word) :string
	{

		if ($word != 'USA') {
			$word = ucwords(strtolower($word));
			return $word;
		} else {
			return $word;
		}
	}

	//DA IMPLEMENTARE
	private function connectToDatabase():void
	{
		//per connessione database root
		DB::$user = 'root';
		DB::$password = '';
		DB::$dbName = 'maps';
	}

	public function run():bool
	{
		$this->connectToDatabase();
		$main_country = $this->checkCountry();
		$main_city = $this->checkCity($main_country);
		$this->setCoordinates($main_country, $main_city);
		return true;
	}
}