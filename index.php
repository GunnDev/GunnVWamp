<!DOCTYPE html>

<html>
    <?php
        session_start();
    ?>

    <head>
        <title>Gunn Volunteering | Home</title>

        <!-- Links, Cool stuff, and Page Specs -->
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">

        <!-- Keep the navbar at the top of the page -->
        <script src="scripts/navbarSticky.js" defer></script>

    </head>

    <body>
        <header id="topNav" class="siteNavHeader">
            <a href="index.php" class="logo">
                <h1 class="navMainTitle">Gunn Volunteering</h1>
            </a>
            <nav class="navbarItems">
                <ul class="navbarLinks">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Developers</a></li>
                    <li class="navbarDivider">|</li>
                    <?php
                        if(isSet($_SESSION['student_id'])){
                            echo '<li><a href="pages/login.php">Dashboard</a></li>';
                        } else {
                            echo '<li><a href="pages/login.php">Login</a></li>';
                        }
                    ?>
                </ul>
            </nav>
        </header>

        <section class="mainHomePageTitle">
            <article></article>
            <article>
                <h1 class="catchphrase">
                    Wherever and Whenever.
                </h1>
                <div class="miniCatchphrase">
                    <h1 class="miniCatchphraseSpecs">
                        Gunn Volunteering - The easiest way for staff and students to streamline the volunteer hours process at Gunn.
                    </h1>
                </div>
                <div class="getStartedBtnContainer">
                    <a href="pages/login.php">
                        <button class="getStarted">
                            Get Started
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </a>
                </div>
            </article>
            <article></article>
        </section>

    </body>
</html>