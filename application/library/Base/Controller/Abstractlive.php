<?php

/**
 * 所有 Controller 的基类
 */
class Base_Controller_Abstractlive extends Yaf_Controller_Abstract {

    protected $_mysqlModel;
    protected $_redisModel;
    protected $_redisLiveLink;

    public function init() {
        try {
            $this->_mysqlModel = MysqlConnection::getInstance('live');
        } catch (Exception $e) {
            $this->response(Base_Error::MYSQL_ERROR);
        }

        try {
            $this->_redisModel = RedisConnection::getInstance('live');
            $this->_redisLiveLink = $this->_redisModel->getLink();
        } catch (Exception $e) {
            $this->response(Base_Error::REDIS_ERROR);
        }
    }

    public function response($error, $data = []) {
        $responseData = [];
        $responseData['error'] = $error;
        $responseData['data']  = $data;

        $output = json_encode($responseData);
        exit($output);
    }
}