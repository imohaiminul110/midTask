<?php
  
$firstName = $email = $firstNameErrorMsg = $emailErrorMsg = $phoneNo = $phoneNoErrorMsg = $password = $passwordErrorMsg = $gender = $genderErrorMsg = "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {

      function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    $firstName = test_input($_POST['firstName']);
    $email = test_input($_POST['email']);
    $phoneNo = test_input($_POST['phoneNo']);
    $password = test_input($_POST['password']);
    $gender = isset($_POST['gender']);

    $message = "";
    if (empty($firstName)) {

      $firstNameErrorMsg = "First Name is Empty";
    }
    else {
      if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
      

        $firstNameErrorMsg = "Only letters and spaces";
      }
    }

    if (empty($email)) {
      $emailErrorMsg = "Email is Empty";
      
    }
    else {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErrorMsg = "Please correct your email";
        
      }
    }
    if (empty($phoneNo)) {
      $phoneNoErrorMsg = "Phone no is Empty";
      
    }
    else {
      if (!preg_replace('/[^0-9]/', '', $phoneNo )) {     
        $phoneNoErrorMsg = "Only number";
      }    
    }
    if (empty($password)) {
      $passwordErrorMsg = "Password is Empty";
      
    }
    else {
      if (!preg_replace('/\W/', '', $password )) {     
        $passwordErrorMsg = "Only number";
      }    
    }
    if (empty($gender)) {
      $genderErrorMsg = "Gender not Selected";    
    }
}
if($firstName!="" and $email!="" and $phoneNo!="" and $password!=""and $gender!="" ){
    $current=file_get_contents('userSignUp.json');
    $array[]=json_decode($current,true);
    $obj=array(
        'firstName'=> $_POST["firstName"],
        'email'=> $_POST["email"],
        'phoneNo'=> $_POST["phoneNo"],
        'password'=> $_POST["password"],
        'gender'=> $_POST["gender"]
        );
    $array[]=$obj;
    $final=json_encode($array);
    if(file_put_contents('userSignUp.json', $final))
    {
        header("location:dashboard.php");
    }
    else
    {
         echo "Wrong info";
    }

 }

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
</head>
<body>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
		<label for="name">Name:</label>
		<input type="test" name="firstName" id="firstName" value="<?php echo $firstName?>" placeholder ="<?php echo $firstNameErrorMsg?>" >
		<span></span>
		<br><br>
		<label for="email">Email:</label>
		<input type="email" name="email" id="email" placeholder="<?php echo $emailErrorMsg?>">
		<br><br>

		<label for="phoneNo">Phone No:</label>
		<input type="text" name="phoneNo" id="phoneNo" placeholder="<?php echo $phoneNoErrorMsg?>">
		<br><br>
		<label>Password</label>
		<input type="Password" name="password" id="password" placeholder="<?php echo $passwordErrorMsg?>">
		<br><br>
		<label>Gender</label>
		<input type="radio" name="gender" value="male">Male
		<input type="radio" name="gender" value="female">Female
		<br>
		<?php echo $genderErrorMsg?>
		<br><br>
		<input type="submit" name="submit" value="sign Up">
		<a href="login.php">Log In</a>
	</form>

</body>
</html>