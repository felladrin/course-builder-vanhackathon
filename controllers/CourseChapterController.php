<?php

namespace app\controllers;

use app\models\CourseChapterContent;
use Yii;
use app\models\CourseChapter;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseChapterController implements the CRUD actions for CourseChapter model.
 */
class CourseChapterController extends Controller
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
     * Lists all CourseChapter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CourseChapter::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CourseChapter model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new CourseChapter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $course_id
     * @return mixed
     */
    public function actionCreate($course_id)
    {
        $model = new CourseChapter();

        if ($model->load(Yii::$app->request->post())) {
            $model->course_id = $course_id;
            $model->order = CourseChapter::find()->where(['course_id' => $course_id])->count() + 1;

            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CourseChapter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['course/manage-content', 'id' => $model->course_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CourseChapter model.
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
     * Finds the CourseChapter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CourseChapter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CourseChapter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMoveUp($id)
    {
        $model = $this->findModel($id);
        $previousModel = CourseChapter::findByCourseOrder($model->course_id, ($model->order - 1));
        if ($previousModel) {
            $previousModel->moveDown();
            $model->moveUp();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMoveDown($id)
    {
        $model = $this->findModel($id);
        $nextModel = CourseChapter::findByCourseOrder($model->course_id, ($model->order + 1));
        if ($nextModel) {
            $nextModel->moveUp();
            $model->moveDown();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionManage($id)
    {
        return $this->render('manage', [
            'model' => $this->findModel($id),
            'courseChapterContentModel' => new CourseChapterContent()
        ]);
    }

    public function actionGoPreviousChapter($id)
    {
        $model = $this->findModel($id);
        $previousModel = CourseChapter::findByCourseOrder($model->course_id, ($model->order - 1));
        if ($previousModel) {
            if (strpos(Yii::$app->request->referrer, 'manage') !== false) {
                return $this->redirect(['manage', 'id' => $previousModel->id]);
            }
            else {
                return $this->redirect(['view', 'id' => $previousModel->id]);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionGoNextChapter($id)
    {
        $model = $this->findModel($id);
        $nextModel = CourseChapter::findByCourseOrder($model->course_id, ($model->order + 1));
        if ($nextModel) {
            if (strpos(Yii::$app->request->referrer, 'manage') !== false) {
                return $this->redirect(['manage', 'id' => $nextModel->id]);}
            else {
                return $this->redirect(['view', 'id' => $nextModel->id]);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
