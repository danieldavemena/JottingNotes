 <?php 

$connect = mysqli_connect('sql300.infinityfree.com', 'if0_35501418', '4U6gLEuspxkFm', 'if0_35501418_db');

$username = $email = $password = null;

$message = null;
$messageColor = null;

$credValid = false;

$usernameValid = $emailValid = $passwordValid = false;  

$pageCounter = 0;


if (isset($_POST['signupSubmit'])) {

    // FOR SIGNUP

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $usernameOK = preg_match("/^[a-zA-Z0-9_]{5,30}+$/", $username);
    $emailOK = preg_match("/^[a-zA-Z0-9+]+@[a-zA-Z0-9]+[.]{1}[a-zA-Z0-9]+$/", $email);
    $passwordOK = preg_match("/^[a-zA-Z0-9_@$!]{6,}+$/", $password);

    $usernameQuery = "SELECT * FROM users WHERE username='$username'";
    $userExist = mysqli_query($connect, $usernameQuery);

    // USERNAME VALIDATION
    if (empty($username) || strlen($username) < 5 || strlen($username) > 30) {
        $message = "Username must be (5) five to (30) thirty characters.";
        $messageColor = "red";
    } else if ($usernameOK === 0) {
        $message = "Username must be alphanumeric and cannot contain any symbol except (_) underscore. ";
        $messageColor = "red";
    } else if(mysqli_num_rows($userExist) === 1) {
        $message = "An account for usename already created. Log in or try another username";
        $messageColor = "red";
    } else {
        $usernameValid = true;
    }

    // EMAIL VALIDATION
    if (empty($email) ) {
        $message = "An email address is required.";
        $messageColor = "red";
    } else if ($emailOK === 0) {
        $message = "Email address must be valid.";
        $messageColor = "red";
    } else {
        $emailValid = true;
    }

    // PASSWORD VALIDATION
    if (empty($password) || strlen($password) < 6) {
        $message = "Password must be 6 or more characters.";
        $messageColor = "red";
    } else if ($passwordOK === 0) {
        $message = "Password must be alphanumeric and cannot contain any symbol except _ , @ , $ , and ! ";
        $messageColor = "red";
    } else {
        $passwordValid = true;
    }

    // CREDENTIAL VALIDATION
    if ( $usernameValid && $emailValid && $passwordValid) {
        $message = "Congratulations ".$username."! You successfully created an account. Try logging in.";
        $messageColor = "green";
        $query = "INSERT `users`(`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";

        mysqli_query($connect, $query);
    }

} else if (isset($_POST['loginSubmit'])) {

    // FOR LOGIN

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $credsQuery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $credsOK = mysqli_query($connect, $credsQuery);

    if (mysqli_num_rows($credsOK) == 1) {
        $message = null;
        $messageColor = null;

       $pageCounter = 1;
    } else if (mysqli_num_rows($credsOK) == 0 ){
        $message = "Credentials does not match to any of our records.";
        $messageColor = "red";
    }
} else if (isset($_POST['contentSubmit'])) {

    // FOR CONTENT CREATION

	$username = htmlspecialchars($_POST['username']);
	$dataType = htmlspecialchars($_POST['dataType']);
	$title = htmlspecialchars($_POST['title']);
	$dataContent = htmlspecialchars($_POST['dataContent']);

	$display = "SELECT * FROM userdata WHERE username='$username'";
	$sqlQuery = mysqli_query($connect, $display);
	
	$i=0;

	$noteCount = 0;
	$todoCount = 0;

	if(mysqli_num_rows($sqlQuery) != 0) {

		while ($queryArray = mysqli_fetch_array($sqlQuery)) {
			$content[$i]['type'] = $queryArray['type'];
			$content[$i]['title'] = $queryArray['title'];
			$content[$i]['content'] = $queryArray['content'];

			if ($content[$i]['type'] == 1) {
				$noteCount++;
			} else if ($content[$i]['type'] == 0) {
				$todoCount++;
			} 

            if ($content[$i]['title'] === $title && $content[$i]['type'] === $dataType) {
                $title .= "(1)";
            }
			$i++;
		}
	}

    $contentInput = "INSERT userdata(`username`, `type`, `title`,`content`) VALUES('$username', '$dataType', '$title', '$dataContent')";
    



	if ($username && $dataType != null && $title && $dataContent) {
		mysqli_query($connect, $contentInput);
	} else if ($title == null && $dataContent != null) {
        $message = "Content not created, title cannot be empty.";
        $messageColor = "red";
    }  else if ($dataContent == null && $title != null) {
        $message = "Content not created, text cannot be empty.";
        $messageColor = "red";
    }   else if ($title == null && $dataContent == null) {
        $message = "No content created.";
        $messageColor = "red";
    }

	$pageCounter = 1;

} else if (isset($_POST['contentUpdate'])) {

    $username = htmlspecialchars($_POST['username']);
    $dataType = htmlspecialchars($_POST['dataType']);
    $selectedTitle = htmlspecialchars($_POST['selectedTitle']);
    $title = htmlspecialchars($_POST['title']);
    $dataContent = htmlspecialchars($_POST['dataContent']);

    $updateQuery = "UPDATE `userdata` SET `title`='$title', `content`='$dataContent' WHERE `title`='$selectedTitle' AND `username`='$username' AND `type`='$dataType'";

    $dupeChecker = "SELECT * FROM userdata WHERE title='$title'";

    $dupeChecking = mysqli_query($connect, $dupeChecker);

    if (($selectedTitle == $title && $title != null && $dataContent != null || mysqli_num_rows($dupeChecking) == 0) && $title != null && $dataContent != null ) {
        mysqli_query($connect, $updateQuery);

        $message = "Content updated successfully";
        $messageColor = "green";
    } else {
        $message = "Content invalid, try again";
        $messageColor = "red";
    }

    

    $pageCounter = 1;
} else if (isset($_POST['deleteItems'])) {

    $username = htmlspecialchars($_POST['username']);
    $dataType = htmlspecialchars($_POST['dataType']);
    $deleteQuery = $_POST['deleteQuery'];

    if ($deleteQuery != 0) {
        foreach ($deleteQuery as $value) {
        $deletionQuery = "DELETE FROM `userdata` WHERE `username`='$username' AND `type`='$dataType' AND `title`='$value'";

        mysqli_query($connect, $deletionQuery);
        }        
    }

    $pageCounter = 1;

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" type="text/css" href="/css/materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <style type="text/css">
        .message{
            position: fixed;
            top: 0;
            text-align: center;
            background-color: <?php echo $messageColor; ?>;
            z-index: 10;
            width: 100vw;
        }   

    </style>
	<title></title>
</head>
<body>

    <!-- WARNING AND CONGRATULATION MESSAGES -->
    <div class="message">
	   <div class="message hide">
            <p class="white-text"><?php echo $message; ?></p>
        </div>
    </div>

    <div>
        <?php 

            if ($pageCounter === 0) {
                include 'home.php';
            } else if ($pageCounter === 1) {
                include 'account.php';
            }

        ?>

    </div>

<script type="text/javascript" src="/css/materialize/js/materialize.js"></script>
<script type="text/javascript" src="/css/materialize/js/jquery.js"></script>

<script type="text/javascript">
	// message MESSAGE HANDLER
    var message = "<?php echo $message; ?>";
    var credValid = "<?php echo $credValid; ?>";

    if (!(message == null)) {
        $(".message").removeClass("hide");
    } else {
        $(".message").css({"background-color": "transparent"})
        $(".message").addClass("hide");
    }

    $(".message").delay(1500).fadeOut(1000);
</script>
</body>
</html>
