<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\NullWeather;
use App\Weather\LoaderService;

/**
 * Class WeatherController
 * @package App\Controller
 */
class WeatherController extends AbstractController
{
    public function index($day, LoaderService $loaderService)
    {
        $validDay = $loaderService->validateDate($day);
        try {
            $weather = $loaderService->loadWeatherByDay(new \DateTime($validDay));
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }
        return $this->render('weather/index.html.twig', ['weather' => $weather,
            'date' => $weather->getDate()->format('Y-m-d')]);
    }
}
