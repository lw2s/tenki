<?php

namespace App\ENV;

use App\Contracts\EnvInterface;

class Env implements EnvInterface
{
    /** .envの情報 */
    private $params;

    /**
     * Envインスタンス生成時の初期化
     */
    public function __construct()
    {
        //ルートの.envファイルを読み込み
        $this->params = file(__DIR__ . '/../../.env');
    }

    /**
     * .envから1行ずつ情報を取り出す
     * 
     * @param void
     * @return array $env 1行ずつデータを配列に格納したもの
     */
    public function getEnv()
    {
        $env = [];
        foreach ($this->params as $param) {
            // はじめの=の前後で分割
            $twoDividedStrs = explode("=", $param, 2);

            $key = $twoDividedStrs[0];
            $value = $twoDividedStrs[1];
            //改行文字があれば取り除く
            if (strpos($value, "\n")) {
                $value = rtrim($value, "\n");
            }

            $env[$key] = $value;
        }

        return $env;
    }
}
