<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>Loja</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="tudo">
            <div class="loginbar"> 
            <?php 
                session_start();
                if(isset($_SESSION['usuario']))
                {
                    $usuario = $_SESSION['usuario'];
                    echo("
                    <form method='post'>
                        <button name='reqlogin' value='deslogar' id='deslogar'>Deslogar</button>
                    </form>
                    <p class='welcome'>Welcome user, $usuario!</p>");
                }
                else
                {
                    include("loginbar.php");
                } 
            ?>
            </div>
            <div class="titulo">
                <p>Games 4 You</p>
            </div>
            <div id="navbar">
                <a style="margin-left: 1.1em;" href="?acao=home">Home</a>
                <a href="?acao=products">Products</a>
                <a href="?acao=contact">Contact</a>
                <a href="?acao=about">About</a> 
            </div>
        </div>
        <?php
            include("funcoes_db.php");
            $acao = "home";
            if(isset($_REQUEST['acao'])) 
            {
                $acao = $_REQUEST['acao'];          
            }
            switch ($acao) 
                {
                    case "home":
                        include("home.php");
                        break;
                    case "products":
                        include("products.php");
                        break;
                    case "contact":
                        include("contact.php");
                        break;
                    case "about":
                        include("about.php");
                        break;
                }
        ?>
        <div class="footer">
            <p>Site feito por mim > Elian Rodrigues</p>
        </div>
        <div id="janela">
            <button id="fim">Finalizar Compra<button>
        </div>
        <button name="cart" id="carrinho"><img src="cart.png" alt="cart"></button>
    </body>
    <script src="scripts.js" type="text/javascript"></script>
</html>

<?php
    if(isset($_REQUEST['reqlogin']))
    {
        if($_REQUEST['reqlogin'] == 'login')
        {
           $login = $_POST['login'];
           $senha = $_POST['senha'];
    
           $sql = "SELECT cliemail, clisenha from clientes where cliemail = '$login' and clisenha = '$senha'";
           $resultado = fazConsulta($sql);
           if($resultado[0]['cliemail'] == $login && $resultado[0]['clisenha'] == $senha)
           $_SESSION['usuario'] = $resultado[0]['cliemail'];
           else
           echo("Usuario ou Senha Invalidos!"); // trocar por um alert??
           header("Location: index.php");

        }

        if($_REQUEST['reqlogin'] == 'register')
        {
            $nome = $_POST['nome'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];
        
            $sql = "INSERT INTO clientes (clinome, cliemail, clisenha) VALUES ('$nome', '$login', '$senha')";
            $resultado = fazConsulta($sql);
        }

        if($_REQUEST['reqlogin'] == 'deslogar')
        {
            session_destroy();
            header("Location: index.php");
        }
    }
    
    
?>