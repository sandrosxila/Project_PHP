<?php
require_once __DIR__.'/../helperFunctions.php';
require_once __DIR__.'/../db/Database.php';
$db = new Database();

if (isset($_POST)) {
    if(isset($_POST['Check']))$_POST['Output']=getOutput($_POST['Script'],$_POST['Language'],$_POST['Input']);
    if(isset($_POST['submissionName'])) {
        if ($_POST['submissionName'] != "") {
            $id=$_SESSION['currentUser']['id'];
            $name=$_POST['submissionName'];
            $script = $_POST['Script'];
            $language=$_POST['Language'];
            $db->addSubmission($id,$name,$script,$language);
        }
    }
    if(isset($_POST['needUpdate'])){
        if($_POST['needUpdate']=="1"){
            $id=$_POST['codeId'];
            $script=$_POST['Script'];
            $language=$_POST['Language'];
            $db->updateSubmission($id,$script,$language);
        }
    }
}
if(isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"]!=""){
    $filename=$_FILES["file"]["tmp_name"];
    $contents = readFileContents($filename);
}
?>
    <form action="" method="post" enctype="multipart/form-data">
        <p class="text-primary row" style="margin-bottom: -17px;">Select Language</p><br>
        <div class="row">

            <select id="choose_lang" required style="width:120px;">
                <option value="cpp14">C++</option>
                <option value="nodejs">NodeJS</option>
                <option value="python3">Python 3</option>
                <option value="java">Java</option>
                <option value="php">PHP</option>
            </select>
            <input type="hidden" id="code" name="Script">
            <input type="hidden" id="checker" name="Check" value="<?php if(isset($_POST["Language"]))echo "1";else echo "0";?>">
            <input type="hidden" id="lang" name="Language" value="<?php if(isset($_POST["Language"]))echo $_POST["Language"];else echo "";?>">
            <input type="hidden" id="opt" value="<?php if(isset($_POST["Language"]))echo $_POST["Language"];else echo "0";?>">
        </div>
        <div class="row">
            <div  class="col-6">
                <div id="editor" class="col" style="margin-left: -15px;"><?php
                    if(isset($_SESSION['Script']) && $_SESSION['Script']!=""){
                        echo $_SESSION['Script'];
                        unset($_SESSION['Script']);
                    }
                    else if(isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"]!=""){
                        echo $contents;
                    }
                    else {
                        if (isset($_POST['Script'])) {
                            if(isset($_POST['scriptToUpdate']) && !isset($_POST['needUpdate']))
                                $_POST['Script']=htmlentities($_POST['Script']);
                            echo $_POST['Script'];
                        }
                    }
                    ?></div>
            </div>
            <div class="col-1"></div>
            <div id='inout' class="col-5">
                <p>input...</p>
                <div class="row">

                    <textarea id="stdin" class="col" name="Input"><?php if(isset($_POST['Input'])){echo $_POST['Input'];}?></textarea>
                </div>
                <div class="row d-flex justify-content-center">

                    <button type="submit" id="compilebutton" class="btn btn-primary mr-5">compile</button>
                    <?php if(isLoggedIn()):?>
                    <label for="fileUpload" class="btn btn-primary mr-5">upload</label>
                    <input type="file" name="file" id="fileUpload" hidden>


                        <?php if(!isset($_POST['scriptToUpdate'])):?>
                            <input type="button" value="save as" id="saveAsButton" class="btn btn-primary">
                            <label for="compilebutton" id="saveButton" class="btn btn-primary">save</label>
                            <input type="text" id="subname" name="submissionName" placeholder="enter submission name">
                        <?php else: ?>
                            <label for="compilebutton" id="updateButton" class="btn btn-primary">update</label>
                            <input type="hidden" id="needUpdate" name="needUpdate" value="0">
                            <input type="hidden" name="scriptToUpdate" value="1">
                            <input type="hidden" name="codeId" value="<?=$_POST['codeId']?>">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div >
                    <p >output...</p>
                </div>
                <div class="row">
                    <textarea id="stdout" class="col" readonly><?php if(isset($_POST['Output'])){echo ($_POST['Output']);}?></textarea>
                </div>
            </div>
        </div>
    </form>

