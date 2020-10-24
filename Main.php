<?php

use App\ENV\Env;
use App\API\Weather;
use App\Contracts\WeatherInterface;
use App\Contracts\EnvInterface;

class Main
{
    /** 現在の天気の情報 */
    private $current_info;
    /** .envのパラメータ */
    private $params;

    /** ケルビン→摂氏変換用定数 */
    const KELVIN = 273.15;

    /**
     * Mainインスタンス生成時の初期化
     */
    public function __construct()
    {
        $this->getParams(new Env);
        $this->getCurrentInfo(new Weather);
    }

    /**
     * .envファイルから情報の取り出す
     * 
     * @param App\Contracts\EnvInterface $env
     */
    public function getParams(EnvInterface $env)
    {
        $this->params = $env->getEnv();
    }

    /**
     * 現在の天気情報を取り出す
     * 
     * @param App\Contracts\WeatherInterface $weather
     */
    public function getCurrentInfo(WeatherInterface $weather)
    {
        $weather->setParams($this->params);
        $this->current_info = $weather->weatherApi();
    }

    /**
     * 天気、気温、温度の表示
     */
    public function display()
    {
        //天気
        $weather = $this->current_info->weather[0]->main;
        //気温 ケルビン（K）から　摂氏(℃)に変換
        $temperature = $this->current_info->main->temp - self::KELVIN;
        //湿度
        $humidity = $this->current_info->main->humidity;

        echo "現在の天気: " . $weather . "\n";
        echo "気温: " . $temperature . "\n";
        echo "湿度: " . $humidity . "%\n";
    }
}
