<div>
    <?php
        if(isset($_SESSION['SuccesSignup'])){
            if($_SESSION['SuccesSignup']==true){
                echo "<h3 class=\"d-flex justify-content-center\">You Have Registered Successfully Please Login If You Want So</h3><hr>";
                unset($_SESSION['SuccesSignup']);
            }
        }
        if(isset($_SESSION['Incorrect'])){
            if($_SESSION['Incorrect']==true){
                echo "<div class=\"alert alert-danger\">
                            <h1>Username Or Password Is Incorrect</h1>
                        </div>
                     ";
                unset($_SESSION['Incorrect']);
            }
        }
    ?>
    <h1 class="d-flex justify-content-center">Login</h1>
    <div class="d-flex justify-content-center">
        <form method="post" action="/submit-login" style="width: 400px;">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                       placeholder="Enter email" value="<?php if(isset($_SESSION['E-mail']))echo $_SESSION['E-mail']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width:135px;">Submit</button>
            </div>
        </form>
    </div>
</div>
