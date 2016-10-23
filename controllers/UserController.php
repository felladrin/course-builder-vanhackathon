<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        /** @var User $currentUser */
        $currentUser = Yii::$app->user->identity;
        return $this->render('index', [
            'model' => $currentUser,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate()
    {
        /** @var User $currentUser */
        $currentUser = Yii::$app->user->identity;
        $currentUser->scenario = 'update';
        if ($currentUser->load(Yii::$app->request->post()) && $currentUser->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $currentUser,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionDelete()
    {
        /** @var User $currentUser */
        $currentUser = Yii::$app->user->identity;
        Yii::$app->user->logout();
        $currentUser->delete();
        return $this->goHome();
    }
}
