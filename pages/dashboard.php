<!DOCTYPE html>

<html>
    <?php
        session_start();
        if(!isSet($_SESSION['student_id'])){
            header("Location: login.php");
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
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                
                <button class="btnRipple">
                    My Account
                </button>
                <button class="btnRipple">
                    Other Stuff
                </button>
                <button class="btnRipple">
                    Some More
                </button>

                <!-- Button ripple effect -->
                <script src="../scripts/btnRipple.js"></script>
            </div>
            
            <button onclick="openNav()" class="dropdownBtn">
                <i class="fas fa-bars"></i>
            </button>
            
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

                    <article>
                        <h1 class="userProgressTitle">
                            Progress
                        </h1>
                        <div class="userProgress">

                        </div>
                    </article>
                </section>
            </article>

            <article></article>

            <!-- Pending Submissions -->
            <article>
                <h1 class="hoursTitle">
                    Pending Hours
                </h1>
                <div class="addHoursContainer">
                    <button onclick="addHour()" class="addHoursBtn">
                        <i class="fas fa-plus"></i>
                    </button>

                    <div id="add_h" class="ahp">
                        <div class="ahp-content">
                            <span>
                                <i class="fas fa-times ahp-close"></i>
                            </span>
                            
                            <section class="fileSelectContent">
                                <article>
                                    <section class="topBottomFileSelectSection">
                                        <article style="display: flex; justify-content: center;">
                                            <div class="iconDiv">
                                                <i class="fas fa-file-upload fa-6x" style="color: #1a73e8;"></i>
                                            </div>
                                        </article>

                                        <article>
                                            <p style="margin: 0; padding: 0; font-weight: 500;">
                                                Selected Files:
                                            </p>
                                            <div id="show_file_list"></div>
                                        </article>
                                    </section>
                                </article>

                                <article>
                                    <section class="topBottomFileSelectSection">
                                        <article>
                                            <div class="fileUpload">
                                                <form action="#">
                                                    <label for="fileInput" class="selectFilesLabel">
                                                        <span class="fileSelectSpan">Browse</span>
                                                    </label>
                                                    <input id="fileInput" type="file" onchange="javascript:showfiles()" accept="application/pdf, image/jpeg, image/png, .docx" multiple="true">
                                                </form>
                                            </div>
                                        </article>

                                        <article class="uploadBtnContainer">
                                            <button class="uploadFilesBtn">
                                                Upload
                                            </button>
                                        </article>
                                    </section>
                                </article>
                            </section>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Approved Submissions -->
            <article>
                <h1 class="hoursTitle">
                    Approved Hours
                </h1>
            </article>
        </section>
    </body>

</html>

<!--

<article>
    <div class="fileUpload">
        <form action="#">
            <label for="fileInput" class="selectFilesLabel">
                <span class="fileSelectSpan">Browse</span>
            </label>
            <input id="fileInput" type="file" onchange="javascript:showfiles()" accept="application/pdf, image/jpeg, image/png, .docx" multiple="true">
        </form>
    </div>
</article>

-->