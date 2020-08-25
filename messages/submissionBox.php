<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/submissionBox.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class submissionBox {
            private $fname;
            private $lname;
            private $fileName;
            private $fileLink;
            
            public function __construct($fname, $lname, $fileName, $fileLink){
                $this->fname = $fname;
                $this->lname = $lname;
                $this->fileName = $fileName;
                $this->fileLink = $fileLink;
            }

            public function printMessage(){
          echo '<div class="submissionBoxContainer">
                    <section class="submissionBoxSection">
                        <article>
                            <p class="showSubmissionInfo">
                                <span style="color:#636363;">';
                                echo $this->fname . ' ' . $this->lname;
                        echo "</span>";
                                echo ' - ' .  $this->fileName;
                      echo "</p>
                        </article>
                        <article>
                            <div class='linkToDrive'>
                                <a href='$this->fileLink' class='linkBtn' title='Open in Drive?'>
                                    <i class='fas fa-link fa-lg centeredIcon'></i>
                                </a>
                            </div>
                        </article>
                    </section>
                </div>";
            }
        }
    ?>
</html>