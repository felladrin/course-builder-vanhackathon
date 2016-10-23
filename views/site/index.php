<?php

/* @var $this yii\web\View */
/* @var $latestCourses \app\models\Course[] */

use yii\bootstrap\Html;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>
        <p class="lead">The right place to build your own course and share with the world!</p>
        <?php if (Yii::$app->user->isGuest): ?>
            <p><?= Html::a('Sign Up', ['login'], ['class' => 'btn btn-success']) ?></p>
        <?php endif; ?>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach ($latestCourses as $course): ?>
                <?php $idOfFirstChapter = $course->getIdOfFirstChapter(); ?>
                <?php if (empty($idOfFirstChapter)) continue; ?>
                <div class="col-lg-4">
                    <?= Html::beginTag('a', ['href' => \yii\helpers\Url::to(['course-chapter/view', 'id' => $idOfFirstChapter]), 'style' => 'text-decoration: none; color: #333;', 'title' => 'Click to know more about this course!']) ?>
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="glyphicon glyphicon-new-window pull-right"></i> <?= $course->name ?></div>
                            <div class="panel-body"><?= (strlen($course->description) > 200) ? substr($course->description, 0, 200) . '...' : $course->description ?></div>
                        </div>
                    <?= Html::endTag('a') ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
