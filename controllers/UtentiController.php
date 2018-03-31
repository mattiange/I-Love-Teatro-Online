<?php

namespace app\controllers;

use Yii;
use app\models\Utenti;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtentiController implements the CRUD actions for Utenti model.
 */
class UtentiController extends Controller
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
     * Lists all Utenti models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('Super User')){
            $this->layout = 'admin';
        }
        
        if(!Yii::$app->user->can('Super User') || Yii::$app->user->isGuest){
            $this->goHome();
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => Utenti::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Utenti model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        if(Yii::$app->user->can('Super User')){
            $this->layout = 'admin';
        }
        
        if(Yii::$app->user->can('User') || Yii::$app->user->isGuest){
            $this->goHome();
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Utenti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('Super User')){
            $this->layout = 'admin';
        }
        
        if(!Yii::$app->user->can('Super User') || Yii::$app->user->isGuest){
            $this->goHome();
        }
        
        $model = new Utenti();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Utenti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {        
        if(Yii::$app->user->can('Super User')){
            $this->layout = 'admin';
        }
        
        if(Yii::$app->user->can('User') || Yii::$app->user->isGuest){
            $this->goHome();
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Utenti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Utenti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Utenti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Utenti::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
