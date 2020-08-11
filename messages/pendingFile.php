<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/pendingFile.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
    <script src="../scripts/deleteHourModal.js"></script>

    <?php
        class pendingFile {
            private $fileName;

            public function __construct($fName){
                $this->fileName = $fName;
            }

            public function showPendingFile(){
          echo '<div class="pendingFileContainer">
                    <p class="pendingFileName">';
                        echo $this->fileName;
              echo "</p>
                    <button id='" . $this->fileName . "' title='Delete " . $this->fileName . " ' onclick='deleteHour()' class='deleteFile'>
                        <i class='fas fa-trash'></i>
                    </button>
                </div>";
            }
        }
    ?>
</html>