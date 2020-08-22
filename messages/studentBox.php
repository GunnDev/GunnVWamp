<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/studentBox.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class studentBox {
            private $fname;
            private $lname;
            private $studentid;
            
            public function __construct($fname, $lname, $studentid){
                $this->fname = $fname;
                $this->lname = $lname;
                $this->studentid = $studentid;
            }

            public function printMessage(){
          echo '<div class="studentBoxContainer">
                    <p class="showStudentName">';
                        echo $this->fname . ' ' . $this->lname . ' - ' .  $this->studentid;
              echo "</p>
                </div>";
            }
        }
    ?>
</html>