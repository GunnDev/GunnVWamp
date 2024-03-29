<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/pendingFile.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
    <script src="../scripts/deleteHourModal.js"></script>

    <?php
        class pendingFile {
            private $fileName;
            private $fullFileName;
            private $fileID;

            public function __construct($fName, $fileID){
                $this->fullFileName = $fName;
                $this->fileID = $fileID;
                        
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
                    <button data-ffname='" . $this->fullFileName . "' id='" . $this->fileID . "' title='Delete " . $this->fileName . " ' onclick='deleteHour(this.id)' class='deleteFile'>
                        <i class='fas fa-trash'></i>
                    </button>
                </div>";
            }
        }
    ?>
</html>