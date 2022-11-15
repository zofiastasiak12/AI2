<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;
use App\Service\WeatherUtil;
class WeatherController extends AbstractController
{
 public function cityAction($country,$city, WeatherUtil $weatherUtil): Response
 {
	$weather = $weatherUtil->getWeatherForCountryAndCity($country, $city);
	return $this->render('weather/city.html.twig', [
	'city' => $city,
	'country' => $country,
	'measurements' => $weather[0],
	]);
	}
	}

/* $measurements = $measurementRepository->findByLocation($city);
 return $this->render('weather/city.html.twig', [
 'location' => $city,
 'measurements' => $measurements,
 ]);
 }*/
