<?php

namespace App\Service;

//use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;

class WeatherUtil
{
    private LocationRepository $locationRepository;
    private MeasurementRepository $measurementRepository;

    public function __construct(LocationRepository $locationRepository, MeasurementRepository $measurementRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->measurementRepository = $measurementRepository;
    }

    public function getWeatherForCountryAndCity($countryCode, $cityName, &$locationEntity = null)
    {
        $cityrep = $this->locationRepository->findbycityandcountry($countryCode, $cityName);
        $locationEntity = $cityrep[0];
        return $this->getWeatherForLocation($cityrep[0]);
    }

    public function getWeatherForLocation($location){
        return $this->measurementRepository->findByLocation($location);
    }
    /*public function getWeatherForLocation($location)
    {
        if (gettype($location) == 'array') {
            return $this->measurementRepository->findByLocation($location[0]);
        }
        if (gettype($location) == 'string') {
            return $this->measurementRepository->findByLocationInt($location);
        }
        else
            return $this->measurementRepository->findByLocation($location);
    }*/
}