<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Utenti;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Compagnies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compagnie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Compagnie'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'compagnia',
            'indirizzo',
            'telefono',
            'cellulare',
            'email:email',
            //'utente_id',
            [
                'label' => 'Utente',
                'attribute' => 'utente_id',
                'value' => function($model, $index, $dataColumn){
                    $utente = Utenti::findByID($model->utente_id);
                    
                    return $utente->nome." ".$utente->cognome;
                }
            ],
            // 'authkey',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
