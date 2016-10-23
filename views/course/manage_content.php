<?php

/* @var $this yii\web\View */
/* @var $model \app\models\Course */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->title = $model->name;
//$this->params['breadcrumbs'][] = $this->title;

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
        <h2><?= Html::encode($this->title) ?></h2>
        <p class="lead"><?= Html::encode($model->description) ?></p>
    </div>

    <div class="well">
        <h2>Course Chapters</h2>

        <?php if (count($model->courseChapters) == 0): ?>
            <p>You haven't added any chapters to this course yet.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <tr>
                    <th>Order</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($model->getCourseChapters()->orderBy('order')->all() as $chapter): ?>
                    <tr>
                        <td class="shrink">#<?= $chapter->order ?></td>
                        <td class="expand"><?= $chapter->title ?></td>
                        <td class="shrink">
                            <?= Html::a('<i class="glyphicon glyphicon-arrow-up" title="Move Up"></i>', ['course-chapter/move-up', 'id' => $chapter->id]) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-arrow-down" title="Move Down"></i>', ['course-chapter/move-down', 'id' => $chapter->id]) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-edit" title="Rename"></i>', ['course-chapter/update', 'id' => $chapter->id]) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-trash" title="Delete"></i>', ['course-chapter/delete', 'id' => $chapter->id], ['data' => ['confirm' => 'Are you sure you want to delete this chapter?', 'method' => 'post']]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <?php $form = ActiveForm::begin(['action' => ['course-chapter/create', 'course_id' => $model->id]]); ?>
        <?= $form->field(new \app\models\CourseChapter(), 'title')->textInput(['maxlength' => true, 'placeholder' => 'Type a name and press enter!'])->label('Add Course Chapter:') ?>
        <?php ActiveForm::end(); ?>
    </div>

    <?php
    /*
    ListView::widget([
        'dataProvider' => $listDataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}\n{summary}",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_list_item',['model' => $model]);

            // or just do some echo
            // return $model->title . ' posted by ' . $model->author;
        },
        'itemOptions' => [
            'tag' => false,
        ],
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'nextPageLabel' => 'next',
            'prevPageLabel' => 'previous',
            'maxButtonCount' => 3,
        ],
    ]);
    */
    ?>
</div>
