<?php

class ApiController extends Base_Controller_Abstractlive {

    protected static $teamMap = [
        '0' => '魔术', '1' => '火箭', '2' => '灰熊', '3' => '小牛'
    ];


    public function pushAction() {
        $params = WebSockerServer::$post;

        $this->response(Base_Error::SUCCESS, $params);
    }
}