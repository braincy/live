<?php

class IndexController extends Base_Controller_Abstractlive {

	public function indexAction() {
        $data = [];
        $data['mysql'] = $this->_mysqlModel->mysqlQuery('show databases');
        $data['redis'] = $this->_redisLiveLink->get('redis_test');
        $this->response(Base_Error::SUCCESS, $data);
	}
}
