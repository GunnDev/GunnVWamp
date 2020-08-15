<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/delSuccess.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class delSuccess {
            private $message;

            public function __construct($delSuccessM){
                $this->message = $delSuccessM;
            }

            public function printMessage(){
                  echo '<div class="delSuccessContainer">
                            <div class="delSuccessmessage">
                                <p class="delSuccessTitle">
                                    <i class="fas fa-check fa-lg fa-fw" aria-hidden="true" style="color:#2c990b;;"></i>';
                                    echo ' - ' . $this->message;
                          echo '</p>
                            </div>
                        </div>';
            }
        }
    ?>
</html>