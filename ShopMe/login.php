<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$uname = $_POST['uname'];
		$upwsd1 = $_POST['upwsd1'];

		if(!empty($uname) && !empty($upwsd1) && !is_numeric($uname))
		{

			//read from database
			$query = "select * from signup where uname = '$uname' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['upwsd1'] === $upwsd1)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>





<!DOCTYPE html>
<head>
<title>Login Form Design</title>
<link rel="stylesheet" type="text/css" href="css/styles1.css">
    </head>
    

<body style="background-image: linear-gradient(to bottom left, #333333, #dd1818);">


    <div class="box">

    <img src="logo1.jfif" class="user">

        <h1>Login Here</h1>

        <form name="myform"  method="POST" >

            <p>USERNAME :</p><br>
            <input type="text" name="uname" placeholder="Enter Username " required=""><br><br>

            <p>PASSWORD :</p><br>
            <input type="password" name="upwsd1" placeholder="Enter Password" required=""><br>


            <input type="submit" name="" value="Login">

            <br><br>
            Don't have an account?<a href="Register.html">Sign up and get started!</a><i class="fa-solid fa-arrow-right-to-bracket"></i>

        </form>
        
    </div>

</body>
</html>