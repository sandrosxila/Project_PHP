<?php
/**
 * Created by PhpStorm.
 * User: Sandro
 * Date: 5/13/2019
 * Time: 6:35 PM
 */
?>
<div class="container">
    <h1 class="d-flex justify-content-center">Create an Account</h1>
    <div>
        <article class="card-body mx-auto" style="max-width: 400px;">
            <form method="post" action="/submit-signup">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="fullname" class="form-control" placeholder="Full name" type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email address" type="email">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="password" class="form-control" placeholder="Create password" type="password">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="repeat" class="form-control" placeholder="Repeat password" type="password">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
                </div> <!-- form-group// -->
                <?php
                    if(isset($_SESSION['errEmail'])){
                        if($_SESSION['errEmail']==true){
                            echo "<p>Email You Entered Already exists</p>";
                            unset($_SESSION['errEmail']);
                        }
                    }
                    if(isset($_SESSION['errPass'])){
                        if($_SESSION['errPass']==true){
                            echo "<p>Repeated Password Doesn't Match</p>";
                            unset($_SESSION['errPass']);
                        }
                    }
                    if(isset($_SESSION['errPasslen'])){
                        if($_SESSION['errPasslen']==true){
                            echo "<p>Password Should be <b>at least 5 Characters</b> Long</p>";
                            unset($_SESSION['errPasslen']);
                        }
                    }
                    if(isset($_SESSION['errName'])){
                        if($_SESSION['errName']==true){
                            echo "<p>Full Name Can't be <b>Empty</b></p>";
                            unset($_SESSION['errName']);
                        }
                    }
                    if(isset($_SESSION['errEmaillen'])){
                        if($_SESSION['errEmaillen']==true){
                            echo "<p>E-mail Can't be <b>Empty</b></p>";
                            unset($_SESSION['errEmaillen']);
                        }
                    }
                    ?>
                <p class="text-center">Have an account? <a href="/login">Log In</a> </p>
            </form>
        </article>
    </div>

</div>
