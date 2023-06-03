<?php
 
 class RegisterModel extends Model {
    private $errors=[];
    private $img_name;
    public function register(){
      if(isset($_SESSION['is_register'])){
         header("location:welcome");
      }
      if(isset($_POST['submit'])){
         $name=trim($_POST['name']);
         $name=htmlspecialchars($name);
         $name=addslashes($name);
         $last_name=trim($_POST['last_name']);
         $last_name=htmlspecialchars($last_name);
         $last_name=addslashes($last_name);
         $email=trim($_POST['email']);
         $email=htmlspecialchars($email);
         $email=addslashes($email);
         $password=trim($_POST['password']);
         $password=htmlspecialchars($password);
         $password=addslashes($password);
         $re_password=trim($_POST['re_password']);
         $re_password=htmlspecialchars($re_password);
         $re_password=addslashes($re_password);
         $img=$_FILES['img'];
         $result=$this->isValid($name,$last_name,$email,$password,$re_password,$img);
         if($result){
            #insert to database with PDO
            $_SESSION["is_register"]=true;
            $_SESSION["name"]=$name;
            $password=md5($password);
            $this->query("INSERT INTO users(id,name,last_name, email, password,image) VALUES (id,:name,:last_name, :email, :password,:image_name)");
            $this->bind(':name',$name);
            $this->bind(':last_name',$last_name);
            $this->bind(':email',$email);
            $this->bind(':password',$password);
            $this->bind(':image_name',$this->img_name);
            $this->execute();
            header("location: welcome ");
            
         }else{
            return $this->$errors;
         }
      }else{
         return;
      }
    }
    private function isValid($name,$last_name,$email,$password,$re_password,$img){
      #Name validation
      
      if(empty($name) or ctype_space($name)){
        $this->$errors["name"]="نام نمیتواند خالی باشد";
      }
      else if(mb_strlen($name)<=2){
         $this->$errors["name"]="نام باید بیشتر از دو حرف باشد";
      }
      else if(preg_match("/[a-z!@#$%^&*123456789]/",$name)){
         $this->$errors["name"]="نام نمیتواند شامل کاراکتر های خاص و حروف انگلیسی باشد";
      }
      #Lastname validation
      if(empty($last_name)==false){
            if(mb_strlen($last_name)<=2){
               $this->$errors["last_name"]="نام خانوادگی باید بیشتر از دو حرف باشد";

            }
            else if(preg_match("/[a-z!@#$%^&*123456789]/",$last_name)){
               $this->$errors["last_name"]="نام خانوادگی نباید شمال کاراکتر های خاص و حروف انگلیسی باشد";
            }
      }
      #Email validation
      if( empty($email)){
            $this->$errors["email"]="ایمیل نمیتواند خالی باشد";
         }
      else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
         $this->$errors["email"]="فرمت ایمیل صحیح نیست";
      }
      else{
         $this->query("SELECT * FROM users WHERE email = :email");
         $this->bind(':email',$email);
         $row=$this->result();
         if($row){
             if($row[0]["email"]==$email){
               $this->$errors["email"]="این ایمیل ثبت شده از یک ایمیل دیگر استفاده کنید";
                 }
         }
      }
      #checking if the email exists in the database or not

      #Password validation
      if(empty($password)){
         $this->$errors["password"]="پسورد نمیتواند خالی باشد";   
      }
      else if(strlen($password)<6){
         $this->$errors["password"]="پسورد حداقل باید 6 کاراکتر باشد";
      }
      else if($password !== $re_password){
         $this->$errors["re_password"]="پسورد با تکرار ان مطابقت ندارد";    
      }
      #image validation
      if($img['error']===0){
         $img_name=$img['name'];
         $img_tmp_name=$img['tmp_name'];
         $img_size=$img['size'];
         #checking image size
         if($img_size>=2000000){
            $this->$errors["img"]="سایز تصویر نمیتواند بیشتر از 2 مگ باشد";
         }else{
             #get image extension.for example jpg or png.
             $img_extension=pathinfo($img_name,PATHINFO_EXTENSION);
             #extension allowed to upload
             $extension_allowed=['png','jpeg','jpg','Jpg','PNG','Jpeg'];
             if(in_array($img_extension,$extension_allowed)){
               $img_name_new=uniqid("img-",true).'.'.$img_extension;
               $img_upload_path="uploads/".$img_name_new;           
             }else{
               $this->$errors["img"]="تصویر تنها باید یکی از فرمت های png,jpeg,jpg باشد.";
             }
         }
     }else{
      $this->$errors["img"]="تصویری اپلود نشده لطفا تصویر را اپلود کنید";
     }
     if(!empty($this->$errors)){
      return false;
     }else{
      move_uploaded_file($img_tmp_name,$img_upload_path);
      $this->img_name=$img_name_new;
      return true;
     }
      }
   
      

   }



?>