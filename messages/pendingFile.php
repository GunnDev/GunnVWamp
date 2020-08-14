<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/pendingFile.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
    <script src="../scripts/deleteHourModal.js"></script>

    <?php
        class pendingFile {
            private $fileName;
            private $fileID;

            public function __construct($fName){
                $this->fileID = $fName;
                        
                $fileAspects = explode('.', $fName);
                $fileNameWithoutExtension = $fileAspects[0];
                $fileExtension = $fileAspects[1];

                if (strlen($fileNameWithoutExtension) > 45) {
                    $fileNameWithoutExtension = substr($fileNameWithoutExtension, 0, 43);
                    $this->fileName = $fileNameWithoutExtension . '...' . $fileExtension;
                } else {
                    $this->fileName = $fName;
                }
            }

            public function showPendingFile(){
          echo '<div class="pendingFileContainer">
                    <p class="pendingFileName">';
                        echo $this->fileName;
              echo "</p>
                    <button id='" . $this->fileID . "' title='Delete " . $this->fileName . " ' onclick='deleteHour(this)' class='deleteFile'>
                        <i class='fas fa-trash'></i>
                    </button>
                </div>";
            }
        }
    ?>
</html>