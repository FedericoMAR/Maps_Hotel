<?php
class hotelHandler
{
    private $city;
    private $country;

    function __construct($city,$country)
    {
        $this->city = $city;
        $this->country=$country;
    }
    function getCountry(): string
    {
        return $this->country;
    }
    function setCountry($country): void
    {
        $this->country = $country;
    }

    function getCity(): string
    {
        return $this->city;
    }
    function setCity($city): void
    {
        $this->city = $city;
    }

    function openBookingWebsite(){

    }
    function showHotels(){

    }
}
