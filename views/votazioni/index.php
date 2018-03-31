<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Votazioni');
?>
<h1><?= $this->title ?></h1>



<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        
        'id',
        'mi_piace',
        [
            'attribute' => 'video_url',
            'label' => 'Video',
            'format' => 'raw',
            'value' => function ($model){
                return Html::a($model->titolo, ['site/video', 'id'=>$model->id]);
            },
        ],
        [
            'attribute' => 'compagnia_id',
            'label' => 'Compagnia',
            'format' => 'raw',
            'value' => function ($model){
                return Html::a($model->compagnia->compagnia, ['site/compagnia', 'id'=>$model->compagnia->id]);
            },
        ],
    ],
]);
?>