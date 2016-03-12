<?php
class HomeController extends Core
{
    public function index()
    {
    	$model = $this->getModel('Home');
    	$name = $model->getName();
    	$data = ['name' => $name];
        return $this->render('home', $data);
    }
}