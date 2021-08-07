<?php
    include('funcoes_db.php');
    $search = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "select * from produtos where upper(pronome) like upper('%";
    $final = "%')";
    $readysql = $sql . $search . $final;
    $jogos = fazConsulta($readysql);
    if ($jogos) {
        foreach($jogos as $jogo)
        {include("product.php");}
    }
    else {
        echo"<div></div><h3>no results found</h3>";
    }
?>
