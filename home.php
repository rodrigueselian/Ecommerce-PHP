<div class="home">
    <h2>Featured</h2>
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

