<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\Video;

class VotazioniController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(){
        if(!Yii::$app->user->can('Super User')){
            return $this->goHome();
        }
        
        $this->layout = 'admin';
        
        //$video = new Video();
        $dataProvider = new ArrayDataProvider([
            'allModels' => Video::getAllMiPiace(),
            
            'sort' => [
                'attributes' => ['mi_piace', 'compagnia_id'],
            ],
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
