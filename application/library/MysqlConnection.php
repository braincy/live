<?php

/**
 * 协程 MySQL 单例类
 */
class MysqlConnection {

    const TIMEOUT = 5;

    private static $_instance;
    private $_db_config;


    private function __construct($database = '') {
        $config = new Yaf_Config_Ini(
            APPLICATION_PATH.'/conf/mysql.ini', ini_get('yaf.environ')
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


    public function mysqlQuery($sql) {

        $db = new Swoole\Coroutine\MySQL();

        $queryType = strtok($sql, ' ');
        if ($queryType == 'select') {
            $dbConfig = $this->_db_config->slave->toArray();
        } else {
            $dbConfig = $this->_db_config->master->toArray();
        }
        $db->connect($dbConfig);

        $result = $db->query($sql, self::TIMEOUT);

        return $result;
    }
}