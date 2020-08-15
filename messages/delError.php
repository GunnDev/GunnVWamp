<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/delError.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class delError {
            private $message;

            public function __construct($delErrorM){
                $this->message = $delErrorM;
            }

            public function printMessage(){
                  echo '<div class="delErrorContainer">
                            <div class="delErrorMessage">
                                <p class="delErrorTitle">
                                    <i class="fas fa-times fa-lg fa-fw" aria-hidden="true" style="color:#d41515;"></i>';
                                    echo ' - ' . $this->message;
                          echo '</p>
                            </div>
                        </div>';
            }
        }
    ?>
</html>