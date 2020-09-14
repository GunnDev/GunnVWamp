<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/reviewBox.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
    <script src="../scripts/showReason.js"></script>

    <?php
        class reviewBox {
            private $fname;
            private $lname;
            private $fileName;
            private $fileID;

            public function __construct($fname, $lname, $fileName, $fileID){
                $this->fname = $fname;
                $this->lname = $lname;
                $this->fileName = $fileName;
                $this->fileID = $fileID;
            }

            public function printMessage(){
          echo "<div class='reviewBoxContainer'>
                    <section class='reviewBoxSection'>
                        <article>
                            <p class='showReviewInfo'>
                                <span style='color:#636363;'>";
                                echo $this->fname . ' ' . $this->lname;
                        echo "</span>";
                                echo ' - ' .  $this->fileName;
                      echo "</p>
                        </article>
                        <article>
                            <div onclick='editSubmission(" . "\"" . $this->fileID . "\"" . ")' class='linkBtnDiv'>
                                <i class='fas fa-pencil-alt fa-lg centeredIcon' style='color:#1a73e8' title='Edit Submission'></i>
                            </div>
                        </article>
                    </section>
                </div>";
            }
        }
    ?>
</html>