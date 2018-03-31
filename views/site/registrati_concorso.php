<?php
$this->title = 'Registrati';
?>

<?= $this->render('_concorrente', [
    'compagnie' => $compagnie,
    'utenti' => $utenti,
    'auth' => $auth,
]) ?>