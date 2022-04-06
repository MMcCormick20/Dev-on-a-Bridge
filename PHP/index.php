<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Reviews</title>
    <link rel="stylesheet" href="main.css">
  </head>
<body>

<?php
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    //This line checks if the name field only contains letters and whitespaces
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // This line is to check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid Email Format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // This line is to check if web Address is well-formed
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL Format";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Selection required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="card">
        <div class="container">
    <h1>Submit Your Website For Review</h1>
    </div>
    </div>
    <div class="card">
        <div class="container">
    <p><span class="error">* required field</span></p>
    <form class="form"method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      Name: <input class="inputName" type="text" placeholder="Your name.." name="name" value="<?php echo $name;?>">
      <span class="star" style="color:#F7EAEB">*<?php echo $nameErr;?></span>
      <br><br>
      E-mail: <input class="inputEmail" type="text" placeholder="Your email.." name="email" value="<?php echo $email;?>">
      <span class="star" style="color:#F7EAEB">* <?php echo $emailErr;?></span>
      <br><br>
      Website: <input class="inputWebsite" type="text" placeholder="Your web address.." name="website" value="<?php echo $comment;?>">
      <span class="error"><?php echo $websiteErr;?></span>
      <br><br>
      Comment: <textarea class="inputArea" placeholder="Your comment.." name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
      <br><br>
      Gender:
      <input class="rad" type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
      <input class="rad" type="radio" id= "gender" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
      <input class="rad" type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
      <span class="star" style="color:#F7EAEB">*<?php echo $genderErr;?></span>  
      <br><br>
      <button class="button"><span>Submit</span></button>  
    </form>
    </div>
    </div>
    <div class="card">
        <div class="container">
    <?php
    
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
</div>
    </div>
</body>
</html>