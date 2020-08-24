<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/submissionBox.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class submissionBox {
            private $fname;
            private $lname;
            private $fileName;
            
            public function __construct($fname, $lname, $fileName){
                $this->fname = $fname;
                $this->lname = $lname;
                $this->fileName = $fileName;
            }

            public function printMessage(){
          echo '<div class="submissionBoxContainer">
                    <p class="showSubmissionInfo">
                        <span style="color:#636363;">';
                        echo $this->fname . ' ' . $this->lname;
                  echo "</span>";
                        echo ' - ' .  $this->fileName;
              echo "</p>
                </div>";
            }
        }
    ?>
</html>