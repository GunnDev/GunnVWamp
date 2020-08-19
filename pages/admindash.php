<!DOCTYPE html>
<!--

Author: Mihir Rao
Gunn Volunteering

-->

<html>
    <?php
        include '../backend/GoogleDriveUtils.php';
        session_start();
        if(!isSet($_SESSION['student_id'])){
            header("Location: login.php");
        } else {
            if($_SESSION['student_id'] != 1){
                header("Location: dashboard.php");
            }
        }
    ?>

    <head>
        <!-- Links, Cool stuff, and Page Specs -->
        <link rel="stylesheet" href="../css/dashStyles.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta charset="utf-8">

        <script src="../scripts/sideNav.js"></script>
        <script src="../scripts/addHourModal.js"></script>
        <script src="../scripts/uploadFile.js"></script>
    </head>

    <body>
        <header class="siteNavHeader">
            <h1 class="navMainTitle" style="cursor: context-menu;">Gunn Volunteering</h1>
            <nav class="navbarItems">
                <ul class="navbarLinks">
                    <li>
                        <a href="logout.php">
                            <i class="fas fa-sign-out-alt fa-2x"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <section class="mainDashSection">
            <article>
                <section class="userDashSection">
                    <article class="userIconContainer">
                        <div class="userIcon">
                            <img src="../images/user.png">
                        </div>
                    </article>

                    <article>
                        <div class="nameAndGradYear">
                            <h1 class="nameTitle">
                                <?php
                                    echo $_SESSION['student_fname'] . ' ' . $_SESSION['student_lname'];
                                ?>
                            </h1>
                            <h1 class="gradYearDisplay">
                                <?php
                                    echo $_SESSION['student_gyear'];
                                ?>
                            </h1>
                        </div>
                    </article>

                </section>
            </article>

            <article></article>
                 
            <!-- Notifications -->
            <article>
                <h1 class="hoursTitle">
                    Notifications
                </h1>
            </article>
        </section>
    </body>

</html>