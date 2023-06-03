<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<style>
    body {
        direction: rtl;
        text-align: right;
    }
    </style>
<body>
<div class="container">
        <div class="d-flex justify-content-center">
            <div class="card mt-4 p-4 w-50">
                <H2 class="text-center p-4">فرم ثبت نام</H2>
                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">

                    <input class="form-control" type="text" name="name" value=""  placeholder="نام">
                    <?php if(!empty($viewmodel["name"])){
                        echo"<div class='alert alert-danger'>"."<li>".$viewmodel["name"]."</li>"."</div>";
                    } ?>
                    <br>
                    <br>
                    <input class="form-control" type="text" name="last_name"   placeholder="نام خانوادگی">
                    <?php if(!empty($viewmodel["last_name"])){
                        echo"<div class='alert alert-danger'>"."<li>".$viewmodel["last_name"]."</li>"."</div>";
                    } ?>
                    <br>
                    <br>
                    <input class="form-control" type="email" name="email"  placeholder="ایمیل">
                    <?php if(!empty($viewmodel["email"])){
                        echo"<div class='alert alert-danger'>"."<li>".$viewmodel["email"]."</li>"."</div>";
                    } ?>
                    <br>
                    <br>
                    <input class="form-control" type="password" name="password" placeholder="پسورد">
                    <?php if(!empty($viewmodel["password"])){
                        echo"<div class='alert alert-danger'>"."<li>".$viewmodel["password"]."</li>"."</div>";
                    } ?>
                    <br>
                    <br>
                    <input class="form-control" type="password" name="re_password" placeholder="تکرار پسورد">
                    <?php if(!empty($viewmodel["re_password"])){
                        echo"<div class='alert alert-danger'>"."<li>".$viewmodel["re_password"]."</li>"."</div>";
                    } ?>
                    <br>
                    <br>
                    <input class="form-control" type="file" name="img" >
                    <?php if(!empty($viewmodel["img"])){
                        echo"<div class='alert alert-danger'>"."<li>".$viewmodel["img"]."</li>"."</div>";
                    } ?>
                    <br>
                    <br>
                    <input class="btn btn-success form-control " type="submit" name="submit" value="ثبت نام">
                </form>
              
                
</body>
</html>