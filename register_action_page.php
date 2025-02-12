<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

else{

  if(isset($_POST["submit"])){

      $fname=$_POST['fname'];
      $EMail=$_POST['email'];   
      $password=$_POST['password'];
  
  
      if($fname == ''){
       
        header("location: Home.html?error=emptyInput");
      }
  
      else if(!preg_match("/^[A-Z][a-z]{1,20}$/", $fname)){
  
        header("location: Home.html?error=InvalidInput");
      }
  
      else if($EMail == ''){
        header("location: Home.html?error=emptyInput");
      }
  
      else if(!filter_var($EMail, FILTER_VALIDATE_EMAIL)){
        header("location: Home.html?error=InvalidInput");
      }
    
      else if($password == ''){
        header("location: Home.html?error=emptyInput");
      }
  
     else if(!preg_match("/^(?!.* )(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6}$/", $password)){
      header("location: Home.html?error=InvalidInput");
      }
  
      else{
        
        $sql = "INSERT INTO userinfo (users_name, users_email, users_password, "") VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: LogIn.html?error=stmtfailed");
            exit();
        }
      
        mysqli_stmt_bind_param($stmt, "sss", $fname, $EMail, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: Home.html?error=none");
        exit();
      }  

    }
    else{
      header("location: form.html");
      exit();
    }
}
  ?>