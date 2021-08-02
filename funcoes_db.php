<?php
function fazconexao(){
    $stringDeConexao = 'pgsql:host=localhost;dbname=shop;';
    $usuario = 'postgres';
    $senha = 'senha5';
    try{
        $link = new PDO($stringDeConexao,$usuario,$senha,
            array(
                PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_PERSISTENT => false
            )
        );
        return($link);
        } 
    catch(PDOException $e){
        die($e->getMessage());
    }

}

//E0: string de consulta SQL
//S: vetor de vetores associativos contendo os registros
//    ou objeto de exceção contendo mensagem de erro e código do erro
function fazConsulta($sql){
    try {
        //conecta
        $conexaoBD = fazConexao();
        //cria o objeto de consulta
        $consulta = $conexaoBD->prepare($sql);
        //executa a consulta
        $consulta->execute();
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return($resultados);
    }
    catch (PDOException $e) {
        return($e);
    }
}

//consulta protegida contra INJECTION
//E0: string de consulta SQL
//S: vetor de vetores associativos contendo os registros
//    ou objeto de exceção contendo mensagem de erro e código do erro
function fazConsultaSegura($sql,$parametros=array(),&$id=-1){
    try {
          //conecta
        $conexaoBD = fazConexao();
        //cria o objeto de consulta
        $consulta = $conexaoBD->prepare($sql);
        //testa se foram passados parâmetros
        
        if (count($parametros) > 0) { 
            for($i=0;$i<count($parametros); $i++){
                $consulta->bindParam($i+1,$parametros[$i]);
               // echo($i+1 . $parametros[$i]);
            }
           
        }
    //   echo("<pre>");   
      //   $consulta->debugDumpParams();
        //executa a consulta
        $consulta->execute();
        
        //descobre se foi pedido o retorno do último id de autonumeração
        if ($id == 0) {
            $id = $conexaoBD->lastInsertId();
        }

        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return($resultados);
    }
    catch (PDOException $e) {
        return($e);
    }
}

?>