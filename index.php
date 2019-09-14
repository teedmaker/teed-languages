<?php
define('DEFAULT_LANGUAGE', 'pt-BR');
require_once "language.php";
?>
<!DOCTYPE html>
<html lang="<?php echo str_replace('-','_', LANGUAGE); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo __('Bem vindo!'); ?></title>
</head>
<body>

  <h1><?php echo __('Bem vindo :nome', 'visitante'); ?>!</h1>
  <h3><?php echo __('Dê um pull-request'); ?>.</h3>

  <br><hr>

  <p>
    <?php echo __('Outras linguages disponíveis:'); ?>
  </p>

  <ul>
    <?php
      foreach(languages() as $language => $info) {
        echo "<li>".
                "<a href=\"change.php?lang={$info['slug']}\">{$info['nome']}</a>".
              "</li>";
      }
    ?>
  </ul>
  
</body>
</html>