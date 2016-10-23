<?php

/* @var $this yii\web\View */
/* @var $model \app\models\CourseChapter */
/* @var $courseChapterContentModel \app\models\CourseChapterContent */

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Chapter ' . $model->order;
$this->params['breadcrumbs'][] = ['label' => 'My Courses', 'url' => ['course/index']];
$this->params['breadcrumbs'][] = ['label' => $model->course->name, 'url' => ['course/manage-content', 'id' => $model->course_id]];
$this->params['breadcrumbs'][] = $this->title;

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
            <div class="pull-right">
                <?= Html::a('<i class="glyphicon glyphicon-arrow-up" title="Move Up"></i>', ['course-chapter-content/move-up', 'id' => $courseChapterContent->id]) ?>
                <?= Html::a('<i class="glyphicon glyphicon-arrow-down" title="Move Down"></i>', ['course-chapter-content/move-down', 'id' => $courseChapterContent->id]) ?>
                <?= Html::a('<i class="glyphicon glyphicon-edit" title="Rename"></i>', ['course-chapter-content/update', 'id' => $courseChapterContent->id]) ?>
                <?= Html::a('<i class="glyphicon glyphicon-trash" title="Delete"></i>', ['course-chapter-content/delete', 'id' => $courseChapterContent->id], ['data' => ['confirm' => 'Are you sure you want to delete this content?', 'method' => 'post']]) ?>
            </div>
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

    <div class="course-chapter-content-form well">
        <h2>Add Content</h2>

        <?php $form = ActiveForm::begin(['action' => ['course-chapter-content/create', 'course_chapter_id' => $model->id]]); ?>
        <?= $form->field($courseChapterContentModel, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($courseChapterContentModel, 'content')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ]) ?>
        <?= $form->field($courseChapterContentModel, 'url')->textInput(['maxlength' => true, 'placeholder' => '(Opcional)'])->label('URL from Youtube') ?>
        <div class="form-group">
            <?= Html::submitButton('Add Content', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
