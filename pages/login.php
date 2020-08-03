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
        <title>Login</title>
    </head>

    <body OnLoad="document.loginForm.student_id.focus();">
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

        <section class="loginBoxContainer">
            <article></article>

            <article>
                <div class="loginSection">  
                    <h1 class="loginTitle">
                        Login.
                    </h1>

                    <div class="resultMessage">
                        <?php
                            include '../messages/errorMessage.php';

                            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            // Error message if unable to login
                            if (strpos($fullUrl, "login=failure") == true){
                                $errM = new errorMessage('Login Failed: Try Again');
                                $errM->printMessage();
                            }
                        ?>
                    </div>

                    <div class="loginFields">
                        <form action="../backend/login_user.php" name="loginForm" method="post">
                            <fieldset style="border: 0; padding-top: 0px;">
                                <div class="inputWithIcon">
                                    <input name="student_id" type="text" placeholder="Student ID" required>
                                    <i class="fas fa-id-badge fa-lg fa-fw" aria-hidden="true"></i>
                                </div>
                            
                                <div class="inputWithIcon">
                                    <input name="student_pass" type="password" placeholder="Password" required>
                                    <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                </div>

                                <div class="loginButtonContainer">
                                    <button class="loginButton">
                                        Login
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <div class="signUpContainer">
                        <p class="signUpHere">
                            Don't have an account? &nbsp;
                        </p>
                        <a href="register.php" class="createAccount">
                            Sign Up
                        </a>
                    </div>
                </div>
            </article>

            <article></article>
        </section>

    </body>
</html>