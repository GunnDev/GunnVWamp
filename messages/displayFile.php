<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/displayFile.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class displayFile {
            private $fileName;

            public function __construct($fName){
                $this->fullFileName = $fName;
                        
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
          echo '<div class="displayFileContainer">
                    <p class="displayFileName">';
                        echo $this->fileName;
              echo "</p>
                </div>";
            }
        }
    ?>
</html>