<?php
$this->title = 'Registrati';
?>

<?= $this->render('_votante', [
    'compagnie' => $compagnie,
    'utenti' => $utenti,
    'auth' => $auth,
]) ?>