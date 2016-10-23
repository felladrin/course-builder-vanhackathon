<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

/** @var \app\models\User $user */
$user = Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => Yii::$app->homeUrl],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'My Account', 'url' => ['/user/'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'My Courses', 'url' => ['/course/'], 'visible' => !Yii::$app->user->isGuest],
            //['label' => 'My Library', 'url' => ['/upload/'], 'visible' => !Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . $user->email . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
        <p class="pull-right">
            <?php
            $randomFooter = [
                '<a class="github-button" href="https://github.com/felladrin/course-builder-vanhackathon" data-icon="octicon-star" data-style="mega" data-count-href="/felladrin/course-builder-vanhackathon/stargazers" data-count-api="/repos/felladrin/course-builder-vanhackathon#stargazers_count" data-count-aria-label="# stargazers on GitHub" aria-label="Star felladrin/course-builder-vanhackathon on GitHub">Star</a>',
                '<a class="github-button" href="https://github.com/felladrin/course-builder-vanhackathon/fork" data-icon="octicon-repo-forked" data-style="mega" data-count-href="/felladrin/course-builder-vanhackathon/network" data-count-api="/repos/felladrin/course-builder-vanhackathon#forks_count" data-count-aria-label="# forks on GitHub" aria-label="Fork felladrin/course-builder-vanhackathon on GitHub">Fork</a>'
            ];
            echo $randomFooter[array_rand($randomFooter)];
            ?>
        </p>
    </div>
</footer>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
