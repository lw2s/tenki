<?php

namespace App\Contracts;

interface WeatherInterface
{
    /**
     * APIを叩く際に必要なパラメータをセット
     * 
     * @param array $params
     */
    public function setParams($params);

    /**
     * OpenWeatherMapのAPIをたたく
     * 
     * @return array
     */
    public function weatherApi();
}
