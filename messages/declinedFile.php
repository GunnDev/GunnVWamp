<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/declinedFile.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class declinedFile {
            private $fileName;

            public function __construct($fName){
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
                    <button class='viewReason'>
                        <i class='fas fa-quote-left fa-sm'></i>
                    </button>
                </div>";
            }
        }
    ?>
</html>