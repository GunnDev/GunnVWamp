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
        
        <script src="../scripts/expandedSearchMenu.js"></script>
        <script src="../scripts/uncheckSort.js"></script>
        <script src="../scripts/deleteUser.js"></script>

        <script>
            $(document).ready(function(){
                $("#lastnamefield").focus(function() {
                    $(this).attr("origPlaceholder", $(this).attr("placeholder"));
                    $(this).attr("placeholder", "Ex. \"Skywalker\"");
                });

                $("#lastnamefield").blur(function() {
                    if ($(this).attr("origPlaceholder")) {
                    $(this).attr("placeholder", $(this).attr("origPlaceholder"));
                    }
                });
            });

            $(document).ready(function(){
                $("#firstnamefield").focus(function() {
                    $(this).attr("origPlaceholder", $(this).attr("placeholder"));
                    $(this).attr("placeholder", "Ex. \"Luke\"");
                });

                $("#firstnamefield").blur(function() {
                    if ($(this).attr("origPlaceholder")) {
                    $(this).attr("placeholder", $(this).attr("origPlaceholder"));
                    }
                });
            });

            $(document).ready(function(){
                $("#idfield").focus(function() {
                    $(this).attr("origPlaceholder", $(this).attr("placeholder"));
                    $(this).attr("placeholder", "Ex. \"950_____\"");
                });

                $("#idfield").blur(function() {
                    if ($(this).attr("origPlaceholder")) {
                    $(this).attr("placeholder", $(this).attr("origPlaceholder"));
                    }
                });
            });
        </script>

        <title>Gunn Volunteering | Students</title>
    </head>

    <body>
        <div class="sidenavadmin">
            <h2 class="sideNavAdminTitle">
                Options
            </h2>
            <div class="sidenav-separator">
                <div style="background-color: #e8e8e8; width: 90%; height: 1px;">
                    <!-- Blank -->
                </div>
            </div>
            <a href="?&g1=1&g2=1&g3=1&g4=1&adv=t" style="background-color: #dedede; color: #1a73e8;">
                <i class="fas fa-users fa-lg"></i>
                &nbsp;
                Students
            </a>
            <a href="submissions.php">
                <i class="fas fa-paper-plane fa-lg"></i>
                &nbsp;
                Submissions
            </a>
            <a href="reviewed.php">
                <i class="far fa-eye fa-lg"></i>
                &nbsp;
                Reviewed
            </a>
        </div>

        <div class="main">
            <header class="siteNavHeader" style="background-color: #1a73e8; height: 62px;">
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

            <section class="students-admin-dash-section">
                <article>
                    <div class="searchForStudentsDiv">
                        <form action="../backend/searchStudents.php" method="post">
                            <section class="searchForm">
                                <article>
                                    <input name="lastNameToSearch" id="lastnamefield" type='text' class="searchBox" style="margin-left: 20px" placeholder='Last Name'>
                                </article>

                                <article>
                                    <input name="firstNameToSearch" id="firstnamefield" type='text' class="searchBox" placeholder='First Name'>
                                </article>

                                <article>
                                    <input name="studentIDToSearch" id="idfield" type='text' class="searchBox" placeholder='Student ID'>
                                </article>

                                <article>
                                    <div class="expandedSearchDiv" onclick="expandedSearchMenu()">
                                        <i class="fas fa-ellipsis-v fa-lg centeredExpanded" style="color:#1a73e8"></i>
                                    </div>
                                </article>

                                <article>
                                    <button type="submit" class="searchBtn">
                                        Search &nbsp;
                                        <span>
                                            <i class="fas fa-search fa-sm"></i>
                                        </span>
                                    </button>
                                </article>

                                <article>
                                    <div id="trashDiv" class="trashExpandedSearchDiv">
                                        <i id="trashIcon" onclick="removeSearch()" class="fas fa-trash fa-lg trashCenteredExpanded"></i>
                                    </div>
                                </article>
                            </section>

                            <div id="expandedSearchModal" class="expandedSearchModalOuter">
                                <div class="expandedSearchModalContent">
                                    <section class="expandedSearchSection">
                                        <article>
                                            <p class="advancedSearchTitle">
                                                Advanced Search:
                                            </p>
                                            <p class="subAdvancedSearchTitle">
                                                Any selections made here will disregard First, Last, and StudentID Fields.
                                            </p>
                                        </article>
                                        
                                        <article>
                                            <section class="expandedSearchSection2">
                                                <article style="display:flex; justify-content:center;">
                                                    <div style="width: 50%;">
                                                        <input type="checkbox" id="grade1" name="grade1" value="9">
                                                        <label class="labelTxtStyle" for="grade1"> Grade 9</label><br>
                                                        <input type="checkbox" id="grade2" name="grade2" value="10">
                                                        <label class="labelTxtStyle" for="grade2"> Grade 10</label><br>
                                                        <input type="checkbox" id="grade3" name="grade3" value="11">
                                                        <label class="labelTxtStyle" for="grade3"> Grade 11</label><br>
                                                        <input type="checkbox" id="grade4" name="grade4" value="12">
                                                        <label class="labelTxtStyle" for="grade4"> Grade 12</label><br>
                                                    </div>
                                                </article>
                                                
                                                <article style="display:flex; justify-content:center;">
                                                    <div style="width: 100%;">
                                                        <input type="radio" id="alphabeticalF" name="alphabetical" value="alphabeticalF">
                                                        <label class="labelTxtStyle" for="alphabeticalF"> Sort Alphabetically(First)</label><br>
                                                    </div>
                                                </article>

                                                <article style="display:flex; justify-content:center;">
                                                    <div style="width: 100%;">
                                                        <input type="radio" id="alphabeticalL" name="alphabetical" value="alphabeticalL">
                                                        <label class="labelTxtStyle" for="alphabeticalL"> Sort Alphabetically(Last)</label><br>
                                                    </div>
                                                </article>
                                            </section>
                                        </article>

                                        <article style="justify-content:center; display:flex;">
                                            <section class="expandedSearchSection3">
                                                <article>
                                                    <button class="uncheckSortBtn" type="button" onclick="uncheckSortSelection()">
                                                        Remove Selections
                                                    </button>
                                                </article>

                                                <article>
                                                    <button class="saveAdvancedSearchBtn" type="button" id="saveAdvancedSearchBtn">
                                                        Save
                                                    </button>
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>
                            </div>
                        </form>
                    </div>
                </article>

                <article>
                    <?php
                        include "../backend/db_connect.php";
                        include "../messages/studentBox.php";

                        // The URL that has the sorting info.
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        $getAllUsers = "SELECT studentid, firstname, lastname, gradyear, num_hours FROM users WHERE studentid != 1";
                        $resultGetAll = $mysqli->query($getAllUsers) or die (mysqli_error($mysqli));
                        $allUsers = $resultGetAll->fetch_all(MYSQLI_ASSOC);

                        // Grade Sorting -------------------------------

                        // Using array to store indeces to remove so that array size doesn't change during loop
                        $studentsToRemove = array();
                        
                        if (strpos($fullUrl, "adv=t") == true) {
                            for($i = 0; $i < count($allUsers); $i++){
                                $grade = 4 - ($allUsers[$i]['gradyear'] - date("Y"));
    
                                if(strpos($fullUrl, "g1=1") == false && $grade == 1) {
                                    array_push($studentsToRemove, $i);
                                }
                                if(strpos($fullUrl, "g2=1") == false && $grade == 2) {
                                    array_push($studentsToRemove, $i);
                                }
                                if(strpos($fullUrl, "g3=1") == false && $grade == 3) {
                                    array_push($studentsToRemove, $i);
                                }
                                if(strpos($fullUrl, "g4=1") == false && $grade == 4) {
                                    array_push($studentsToRemove, $i);
                                }
                            }
    
                            for($k = 0; $k < count($studentsToRemove); $k++) {
                                unset($allUsers[$studentsToRemove[$k]]);
                            }
    
                            // Re-index after deleting array elements(students);
                            $allUsers = array_values($allUsers);
    
                            // If sorting by first name.
                            if (strpos($fullUrl, "st=F") == true) {
                                usort($allUsers, "sortAlphaFirstCmp");
                            }
    
                            // If sorting by last name.
                            if (strpos($fullUrl, "st=L") == true) {
                                usort($allUsers, "sortAlphaLastCmp");
                            }
                        } else if (strpos($fullUrl, "adv=f") == true) {
                            $fname = isset($_GET['fname']) ? $_GET['fname'] : null;
                            $lname = isset($_GET['lname']) ? $_GET['lname'] : null;
                            $studid = isset($_GET['studid']) ? $_GET['studid'] : null;

                            for($i = 0; $i < count($allUsers); $i++){
                                if($fname != null && strcmp($allUsers[$i]['firstname'], $fname) != 0) {
                                    array_push($studentsToRemove, $i);
                                }
                                if($lname != null && strcmp($allUsers[$i]['lastname'], $lname) != 0) {
                                    array_push($studentsToRemove, $i);
                                }
                                if($studid != null && strcmp($allUsers[$i]['studentid'], $studid) != 0) {
                                    array_push($studentsToRemove, $i);
                                }
                            }

                            for($k = 0; $k < count($studentsToRemove); $k++) {
                                unset($allUsers[$studentsToRemove[$k]]);
                            }
                        }

                        // Display names
                        for($j = 0; $j < count($allUsers); $j++){
                            $newStudentBox = new studentBox($allUsers[$j]['firstname'], $allUsers[$j]['lastname'],  $allUsers[$j]['studentid'], $allUsers[$j]['gradyear'], $allUsers[$j]['num_hours']);
                            $newStudentBox->printMessage();
                        }

                        // Functions -------------------------------

                        function sortAlphaFirstCmp($a, $b){
                            $key = 'firstname';
                            if($a[$key] < $b[$key]){
                                return -1;
                            } else if($a[$key] > $b[$key]){
                                return 1;
                            }
                            return 0;
                        }

                        function sortAlphaLastCmp($a, $b){
                            $key = 'lastname';
                            if($a[$key] < $b[$key]){
                                return -1;
                            } else if($a[$key] > $b[$key]){
                                return 1;
                            }
                            return 0;
                        }
                    ?>
                </article>
            </section>

            <div id="dum" class="deleteUserModal">
                <div class="deleteUserModal-content">
                    <section class="deleteUserSection">
                        <article>
                            <p class="deleteUserHeading">
                                Delete Student With ID:&nbsp;
                                <span id="usersIDToDelete">
                                    some id
                                </span>
                                ?
                            </p>
                        </article>

                        <article style="display:flex; justify-content:center;">
                            <div class="inputWithIcon" style="width:100%">
                                <input class="passwordRepl" type="password" placeholder="Password" required>
                                <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                            </div>
                        </article>

                        <article>
                            <section class="deleteUserSection2">
                                <article>
                                    <button type="button" class="deleteUserBtns">
                                        Cancel
                                    </button>
                                </article>

                                <article>
                                    <button type="submit" class="deleteUserBtns">
                                        Delete
                                    </button>
                                </article>
                            </section>
                        </article>
                    </section>
                </div>
            </div>
        </div>

    </body>

</html>