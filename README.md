# yii2-fluentd

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bilberrry/yii2-fluentd/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bilberrry/yii2-fluentd/?branch=master) [![Packagist](https://img.shields.io/packagist/dt/bilberrry/yii2-fluentd.svg)]() [![Packagist](https://img.shields.io/packagist/v/bilberrry/yii2-fluentd.svg)]() [![GitHub license](https://img.shields.io/github/license/bilberrry/yii2-fluentd.svg)]()

Logging with Fluentd for Yii2

## Installation

You can install this extension with [composer](http://getcomposer.org/).

```sh
composer require bilberrry/yii2-fluentd
```

or add to `composer.json`

```json
"bilberrry/yii2-fluentd": "0.1"
```

## Usage

Add new log target to your configuration file.

##### Example configuration

```php
...
'components' => [
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'bilberrry\log\FluentdTarget',
                'levels' => ['error', 'warning'], // Log levels
                'host' => 'localhost', // Fluentd host
                'port' => '24224', // Fluentd port
                'options' => [], // Options for Fluentd client
                'tagFormat' => 'app.%level' // Tag format, available placeholders: %date, %timestamp, %level
            ],
        ],
    ],
...
```

For options list check this [source code](https://github.com/fluent/fluent-logger-php/blob/master/src/FluentLogger.php#L67).