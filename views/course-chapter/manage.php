<?php

/* @var $this yii\web\View */
/* @var $model \app\models\CourseChapter */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->title;
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
            Chapter <?= $model->order ?>: <?= Html::encode($this->title) ?>
            <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-right small" title="Go to next chapter"></i>', ['go-next-chapter', 'id' => $model->id]) ?>
        </p>
    </div>
</div>
