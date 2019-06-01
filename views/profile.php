<div>
    <?php
    require_once __DIR__.'/../db/Database.php';
    $db=new Database();
    $username= $_SESSION['currentUser']['full_name'];
    $email=$_SESSION['currentUser']['email'];
    echo "<h1>Profile</h1>
        <dl>
            <dt>Name:</dt>
            <dd>$username</dd>
            <dt>Email:</dt>
            <dd>$email</dd>
        </dl>
    ";
    $id=$_SESSION['currentUser']['id'];
    $sqlArray=$db->getSubmissions($id);
    ?>
    <form action="/" method="POST">

    <?php for($i=0;$i<count($sqlArray);$i++):?>
    <div class="card">
        <div class="card-header" id="heading<?=$i?>" onclick="slideUp(<?=$i?>)">
            <h5 class="mb-0 d-flex">
                <button type="button" class="btn btn-link mr-auto p-2">
                    <?=$sqlArray[$i]['title'] ?>
                </button>
                <input type="hidden" id="code<?=$i?>" value="<?=$sqlArray[$i]['id'] ?>">
                <input type="hidden" id="lang<?=$i?>" value="<?=$sqlArray[$i]['lang'] ?>">
                <input type="submit" name="Button_1" class="btn btn-primary p-2" onclick="insertInput(<?=$i?>)" value="Update">
                <input type="submit" name="Button_2" class="btn btn-danger p-2 ml-2" id="del" value="Delete"  onclick="insertInput(<?=$i?>) "formaction="/delete-submission">
            </h5>
        </div>
        <div id="collapse<?=$i?>" class="collapse hide">
            <div class="card-body">
                <pre id="pre<?=$i?>"><?=$sqlArray[$i]['script']?></pre>
            </div>
        </div>
    </div>
    <?php endfor; ?>
        <input type="hidden" name="scriptToUpdate" value="1">
    </form>
</div>
