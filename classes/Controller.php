<?php
#base controller
abstract class Controller{

    private $action;

  

    public function __construct($action)
    {
        $this->action=$action;
        
    }
    public function executeAction(){
        $this->{$this->action}();
    }
    protected function returnView($viewmodel){
        $view='views/'.get_class($this)."/".$this->action.'.php';
        require ($view);
        }
}   

?>