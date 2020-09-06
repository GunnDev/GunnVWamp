<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/reviewBox.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class reviewBox {
            private $fname;
            private $lname;
            private $fileName;

            public function __construct($fname, $lname, $fileName){
                $this->fname = $fname;
                $this->lname = $lname;
                $this->fileName = $fileName;
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
                            <div class='linkBtnDiv'>
                                <i class='fas fa-pencil-alt fa-lg centeredIcon' style='color:#1a73e8'></i>
                            </div>
                        </article>
                    </section>
                </div>";
            }
        }
    ?>
</html>