<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/studentBox.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class studentBox {
            private $message;

            public function __construct($ttd){
                $this->message = $ttd;
            }

            public function printMessage(){
          echo '<div class="studentBoxContainer">
                    <p class="showStudentName">';
                        echo $this->message;
              echo "</p>
                </div>";
            }
        }
    ?>
</html>