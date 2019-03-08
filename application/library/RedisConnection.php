<?php

/**
 * 协程 Redis 单例类
 */
class RedisConnection {

    private static $_instance;
    private $_db_config;


    private function __construct($database = '') {
        $config = new Yaf_Config_Ini(
            APPLICATION_PATH.'/conf/redis.ini', ini_get('yaf.environ')
        );

        $this->_db_config = $config->$database;
    }


    private function __clone() {}


    public static function getInstance($database = '') {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self($database);
        }

        return self::$_instance;
    }

    public function getLink() {
        $db = new Swoole\Coroutine\Redis();
        $db->connect($this->_db_config->address, $this->_db_config->port);

        if (isset($this->_db_config->password)) {
            $db->auth($this->_db_config->password);
        }

        if (isset($this->_db_config->database)) {
            $db->select($this->_db_config->database);
        }

        return $db;
    }
}