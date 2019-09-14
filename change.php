<?php

session_start();

$lang = isset($_GET['lang'])? $_GET['lang']: null;
$lang = htmlentities($lang, ENT_QUOTES, 'UTF-8');
$dir  = __DIR__."/dictionary/{$lang}/";

if(!isset($_GET['lang']) or !is_dir($dir)) {
  header('Location: index.php');
  exit;
}

$_SESSION['language'] = $lang;
header('Location: index.php');
