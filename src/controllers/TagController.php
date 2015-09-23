<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;
use yii\web\BadRequestHttpException,
    yii\web\NotFoundHttpException;
use jlorente\tagable\db\Tag;

/**
 * TagController implements the CRUD actions for Tag model.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class TagController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'view', 'delete', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ]
        ];
    }

    /**
     * Renders the create form for the model.
     * 
     * @return \yii\web\Response
     */
    public function actionCreate() {
        $model = $this->findModel();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * 
     * @return \yii\web\Response
     */
    public function actionView($id) {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * 
     * @return \yii\web\Response
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * 
     * @return \yii\web\Response
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if ($model->delete()) {
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    /**
     * Method that allows only ajax requests.
     * 
     * @throws BadRequestHttpException
     */
    public function filterAjaxRequest() {
        if (Yii::$app->request->isAjax === false) {
            throw new BadRequestHttpException();
        }
    }

    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer $id
     * @return \yii\base\Model the loaded model
     * @throws \yii\web\NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Renders the grid view with all the platform Tag objects.
     * 
     * @return \yii\web\Response
     */
    public function actionIndex() {
        return $this->render('index');
    }

}
