<div class="home">
    <h1>Featured</h1>
    <div class="container">
    <?php
        $sql = "select * from produtos order by procodig desc limit 3";
        $destaques = fazConsulta($sql);
        foreach($destaques as $destaque)
        {
            include("destaque.php");
        }
    ?>
    </div>  
</div>

