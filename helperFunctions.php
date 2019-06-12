<?php
/**
 * Created by PhpStorm.
 * User: Sandro
 * Date: 6/1/2019
 * Time: 2:09 PM
 */
function getOutput($script,$language,$input)
{
    $script=json_encode(html_entity_decode($script));
    $script=str_replace("&#039;",'\'',$script);
    $input=json_encode(html_entity_decode($input));
    $postfields = '{
	"clientId": "e23f0c7656f66f4e16d8917ff674052d",
	"clientSecret":"9a89014a9860a4ae9315a49e83a6df925dd1941168aaa8d787604ebce80465c5",
	"script": ' . $script . ',
	"language":"'.$language.'",
	"stdin":'.$input.',
	"versionIndex":"1"
    }';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.jdoodle.com/v1/execute');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=UTF-8'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($ch);
    $result=json_decode($result,1);
    return $result["output"];
}
function readFileContents($filename){
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    $contents=htmlentities($contents);
    fclose($handle);
    return $contents;
}
function renderPageView($body,$page,$db){
    if(isset($body['Check']))$body['Output']=getOutput($_POST['Script'],$body['Language'],$body['Input']);
    if(isset($body['submissionName'])) {
        if ($body['submissionName'] != "") {
            $id=$_SESSION['currentUser']['id'];
            $name=$body['submissionName'];
            $script = $_POST['Script'];
            $language=$body['Language'];
            $db->addSubmission($id,$name,$script,$language);
        }
    }
    if(isset($body['needUpdate'])){
        if($body['needUpdate']=="1"){
            $id=$body['codeId'];
            $script=$_POST['Script'];
            $language=$body['Language'];
            $db->updateSubmission($id,$script,$language);
        }
    }
    if(isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"]!=""){
        $filename=$_FILES["file"]["tmp_name"];
        $contents = readFileContents($filename);
    }
    $buttonUpload = "                    <label for=\"fileUpload\" class=\"btn btn-primary mr-5\">upload</label>
                    <input type=\"file\" name=\"file\" id=\"fileUpload\" hidden>";
    $saveAsButton = "                            <input type=\"button\" value=\"save as\" id=\"saveAsButton\" class=\"btn btn-primary\">
                            <label for=\"compilebutton\" id=\"saveButton\" class=\"btn btn-primary\">save</label>
                            <input type=\"text\" id=\"subname\" name=\"submissionName\" placeholder=\"enter submission name\">";
    $compileUpdateButton = "                            <label for=\"compilebutton\" id=\"updateButton\" class=\"btn btn-primary\">update</label>
                            <input type=\"hidden\" id=\"needUpdate\" name=\"needUpdate\" value=\"0\">
                            <input type=\"hidden\" name=\"scriptToUpdate\" value=\"1\">
                            <input type=\"hidden\" name=\"codeId\" value=\"{{codeId}}\">";

    $page = str_replace("{{output}}",isset($body['Output'])?$body['Output']:"",$page);
    $page = str_replace("{{input}}",isset($body['Input'])?$body['Input']:"",$page);
    $page = str_replace("{{ButtonUpload}}",isLoggedIn()?$buttonUpload:"",$page);
    $page = str_replace("{{Buttons}}",isLoggedIn()&&!isset($body['scriptToUpdate'])?$saveAsButton:"{{Buttons}}",$page);
    $page = str_replace("{{Buttons}}",isLoggedIn()&&isset($body['scriptToUpdate'])?$compileUpdateButton:"{{Buttons}}",$page);
    $page = str_replace("{{Buttons}}","",$page);
    $page = str_replace("{{codeId}}",isset($body['codeId'])?$body['codeId']:"",$page);
    $script="";
    if(isset($_SESSION['Script']) && $_SESSION['Script']!=""){
        $script = $_SESSION['Script'];
        unset($_SESSION['Script']);
    }
    else if(isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"]!=""){
        $script = $contents;
    }
    else {
        if (isset($_POST['Script'])) {
            if(isset($_POST['scriptToUpdate']) && !isset($_POST['needUpdate']))
                $_POST['Script']=htmlentities($_POST['Script']);
            $script =  $_POST['Script'];
        }
    }
    $page = str_replace("{{script}}",$script,$page);
    $page = str_replace("{{Check}}",isset($body['Language'])?"1":"0",$page);
    $page = str_replace("{{Language}}",isset($body['Language'])?$body['Language']:"",$page);
    $page = str_replace("{{Opt}}",isset($body['Language'])?$body['Language']:"0",$page);

    return $page;
}