<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/errorStyles.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class errorMessage {
            private $message;

            public function __construct($errorM){
                $this->message = $errorM;
            }

            public function printMessage(){
                  echo '<div class="errContainer">
                            <div class="emessage">
                                <p class="errorTitle">
                                    <i class="fas fa-exclamation-circle fa-md fa-fw" aria-hidden="true" style="color:#db1212;"></i>';
                                    echo ' - ' . $this->message;
                          echo '</p>
                            </div>
                        </div>';
            }
        }
    ?>
</html>