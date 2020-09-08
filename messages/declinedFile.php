<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/declinedFile.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
    <script src="../scripts/showReason.js"></script>

    <?php
        class declinedFile {
            private $fileName;
            private $fileID;

            public function __construct($fName, $fileID){
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

            public function showFile(){
          echo '<div class="declinedFileContainer">
                    <p class="declinedFileName">';
                        echo $this->fileName;
              echo "</p>
                    <button onclick='showReason(this)' id='" . $this->fileID . "' class='viewReason' title='Reason for declination'>
                        <i class='fas fa-quote-left fa-sm'></i>
                    </button>
                </div>";
            }
        }
    ?>
</html>