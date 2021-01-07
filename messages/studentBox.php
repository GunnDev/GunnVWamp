<!DOCTYPE html>

<html>
    <link rel="stylesheet" href="../messages/studentBox.css">
    <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>

    <?php
        class studentBox {
            private $fname;
            private $lname;
            private $studentid;
            private $gradyear;
            private $completedHours;
            
            public function __construct($fname, $lname, $studentid, $gradyear, $completedHours){
                $this->fname = $fname;
                $this->lname = $lname;
                $this->studentid = $studentid;
                $this->gradyear = $gradyear;
                $this->completedHours = $completedHours;
            }

            public function printMessage(){
          echo '<div class="studentBoxContainer">
                    <section class="showStudentInfo">
                        <article>
                            <p class="verticalCentered">';
                            echo 'Name: ' . '<span style="color:#1a73e8;">' . $this->fname . ' ' . $this->lname . '</span>';
                      echo '</p>
                        </article>
                        <article>
                            <p class="verticalCentered">';
                                echo 'ID: ' . '<span style="color:#1a73e8;">' . $this->studentid . '</span>';
                      echo '</p>
                        </article>
                        <article>
                            <p class="verticalCentered">';
                                echo 'Grad: ' . '<span style="color:#1a73e8;">' . $this->gradyear . '</span>';
                      echo '</p>
                        </article>
                        <article>
                            <p class="verticalCentered">';
                                echo 'Completed Hours: ' . '<span style="color:#1a73e8;">' . $this->completedHours . '</span>';
                      echo "</p>
                        </article>
                        <article>
                            <button id='$this->studentid' title='Delete Student' class='adminDeleteTrashCentered' onclick='deleteUser(this.id)'>
                                <i class='fas fa-trash fa-lg'></i>
                            </button>
                        </article>
                    </section>
                </div>";
            }
        }
    ?>
</html>