<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/fileError.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class fileError {
            private $message;

            public function __construct($fileErrorM){
                $this->message = $fileErrorM;
            }

            public function printMessage(){
                  echo '<div id="filemsg" class="fileErrorContainer">
                            <div class="fileErrorMessage">
                                <p class="fileErrorTitle">
                                    <i class="fas fa-times fa-lg fa-fw" aria-hidden="true" style="color:#d41515;"></i>';
                                    echo ' - ' . $this->message;
                          echo '</p>
                            </div>
                        </div>';
            }
        }
    ?>
</html>