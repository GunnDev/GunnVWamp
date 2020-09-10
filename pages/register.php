<!DOCTYPE html>

<html>
    <?php
        session_start();
        if(isSet($_SESSION['student_id'])){
            header("Location: dashboard.php");
        }
    ?>
    <!-- Links, Cool stuff, and Page Specs -->
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">

    <head>
        <title>Gunn Volunteering | Register</title>
    </head>

    <body OnLoad="document.registerForm.fname.focus();">
        <header id="topNav" class="siteNavHeader">
            <a href="../index.php" class="logo">
                <h1 class="navMainTitle">Gunn VBook</h1>
            </a>
            <nav class="navbarItems">
                <ul class="navbarLinks">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Developers</a></li>
                    <li class="navbarDivider">|</li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </header>

        <section class="registerBoxContainer">
            <article></article>

            <article>
                <div class="registerSection">
                    <h1 class="registerTitle">
                        Register.
                    </h1>

                    <div class="resultMessage">
                        <?php
                            include '../messages/errorMessage.php';
                            include '../messages/successMessage.php';

                            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            // First name error: only has letters and is [1,19] for length
                            if (strpos($fullUrl, "register=invalidfirst") == true){
                                $errM = new errorMessage('Please Enter First Name Only');
                                $errM->printMessage();
                            }

                            // Last name error: only has letters and is [1,19] for length
                            if (strpos($fullUrl, "register=invalidlast") == true){
                                $errM = new errorMessage('Please Enter Last Name Only');
                                $errM->printMessage();
                            }

                            // Grad Year Error: 
                            if (strpos($fullUrl, "register=invalidgrad") == true){
                                $errM = new errorMessage('Please Check Your Graduation Year');
                                $errM->printMessage();
                            }

                            // StudentEmail error: 16 chars long and ends with @pausd.us
                            if (strpos($fullUrl, "register=invalidemail") == true){
                                $errM = new errorMessage('Please Enter A Valid PAUSD email');
                                $errM->printMessage();
                            }

                            // Password Error: Length
                            if (strpos($fullUrl, "register=invalidpass") == true){
                                $errM = new errorMessage('Make sure the password is at least 8 chars long');
                                $errM->printMessage();
                            }

                            // Password Error: Match failure
                            if (strpos($fullUrl, "register=matchfailure") == true){
                                $errM = new errorMessage('Passwords Do Not Match');
                                $errM->printMessage();
                            }

                            // StudentEmail error: email registered already
                            if (strpos($fullUrl, "register=emailexists") == true){
                                $errM = new errorMessage('This email exists. Contact us for help');
                                $errM->printMessage();
                            }

                            // Registration Success!
                            if (strpos($fullUrl, "register=success") == true){
                                $successM = new successMessage('Registration Success! Signing In...');
                                $successM->printMessage();
                                // Need to login user and direct them to dashboard.
                                header("refresh:2; url=dashboard.php");
                            }
                        ?>
                    </div>

                    <div class="registerFields">
                        <form action="../backend/add_user.php" name="registerForm" method="post">  
                            <div class="leftAndRightRegisterFieldset">
                                <div class="inputWithIcon">
                                    <input name="fname" type="text" placeholder="First Name" required>
                                    <i class="fas fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon">
                                    <input name="lname" type="text" placeholder="Last Name" required>
                                    <i class="fas fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                </div>
                            
                                <div class="inputWithIcon">
                                    <input name="grad_year" type="text" placeholder="Graduation Year" required>
                                    <i class="fas fa-graduation-cap fa-lg fa-fw" style="padding-left: 7px;" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="leftAndRightRegisterFieldset">
                                <div class="inputWithIcon">
                                    <input name="studentemail" type="text" placeholder="Student Email" required>
                                    <i class="fas fa-envelope fa-lg fa-fw" style="padding-left: 9px;" aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon">
                                    <input name="password" type="password" placeholder="Password" required>
                                    <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon">
                                    <input name="passwordC" type="password" placeholder="Confirm Password" required>
                                    <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="registerButtonContainer">
                                <button class="registerButton">
                                    Register
                                </button>
                            </div>

                            <div class="bottomLoginContainer">
                                <p class="loginHere">
                                    Have an account? &nbsp;
                                </p>
                                <a href="login.php" class="signIn">
                                    Log In
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </article>

            <article></article>
        </section>
    </body>
</html>