<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/successStyles.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class successMessage {
            private $message;

            public function __construct($successM){
                $this->message = $successM;
            }

            public function printMessage(){
                  echo '<div class="successContainer">
                            <div class="smessage">
                                <p class="successTitle">
                                    <i class="fas fa-check-circle fa-md fa-fw" aria-hidden="true" style="color:#2c990b;"></i>';
                                    echo ' - ' . $this->message;
                          echo '</p>
                            </div>
                        </div>';
            }
        }
    ?>
</html>