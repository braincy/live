<?php

class HomeController extends Base_Controller_Abstractlive {

    public function indexAction() {
        $this->getView()->display(APPLICATION_VIEW_PATH . 'Admin/Home/index.html');
    }
}
