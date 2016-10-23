<?php

namespace app\controllers;

use Yii;
use app\models\CourseChapterContent;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseChapterContentController implements the CRUD actions for CourseChapterContent model.
 */
class CourseChapterContentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CourseChapterContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CourseChapterContent::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CourseChapterContent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CourseChapterContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $course_chapter_id
     * @return mixed
     */
    public function actionCreate($course_chapter_id)
    {
        $model = new CourseChapterContent();

        if ($model->load(Yii::$app->request->post())) {
            $model->course_chapter_id = $course_chapter_id;
            $model->order = CourseChapterContent::find()->where(['course_chapter_id' => $course_chapter_id])->count() + 1;

            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CourseChapterContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['course-chapter/manage', 'id' => $model->course_chapter_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CourseChapterContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the CourseChapterContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CourseChapterContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CourseChapterContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMoveUp($id) {
        $model = $this->findModel($id);
        $previousModel = CourseChapterContent::findByChapterOrder($model->course_chapter_id, ($model->order - 1));
        if ($previousModel) {
            $previousModel->moveDown();
            $model->moveUp();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMoveDown($id) {
        $model = $this->findModel($id);
        $nextModel = CourseChapterContent::findByChapterOrder($model->course_chapter_id, ($model->order + 1));
        if ($nextModel) {
            $nextModel->moveUp();
            $model->moveDown();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
