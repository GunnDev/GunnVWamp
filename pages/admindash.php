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

    </head>

    <body>
        <header class="siteNavHeader" style="background-color: #A61616;">
            <button class="admin-dropdownBtn">
                <i class="fas fa-bars"></i>
            </button>

            <h1 class="navMainTitle" style="cursor: context-menu;">Welcome, Administrator</h1>
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

        <section class="adminDashSection">
            <article>
                <h1 class="hoursTitle">
                    Submissions:
                </h1>
            </article>

            <article>
                <h1 class="hoursTitle">
                    Review:
                </h1>
            </article>

            <article>
                <!-- Notifications / student submissions -->
            </article>

            <article>
                <!-- Approve/Deny/Comments -->
            </article>
        </section>
    </body>

</html>