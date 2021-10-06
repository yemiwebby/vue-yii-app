<?php

/* @var $this \yii\\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Html;

AppAsset::register($this);
?>
<?php
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    $this->registerCsrfMetaTags() ?>
    <title>Vue Library App</title>
    <?php
    $this->head() ?>
</head>
<body>
<?php
$this->beginBody() ?>
<div id="app">

</div>
<?php
$this->endBody() ?>
</body>
</html>
<?php
$this->endPage() ?>
