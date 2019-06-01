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