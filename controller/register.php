<?php
 class Register extends Controller{

    protected function index(){
        $view_model=new RegisterModel;
        $result=$view_model->register();
        $this->returnView($result);
    }
 }

?>