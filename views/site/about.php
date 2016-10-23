<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is a simple course builder made during the VanHackathon of October 2016.<br/>
        <?= Yii::powered() ?>.
    </p>
</div>
