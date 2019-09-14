<?php

if(session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(!isset($_SESSION['language'])) {
  $myLang = null;
  $lang = isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])? $_SERVER["HTTP_ACCEPT_LANGUAGE"] : [];
  $langs = array();

  foreach(explode(',', $lang) as $entry) {
    $string = explode(';', $entry);
    switch(count($string)) {
      case 1:
        $langs[] = array($string[0], 1.0);
        break;
      case 2:
        $stringTwo = explode('=', $string[1]);
        $langs[] = array($string[0], floatval($stringTwo[1]));
        break;
    }
  }
  usort($langs, function($a, $b) {
    if($a[1]==$b[1]) {
      return 0;
    } elseif($a[1]>$b[1]) {
      return -1;
    }
    return 1;
  });
  foreach($langs as $lang) {
    if(isset($dictionary[$lang[0]])) {
      $myLang = $lang[0];
      break;
    }
  }
  $myLang = $myLang? $myLang : DEFAULT_LANGUAGE;
  $_SESSION['language'] = $myLang;
}

$language = $_SESSION['language'];
$file = __DIR__."/dictionary/{$language}/global.php";

if(!file_exists($file)) {
  $language = DEFAULT_LANGUAGE;
  $_SESSION['language'] = $language;
  $file = __DIR__."/dictionary/{$language}/global.php";
}

define('LANGUAGE', $language);
define('LANGUAGE_FILE', $file);

/**
 * Printa a string localizada
 *
 * @param string $string
 * @return string
 */
function __(string $string)
{
  if(!defined('LANGUAGE_DATA')) {
    $data = require_once LANGUAGE_FILE;
    define('LANGUAGE_DATA', $data);
  }
  if(!isset(LANGUAGE_DATA[$string])) {
    return $string;
  }
  if(!preg_match_all('/\:([a-zA-Z-_]+)/', $string, $matches)) {
    return LANGUAGE_DATA[$string];
  }
  $value = LANGUAGE_DATA[$string];
  foreach($matches[0] as $index => $match) {
    $replacement = isset(func_get_args()[$index+1])? func_get_args()[$index+1]: null;
    $value = str_replace($match, $replacement, $value);
  }
  return $value;
}

/**
 * Busca linguages disponíveis
 *
 * @return array
 */
function languages()
{
  $files = glob('dictionary/*/');
  foreach($files as &$data) {
    $data = include "{$data}/data.php";
  }
  return $files;
}