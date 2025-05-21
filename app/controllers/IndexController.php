<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // return '<h1>Hello!</h1>';
        // die("TEST");
        $this->view->name = 'Rali Dimitrov';
        return $this->view->pick('index/index'); // optional, for custom view paths
    }
}