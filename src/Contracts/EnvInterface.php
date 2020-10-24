<?php

namespace App\Contracts;

interface EnvInterface
{
    /**
     * .envから情報を取り出す
     * 
     * @return array
     */
    public function getEnv();
}
