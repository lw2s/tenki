# OpenWeatherMapのAPIを使って現在の天気を取得

## 条件

PHP7

## 使い方

```
$ git clone https://github.com/lw2s/tenki.git

$ cd tenki

$ composer install

$ mv .env.example .env
```

.envの設定を行う
OpenWeatherMapでAPIKEYを取得して
.envの**api_key**にコピペ

**city_name**はローマ字で入力(デフォルトは**Kobe**)


設定が終わったら以下を実行して表示

```
$ php index.php
```