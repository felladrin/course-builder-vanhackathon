<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CourseChapterContent */

$this->title = 'Update Course Chapter Content';
$this->params['breadcrumbs'][] = ['label' => $model->courseChapter->course->name, 'url' => ['course/manage-content', 'id' => $model->courseChapter->course->id]];
$this->params['breadcrumbs'][] = ['label' => 'Chapter ' . $model->course_chapter_id, 'url' => ['course-chapter/manage', 'id' => $model->course_chapter_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-chapter-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="course-chapter-content-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ]) ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder' => '(Optional)'])->label('URL from Youtube') ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
