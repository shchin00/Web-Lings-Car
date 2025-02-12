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

$EMail=$_POST['email'];
$password=$_POST['password'];


 if($EMail == ''){
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
    
    $sql = "SELECT * FROM userInfo WHERE email='$EMail' AND pwd='$password'";
    

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if ($row['email'] === $EMail && $row['pwd'] === $password) {

            echo "Logged in!";

            $_SESSION['email'] = $row['pwd'];

            $_SESSION['fname'] = $row['fname'];

            $_SESSION['userId'] = $row['userId'];

            header("Location: Home.html?=loggedIn");

            exit();
        }

    }

  }

}
else{
    header("location: Home.html");
    exit();
}

}

?>