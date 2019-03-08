<?php

class IndexController extends Base_Controller_Abstractlive {

	public function indexAction() {
	    $result = [];

        $result['mysql'] = $this->_mysqlModel->mysqlQuery('show databases');
        $result['redis'] = $this->_redisLiveLink->get('redis_test');

        echo json_encode($result);
	}
}
