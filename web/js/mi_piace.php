<?php
$mysqli = new mysqli("89.46.111.61", "Sql1190742", "05fx820v0l", "Sql1190742_2");

$table_prefix = "concorso_";
$idv = $_POST['idv'];
$idu = $_POST['idu'];

//Seleziono la tabella "mi_piace" per vedere se l'utente lo ha già messo
$query = "SELECT * FROM ".$table_prefix."mi_piace WHERE video_id=".$idv." AND utente_id=".$idu;
$result = $mysqli->query($query);

//Seleziono il numero di mi piace del video selezionato dall'utente
$query = "SELECT * FROM ".$table_prefix."video WHERE id=".$idv;
$result_like = $mysqli->query($query);
$like = $result_like->fetch_assoc();

if($result->num_rows==0){//Aggiungo il mi piace
    $query = "INSERT INTO ".$table_prefix."mi_piace (utente_id, video_id) VALUE ({$idu}, {$idv})";
    
    if($mysqli->query($query)){
        $like['mi_piace'] ++;
    }else{
        echo json_encode("false");
    }
}else{
    $delete = "DELETE FROM ".$table_prefix."mi_piace WHERE utente_id={$idu} AND video_id = {$idv}";
    if(!$mysqli->query($delete)){
        echo json_encode("false");
    }
    
    $like['mi_piace'] --;
}

//AGGIORNO il valore del mi piace
$update = "UPDATE ".$table_prefix."video SET mi_piace = {$like['mi_piace']} WHERE id={$idv}";
if($mysqli->query($update)){
    echo json_encode($like['mi_piace']); 
}else{
    echo json_encode("false");
}