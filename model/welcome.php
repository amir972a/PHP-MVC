<?php

class WelcomeModel extends Model {
    public function welcome(){
        if(isset($_SESSION["is_register"])){
            $name=$_SESSION["name"];
            return $name;
        }
        else{
            header("location: /register");
        }
    }
}


?>