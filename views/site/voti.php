<?php
/**
 * PAGINA "I MIEI VOTI"
 * 
 * Visualizza i mi piace che l'utente ha messo sui video
 */
use yii\grid\GridView;
use yii\helpers\Html;

/* var $this yii\web\View */
/* var $mi_piace app\models\MiPiace */

$this->title = Yii::t('app', 'I miei voti');
?>
<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        
        
        'id',
        [
            'attribute' => 'video_url',
            'label' => 'Video',
            'format' => 'raw',
            'value' => function ($model){
                return Html::a($model->titolo, 
                        ['site/video', 'id'=>$model->id],
                        ['target'=>'_blank']);
            },
        ],
        [
            'attribute' => 'compagnia_id',
            'label' => 'Compagnia',
            'format' => 'raw',
            'value' => function($model){
                return Html::a($model->compagnia->compagnia, 
                        ['site/compagnia', 'id' => $model->compagnia->id], 
                        ['target'=>'_blank']);
            },
        ],
        'mi_piace'
        
        //['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>