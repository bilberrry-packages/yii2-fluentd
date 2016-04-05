<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2016 Alex Mukho <alex@bilberrry.com>
 * @license   https://github.com/bilberrry/yii2-fluentd/blob/master/LICENSE
 */

namespace bilberrry\log;

use Fluent\Logger\FluentLogger;
use yii\log\Logger;


/**
 * FluentdTarget sends log messages to Fluentd
 */
class FluentdTarget extends \yii\log\Target
{

    public $host = 'localhost';
    public $port = 24224;
    public $options = [];

    public $tagFormat = 'app.%level';

    private $_logger;


    public function init()
    {
        parent::init();

        $this->_logger = FluentLogger::open($this->host, $this->port, $this->options);
    }

    /**
     * @inheritdoc
     */
    public function export()
    {
        $messages = array_map([$this, 'formatMessage'], $this->messages);

        $this->_logger->post($this->createTag($this->messages), $messages);
    }

    private function createTag($messages)
    {
        return str_replace(['%date', '%timestamp', '%level'], [
            date('Y-m-d H:i:s'), time(), Logger::getLevelName($messages[0][1])
        ], $this->tagFormat);
    }
}