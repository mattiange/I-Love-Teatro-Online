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
            'url' => ['site/index'],
        ],
        [
            'label' => Yii::t('app', 'Utenti Iscritti'),
            'url' => ['utenti/index'],
        ],
        [
            'label' => Yii::t('app', 'Compagnie iscritte'),
            'url' => ['compagnie/index'],
        ],
        [
            'label' => Yii::t('app', 'Votazioni dei video'),
            'url' => ['votazioni/index'],
        ],
        [
            'label' => Yii::t('app', 'Gestione dei permessi'),
            'url' => ['auth-assignment/index'],
        ],
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