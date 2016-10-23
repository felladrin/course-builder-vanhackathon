<?php

/* @var $this yii\web\View */
/* @var $model \app\models\CourseChapter */
/* @var $courseChapterContentModel \app\models\CourseChapterContent */

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Chapter ' . $model->order;

$this->registerCss("
table td.shrink {
    white-space:nowrap
}
table td.expand {
    width: 99%
}
.video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px; height: 0; overflow: hidden;
}
.video-container iframe,
.video-container object,
.video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
");
?>
<div class="manage-content">
    <div class="jumbotron well">
        <h2><?= Html::encode($model->course->name) ?></h2>
        <p class="lead">
            <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-left small" title="Go to previous chapter"></i>', ['go-previous-chapter', 'id' => $model->id]) ?>
            Chapter <?= $model->order ?>
            <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-right small" title="Go to next chapter"></i>', ['go-next-chapter', 'id' => $model->id]) ?>
            <br/>
            <?= Html::encode($model->title) ?>
        </p>
    </div>

    <?php foreach ($model->getCourseChapterContents()->orderBy('order')->all() as $courseChapterContent): ?>
        <div class="well">
            <h3><?= $courseChapterContent->title ?></h3>
            <div><?= $courseChapterContent->content ?></div>
            <?php $youtubeUrl = \app\models\CourseChapterContent::getYoutubeIdFromUrl($courseChapterContent->url); ?>
            <?php if (!empty($youtubeUrl)): ?>
            <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $youtubeUrl ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <?php endif;
            ?>
        </div>
    <?php endforeach; ?>
</div>
