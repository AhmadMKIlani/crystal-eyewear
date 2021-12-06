<?php require_once "db.php"; ?>
<?php require_once "functions.php" ?>
<?php

//here the red line is not actually a red line it's just from the require
if (isset($_POST["register_submit"])) {
    $dataArr = getPostData($_POST, ['username', 'email', 'password', 'password_confirmation',"full_name"]);
    $username = $dataArr[0];
    $email = $dataArr[1];
    $password = $dataArr[2];
    $password_confirmation = $dataArr[3];
    $full_name = $dataArr[4];
    //full name check
    if($full_name===""){
        header("Location:../account-register.php?full_name=the name should not be empty");
        exit;
    }

    validate_password($password);
    validate_email($email);
    confirm_password($password, $password_confirmation);
    $validate = validate_all_paramters(...$validation_array);
    if (!$validate) {
        $query = "";
        foreach ($errors as $error_type => $error) {
            $query .= "{$error_type}={$error} ";
        }
        //send all of the errors at the same time
        header("Location:../account-register.php?{$query}");
        exit;
    }
    //encrypt the password
    $password = md5($password);
    checkRepetition_and_showUsers($connection, true, "user", ['email','username'], [$email,$username], "../account-register.php");
    crud($connection, "INSERT", "user", ['username', 'email', 'password','full_name'], [$username, $email, $password,$full_name]);
    header("Location:../account-login.php?register=success");
    exit();
}
//login logic
if (isset($_POST['login_submit']) || (isset($_POST['checkout_login']))) {
    $url = "";
    if (isset($_POST['checkout_login'])) {
        $url = "shop-checkout.php";
    }
    if (isset($_POST['login_submit'])) {
        $url = "account-login.php";
    }

    $returned_array = getPostData($_POST, ["username", 'password']);
    $password = $returned_array[1];
//check if the user inputs username or email
    if (validate_email($returned_array[0])) {
        $email = $returned_array[0];
        $validate = validate_password($password);
        if (!$validate) {
            //send all of the errors at the same time
            header("Location:../{$url}?password=password not valid");
            exit;
        }
        $statement = $connection->prepare("SELECT * FROM user WHERE email=:email");
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        //return error that the email doesn't exist
        if (!$user_data) {
            header("Location:../{$url}?email=email doesn't exist");
            exit();
        }
        $password = md5($password);
        //return error if the password don't match
        if ($user_data['password'] !== $password) {
            header("Location:../{$url}?password=password is wrong");
            exit();
        }
        //login succeeded;
        session_start();
        //Admin login
        if($user_data['role']==="1"){
            $_SESSION['admin_loggedin']=true;
            $_SESSION['admin-name']=$user_data['username'];
            $_SESSION['user_loggedin']=false;

            header("Location:../admin");
            exit();
        }
        //-----------------------------------
        $_SESSION['admin_loggedin']=false;
        $_SESSION['user_loggedin'] = true;
        $_SESSION['user_name']=$user_data['username'];
        $_SESSION['user_id']=$user_data['id'];
        if (isset($_POST['login_submit'])) {
            $url = "index.php";
        }
        header("Location:../{$url}");
        exit();
    } elseif (validate_username($returned_array[0])) {
        $username = $returned_array[0];
        $validate = validate_password($password);
        if (!$validate) {
            //send all of the errors at the same time
            header("Location:../{$url}?password=password not valid");
            exit;
        }
        $statement = $connection->prepare("SELECT * FROM user WHERE username=:username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $user_data = $statement->fetch(PDO::FETCH_ASSOC);


        //return error that the email doesn't exist
        if (!$user_data) {
            header("Location:../{$url}?username=username doesn't exist");
            exit();
        }
        $password = md5($password);
        echo $user_data["password"];
        //return error if the password don't match
        if ($user_data['password'] !== $password) {
            header("Location:../account-login.php?password=password is wrong");
            exit();
        }
        //--------------------------------------------------------
        //LOGIN SUCCEEDED
        session_start();
        if($user_data['role']==="1"){
            $_SESSION['admin_loggedin']=true;
           $_SESSION['user_loggedin']=false;
            $_SESSION['admin-name']=$user_data['username'];
            header("Location:../admin");
            exit();
        }
        $_SESSION['admin_loggedin']=false;
        $_SESSION['user_loggedin'] = true;
        $_SESSION['user_name']=$user_data['username'];
        $_SESSION['user_id']=$user_data['id'];
        if (isset($_POST['login_submit'])) {
            $url = "index.php";
        }
        header("Location:../{$url}");
        exit();
        //------------------------------------------------------------------

    } else {
        header("Location:../{$url}?username=please enter valid username or email");
    }
}
//---------------------------------
if(isset($_POST['country'])){
    session_start();
    $user_id=$_POST['user_id'];
    $country=$_POST['country'];
    $city=$_POST['city'];
    $phone=$_POST['phone'];
    $address_line=$_POST['address_line'];
    $counter=0;
    $comma=",";
//insert to user_checkout
    $cart_after_shopping=json_encode($_SESSION["shopping_cart"]);
    crud($connection, "INSERT", "order_summary",
        ["checkout_street_address","checkout_city","checkout_country"
            ,"checkout_phone", "order_total_price","user_id","order_status","cart_after_shopping"],
        [$address_line,$city,$country,$phone,$_SESSION['order_total'],$user_id,"pending",$cart_after_shopping]
         );
    unset($_SESSION["shopping_cart"]);
    header("Location:../completed.php");
    exit();

}
//logout logic
if(isset($_GET['logout'])){
    session_start();
    if($_GET['logout']==true){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_loggedin']);
        unset( $_SESSION['admin_loggedin']);
        unset( $_SESSION['admin-name']);
            header("Location:../index.php");
        exit();
    }
}
//----------------------------------------------------------kilani
if(isset($_POST["account_kilani_submit"])){

 
    session_start();
    $id = (int)$_SESSION['user_id'];
    $stmt = $connection->prepare("SELECT * FROM user WHERE id={$id}");
    $stmt->execute();
    $edit_user = $stmt->fetch(PDO::FETCH_ASSOC);
    $check = true;
    
    $emailError    ="";
    $nameError     ="";
    $passError     ="";
    $newPassError  ="";
    $confError     ="";

       if(empty($_POST["name"])){
          $check = false;
          $nameError = "<span style='color:red'> Name cannot be empty </span>";
       }
       if(empty($_POST["email"])){
          $check = false;
          $emailError = "<span style='color:red'> Email cannot be empty </span>";
       }
    if($check == true){
        $userName  = $_POST["name"];
        $userEmail = $_POST["email"];
        $password = $_POST["password"];//current pass you need to compare it with pass in DB
        $new_password=$_POST['newPass'];
        $conf_password=$_POST['confPass'];
    //define conf pass......done
    //check if the password matches the user password stored in DB......done
    $string="";
    $dont_change_password=true;
    if(!empty($_POST['password'])){
        $new_encrypted_pass=md5($new_password);
        $string=",password='{$new_encrypted_pass}'";
        $dont_change_password=false;
        
    }
    if(md5($password) != $edit_user["password"] && !$dont_change_password){
        header('location:../account.php?error=password is inccorect');
    }
    if($new_password==="" &&  !$dont_change_password ){
        header("location:../account.php?error=password is empty");
    }
    if($new_password != $conf_password && !$dont_change_password){
        header('location:../account.php?error=passwords dont match');
    }

    $update = $connection->prepare("UPDATE user SET username ='{$userName}',email ='{$userEmail}'{$string} WHERE id=$id");
    $update->execute();
    $_SESSION['user_name']=$userName;
    header("location:../account.php");
    //false=>header error to the user password dont''macyt........done
    //header('../account.php?error=password dont match').......done
    //true check for pass new and pass confirm if they match.....done
    //false header()......done
    //true store the new pass in the dataabse =>already done

    //error duplicate email
         ///DONT GO OUT OF THE IF STATEMENT
    }
}
//logout admin
if(isset($_POST['log_out_adminDash'])){
    session_start();
    $_SESSION['admin_loggedin']=false;
    unset($_SESSION['admin_loggedin']);
    unset($_SESSION['user_loggedin']);
    unset($_SESSION['admin-name']);
    header('location:../index.php');
    exit();
}
