<?php
    $sql = "select * from categorias";
    $categorias = fazConsulta($sql);
?>
<div id="peg">
    <p class="categtext">Categories</p>
    <div id="searchbar">
        <p>Search</p>
        <form>
            <input type="text" onkeyup="showResult(this.value)">
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
                $nome = $_REQUEST['nomep'];
                $cat = $_REQUEST['cat'];
                $preco = $_REQUEST['preco'];
                $img = "uploads/";
                $img .= $_REQUEST['img'];
                $sql = "insert into produtos (pronome,procateg,propreco,img) values ('$nome','$cat','$preco','$img')";
                $nada = fazConsulta($sql);
            }     
        ?>
        <div id='addprod'>
            <img src="unknown.jpg" alt="naotem">
                <button id="closeAddProd">X</button>
                <form method="post">
                    Nome:<br/><input required type="text" name="nomep" placeholder="nome do jogo"><br>
                    Categoria:<br/><input required type="text" name="cat" placeholder="numero"><br>
                    Preço:<br/><input required type="text" name="preco" placeholder="decimal '11.2'"><br>
                    Img:<br/><input required type="text" name="img" placeholder="nome img no dir"><br>
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

