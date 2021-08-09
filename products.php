<?php
    $sql = "select * from categorias";
    $categorias = fazConsulta($sql);
?>
<div id="peg">
    <p class="categtext">Categories</p>
    <div id="searchbar">  
        <form>
            <label for="search">Search</label>
            <input name="search" id="search" type="text" onkeyup="showResult(this.value)">
        </form>
    </div>
    <div class="categ">
        <?php
            foreach($categorias as $link)
            {
                include("categorias.php");
            }
            if(isset($_SESSION['usuario']))
            {
                if($_SESSION['usuario'] == "admin@admin.com")
                {
                    echo("<button id='adc'>+</button>");
                }
            }
            if(isset($_REQUEST['add']))
            {
                $nome = $_REQUEST['nomec'];
                $sql = "insert into categorias (catdescr) values ('$nome')";
                $nada = fazConsulta($sql);
                header("Location: index.php?acao=products");
            }
        ?>
        <form method="post" id='addcateg'>
            <input type="text" name="nomec" placeholder="nome da categoria">
            <input type="submit" name='add'>
        </form>
        <script>
            document.getElementById("adc").addEventListener("click", function(){
                document.getElementById("addcateg").style.display = 'block';
            })
        </script>
    </div>
    
    <div id="contProd">
        <?php
            if(isset($_GET['categ']))
            {
                $categ = $_GET['categ'];
                $sql = "select * from produtos where procateg = '$categ'";
            }
            else
            $sql = "select * from produtos";
            $jogos = fazConsulta($sql);
            foreach($jogos as $jogo)
            {include("product.php");}


            if(isset($_SESSION['usuario']))
            {
                if($_SESSION['usuario'] == "admin@admin.com")
                {
                    echo("<button id='adp'>+</button>");
                }
            }

            if(isset($_REQUEST['addp']))
            {
                require_once('config_upload.php');
                $nome = $_REQUEST['nomep'];
                $cat = $_REQUEST['cat'];
                $preco = $_REQUEST['preco'];
                $nome_arquivo = $_FILES['image']['name'];  
                $tamanho_arquivo = $_FILES['image']['size']; 
                $arquivo_temporario = $_FILES['image']['tmp_name']; 
                if (!empty($nome_arquivo)){
                    if($sobrescrever=="não" && file_exists("$caminho/$nome_arquivo"))
                    die("Arquivo já existe");

                    if($limitar_tamanho=="sim" && ($tamanho_arquivo > $tamanho_bytes))  
                        die("Arquivo deve ter o no máximo $tamanho_bytes bytes");

                    $ext = strrchr($nome_arquivo,'.');
                    if (($limitar_ext == "sim") && !in_array($ext,$extensoes_validas))
                        die("Extensão de arquivo inválida para upload");

                    if (move_uploaded_file($arquivo_temporario, "uploads/$nome_arquivo")) {
                        echo " Upload do arquivo: ". $nome_arquivo." foi concluído com sucesso <br>";
                        $arquivo = 'uploads/' . $nome_arquivo;
                        $sql = "insert into produtos (pronome,procateg,propreco,img) values ('$nome','$cat','$preco','$arquivo')";
                        $resultado = fazConsulta($sql);
                    }
                }
                
            }     
        ?>
        <div id='addprod'>
            <img src="unknown.jpg" alt="naotem">
                <button id="closeAddProd">X</button>
                <form method="post" enctype="multipart/form-data">
                    Nome:<br/><input required type="text" name="nomep" placeholder="nome do jogo"><br>
                    Categoria:<br/><input required type="text" name="cat" placeholder="numero"><br>
                    Preço:<br/><input required type="text" name="preco" placeholder="decimal '11.2'"><br>
                    image:<br/><input type="file" name="image" id="image"><br>
                    <input type="submit" name='addp'>
                </form>
        </div>
        <script>
            
            document.getElementById("adp").addEventListener("click", function(){
                document.getElementById("addprod").style.display = 'flex';
            })
            document.getElementById("closeAddProd").addEventListener("click", function(){
                document.getElementById("addprod").style.display = 'none';
            })

            function showResult(str) {
                if (str.length==0) {
                    document.getElementById("livesearch").innerHTML="";
                    document.getElementById("livesearch").style.border="0px";
                    return;
                }
                
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                    document.getElementById("contProd").innerHTML=this.responseText;
                    document.getElementById("contProd").style.border="1px solid #A5ACB2";
                    }
                }
                xmlhttp.open("GET","result.php?q="+str,true);
                xmlhttp.send();
            }
        </script>
    </div>
</div>

