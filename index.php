<?php

	/* For license information please read the LICENSE file */

	/* Copyright (c) 2015 Antonios A. Chariton <daknob@tolabaki.gr> */
	/* Additional modifications by dmcbeing */

	$PASSWORD = "No SHA-256 will match this phrase"; /* sha256($password); */
	$WEBSITE  = "https://daknob.net/";	/* Website for redirects */

	if($_SERVER['HTTPS'] != 'on'){
		header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit();
	}

	if(session_status()!=PHP_SESSION_ACTIVE)
		session_start();												/* Start a session */

	if(isset($_POST['action']) && $_POST['action'] == "action"){		/* Check if the form is submitted */
		$saveTo = "../STORAGE/" . $_FILES['filename']['name'];			/* Generate the path the file's supposed to be saved in */
		$phash = hash("sha256",$PASSWORD . strval(session_id()));		/* Calculate wanted hash(hash(pass)+session_id)*/
		if($_POST['pass'] == $phash){									/* Check if the password is correct */
			unset($_POST['pass']);										/* Attempt to remove password from memory */
			if(is_dir("../STORAGE") === FALSE){							/* If it's the first time this runs, do some filesystem initialization */
				mkdir("../STORAGE");
				chmod("../STORAGE", 0700);
				chmod("index.php", 0700);
				file_put_contents("../STORAGE/.htaccess", "Allow from none\nDeny from all\nSatisfy all\n");
				file_put_contents("../STORAGE/index.php", "<?php header('Location: $WEBSITE'); ?>\n");
				chmod("../STORAGE/.htaccess", 0755);
			}

			while(file_exists($saveTo)){								/* Dumb way to avoid filename collisions */
				$saveTo = $saveTo . ".n";
			}
			if(move_uploaded_file($_FILES['filename']['tmp_name'], $saveTo)){	/* Try to 'upload' the file */
				print("<h1 class='suc'>File upload completed.</h1>");	/* File uploaded successfully */
			}else{
				print("<h1>An error occured while uploading the file.</h1>");
			}
		}else{
 			print("<h1>An error occured while uploading file. Wrong password.</h1>");
		}
	}
	session_regenerate_id();											/* Change the session_id */
?>

<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="sha256.js"></script>
		<script>
			session="<?php print session_id(); ?>"

			function genSHA256(input)
			{
				var hashObj = new jsSHA(input, "TEXT");
				output=hashObj.getHash("SHA-256","HEX",1);
				return output;
			}

			function hashPass()
			{
				var pass = document.getElementById("pass").value;
				pass=genSHA256(pass);									/* Generate hash of password. */
				pass=genSHA256(pass+session);							/* Concatenate hash(pass) and nonce*/
				document.getElementById("pass").value = pass;			/* Send the nonced hash */
				return true;
			}
		</script>
		<title><?php print get_current_user(); ?>'s File Uploader</title>
		<style>
			.suc{
				color:#282;
				background-color:rgba(63, 190, 63, 0.3);
			}
			h1{
				font:20px Helvetica;
				color:#822;
				width:60%;
				border: 2px solid;
				text-align:center;
				margin-left:auto;
				margin-right:auto;
				padding-top:5px;
				padding-bottom:5px;
				background-color:rgba(190, 63, 63, 0.3);
			}
			body{
				background-color:#abc;
			}
			div.bodi{
				padding-top:100px;
				padding-bottom:100px;
			}
			img{
				margin-left:auto;
				margin-right:auto;
				display:block;
			}
			form{
				margin-left:auto;
				margin-right:auto;
				text-align:center;
				padding-top:20px;
			}
			span.filed{
				font:20px Helvetica;
				color:#666;
				padding-left:100px;
			}
			#filename{
				font:15px Helvetica;
				color:#666;
			}
			#pass{
				font:20px Helvetica;
				margin-top:10px;
				color:#666;
				border-radius:10px;
				padding-left:5px;
				padding-right:5px;
				border: 1px solid;
			}
			#submit{
				font:18px Helvetica;
				color:#666;
				border-radius:10px;
				border: 1px solid;
				padding: 5px;
			}
		</style>
	</head>
	<body>

		<div class="bodi">
			<img src="logo.png" height="200px"/>
			<form action="." method="post" enctype="multipart/form-data" onSubmit="return hashPass()">
				<span class="filed">File: </span>
				<input type="file" name="filename" id="filename"><br/>
				<input type="hidden" name="action" value="action">
				<input type="password" name="pass" id="pass">
  		    	<input type="submit" value="Upload" name="submit" id="submit">
			</form>
			<br>
			<center><span style="text-align:center; margin-left:auto;margin-right:auto;font: 12px Helvetica; color:#666;">Copyright &copy; 2015 - Antonios A. Chariton &lt;daknob@tolabaki.gr&gt;</span></center>
		</div>
	</body>
</html>
