<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="./Compile.css">
    <title>Title</title>
    <style>
        .divider-text {
            position: relative;
            text-align: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .divider-text span {
            padding: 7px;
            font-size: 12px;
            position: relative;
            z-index: 2;
        }
        .divider-text:after {
            content: "";
            position: absolute;
            width: 100%;
            border-bottom: 1px solid #ddd;
            top: 55%;
            left: 0;
            z-index: 1;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/"><i class="fas fa-code" style="font-size: larger;">   Compiler API</i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if($_SERVER['REQUEST_URI']=='/') echo "active"; ?>">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if($_SERVER['REQUEST_URI']=='/about') echo "active"; ?>">
                    <a class="nav-link" href="/about">About </a>
                </li>
                <?php if(isset($_SESSION['currentUser'])): ?>
                <li class="nav-item <?php if($_SERVER['REQUEST_URI']=='/profile') echo "active"; ?>">
                    <a class="nav-link" href="/profile">Profile</a>
                </li>
                <?php endif; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <?php if (!isLoggedIn()): ?>
                    <a href="/login" class="btn btn-outline-success">Log in</a>
                    &nbsp;&nbsp;
                    <a href="/signup" class="btn btn-outline-primary">Sign up</a>
                <?php else: ?>
                    &nbsp;&nbsp;
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Welcome <b><?php echo currentUser()['full_name'] ?></b>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="btn btn-primary">Logout</a>
                        </li>
                    </ul>
                <?php endif; ?>
            </form>
        </div>
    </div>
</nav>


<div class="container">
    {{content}}
</div>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
<script src="./src/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="./src/mode-javascript.js" type="text/javascript" charset="utf-8"></script>
<script src="./src/mode-python.js" type="text/javascript" charset="utf-8"></script>
<script src="./src/mode-java.js" type="text/javascript" charset="utf-8"></script>
<script src="./src/mode-c_cpp.js" type="text/javascript" charset="utf-8"></script>
<script src="./src/mode-php.js" type="text/javascript" charset="utf-8"></script>
<script src="./compile.js" type="text/javascript" charset="utf-8"></script>


</body>
</html>
