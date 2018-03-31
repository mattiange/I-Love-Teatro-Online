<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\Video;
use app\models\UploadForm;
use app\models\Compagnie;
use app\models\TinyUrl;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller
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
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('Super User')){
            $this->layout = 'admin';
        }
        
        if(Yii::$app->user->isGuest){
            $this->goHome();
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find(),
        ]);
        
        
        $video = new Video();
        $compagnia = Compagnie::findByUtenteId(Yii::$app->user->id);
                
        if(Yii::$app->user->can('Video Publisher')){
            $model = new UploadForm();
            
            if ($model->load(Yii::$app->request->post())) {
                echo "SI";
                $model->file = UploadedFile::getInstance($model, 'file');
                
                $filename = $model->generateFilename();
                
                $video->video_url = $filename.".".$model->file->extension;
                $video->compagnia_id = $compagnia->id;
                $video->type = $model->file->type;
                $video->data_pubblicazione = date('Y-m-d H:i:s');
                $video->titolo = $model->titolo;
                $video->visite = 0;
                $video->mi_piace = 0;
                
                $model->file->name = $filename.".".$model->file->extension;
                
                if ($model->upload()) {
                    $video->save();
                    
                    $tinyUrl = new TinyUrl();
                    
                    $tinyUrl->url   = Yii::$app->getRequest()->serverName."/".Url::current();
                    $tinyUrl->short = TinyUrl::createUrl();
                    
                    $tinyUrl->save();
                }
            }
            
            $video = Video::find()->where(['compagnia_id' => $compagnia->id])->count();
            if($video==0){
                return $this->render('upload', ['model' => $model]);
            } else {
                return $this->render('video', ['model' => $video]);
            }
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
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
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Video();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Video model.
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
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
