<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../Request.php';
require_once __DIR__ . '/../Router.php';
require_once __DIR__ . '/../db/Database.php';
require_once __DIR__.'/../helperFunctions.php';
session_start();

$db = new Database();

$router = new Router(new Request);
$router->get('/', function (IRequest $request) use ($db,$router) {
    $body = $request->getBody();
    $page = $router->renderOnlyView('index');
    return renderPageView($body,$page,$db);
});
$router->post('/', function (IRequest $request) use ($db,$router) {
    $body = $request->getBody();
    $page = $router->renderOnlyView('index');
    return renderPageView($body,$page,$db);
});
$router->get('/profile', 'profile');
$router->get('/signup', 'signup');
$router->get('/about', 'about');
$router->get('/login', 'login');
$router->get('/logout', function(){
    session_unset();
    session_destroy();
    redirect('/');
});
$router->post('/delete-submission',function (IRequest $request) use ($db) {
    $body = $request->getBody();
    $id = $body['codeId'];
    $db->deleteSubmission($id);
    redirect('/profile');
});
$router->post('/submit-login', function (IRequest $request) use ($db) {
    $body = $request->getBody();
    if ($db->loginUser($body['email'], $body['password'])) {
        $_SESSION['E-mail']=$body['email'];
        redirect('/');
    } else {
        $_SESSION['Incorrect']=true;
        redirect('/login');
    }
});
$router->post('/submit-signup', function (IRequest $request) use ($db) {
    $body = $request->getBody();
    if(strlen($body['email'])==0){
        $_SESSION['errEmaillen']=true;
        redirect('/signup');
    }
    else if($db->signupUser($body['email'])!=0){
        $_SESSION['errEmail']=true;
        redirect('/signup');
    };
    if($body['password']!=$body['repeat']){
        $_SESSION['errPass']=true;
        redirect('/signup');
    }
    if(strlen($body['password'])<5){
        $_SESSION['errPasslen']=true;
        redirect('/signup');
    }
    if(strlen($body['fullname'])==0){
        $_SESSION['errName']=true;
        redirect('/signup');
    }

    if(
        !($db->signupUser($body['email'])!=0) &&
        !($body['password']!=$body['repeat']) &&
        !(strlen($body['password'])<5) &&
        !(strlen($body['fullname'])==0) &&
        !(strlen($body['email'])==0)
    ){
        $_SESSION['SuccesSignup']=true;
        $_SESSION['E-mail']=$body['email'];
        $db->createRecord($body['fullname'],$body['email'],$body['password']);
        redirect('/login');
    }
});