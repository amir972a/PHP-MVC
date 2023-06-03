<?php
 class Welcome extends Controller{

    protected function index(){
        $view_model=new WelcomeModel;
        $result=$view_model->welcome();
        $this->returnView($result);
    }
 }

?>