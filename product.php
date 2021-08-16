<div id="<?=$jogo['procodig']?>" class="produto">
<?php
    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario'] == "admin@admin.com"){
            echo("<button onclick='edit(this)'>edit</button>
            <button onclick='del(this)'>delete</button>");
        }
    }
?>
    <img src="<?=$jogo['img']?>" alt="<?=$jogo['pronome']?>">
    <p><?=$jogo['pronome']?></p>
    <h1>$<?=$jogo['propreco']?></h1>
    <button onclick="addcart(this)">Add to Cart</button>
    <input type="hidden" name="categ" value="<?=$jogo['procateg']?>">
</div>

<script>
function addcart(btn){
    let parent = btn.parentNode;
    const prod = parent.cloneNode(true)
    const conteudo = prod.children;
    const img = conteudo[0];
    const nome = conteudo[1];
    const preco = conteudo[2];
    const butao = document.createElement("button"); butao.innerHTML = "x";
    butao.addEventListener("click", function(){
        butao.parentElement.remove();
    })

    const div = document.createElement("div");
    div.className = "prodDest"
    div.id = parent.id;
    div.appendChild(img);
    div.appendChild(nome);
    div.appendChild(preco);
    div.appendChild(butao);
    const dest = document.getElementById("janela");
    dest.appendChild(div);
    console.log(conteudo);
}

function edit(btn){
    parent = btn.parentNode;
    name = parent.children[3].innerText;
    price = parent.children[4].innerText.substring(1);
    categ = parent.children[6].value;
    gameid = parent.id
    form = document.getElementById("editpop").children[2];
    nameinput = form.children[1];
    nameinput.setAttribute("value", name);
    categinput = form.children[4];
    categinput.setAttribute("value", categ);
    priceinput = form.children[7];
    priceinput.setAttribute("value", price);
    button = form.children[12];
    button.setAttribute("value", gameid);
    console.log(form.value);
    document.getElementById("editpop").classList.add("active");
}
function myJavascriptFunction() { 
  var javascriptVariable = "John";
  
}
function del(btn){
    parent = btn.parentNode;
    gameid = parent.id
    sure = document.getElementById("deletepop").children[1].children;
    sure[0].setAttribute("value", gameid);
    document.getElementById("deletepop").classList.add("active");
}
</script>