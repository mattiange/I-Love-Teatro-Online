<?php 
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

NavBar::begin([
    'options' => [
        'class' => 'navbar navbar-inverse f-left',
        'id' => 'admin-menu'
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        [
            'label' => Yii::t('app', 'Home'),
            'url' => ['categoria/index'],
            //'items' => $categories,
        ],
        Yii::$app->user->isGuest ? '' : (
                ['label' => 'I miei voti', 'url' => ['site/administrator']]
        ),
        Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->nome . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ],
]);
NavBar::end();