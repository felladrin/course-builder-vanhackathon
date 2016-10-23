<?php

/* @var $this yii\web\View */
/* @var $model \app\models\CourseChapter */
/* @var $courseChapterContentModel \app\models\CourseChapterContent */

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
        </div>
    <?php endforeach; ?>

    <div class="course-chapter-content-form well">
        <h2>Add Content</h2>

        <?php $form = ActiveForm::begin(['action' => ['course-chapter-content/create', 'course_chapter_id' => $model->id]]); ?>
        <?= $form->field($courseChapterContentModel, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($courseChapterContentModel, 'content')->textarea(['rows' => 6]) ?>
        <?= $form->field($courseChapterContentModel, 'url')->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <?= Html::submitButton('Add Content', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
