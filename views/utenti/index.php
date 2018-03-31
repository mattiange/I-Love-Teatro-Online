<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Utentis');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utenti-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Utenti'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'cognome',
            'email:email',
            'password',
            // 'indirizzo',
            // 'telefono',
            // 'authkey',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
