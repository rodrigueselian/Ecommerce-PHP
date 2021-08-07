<div id="<?=$jogo['procodig']?>" class="produto">
    <img src="<?=$jogo['img']?>" alt="<?=$jogo['pronome']?>">
    <p><?=$jogo['pronome']?></p>
    <h1>$<?=$jogo['propreco']?></h1>
    <button onclick="addcart(this)">Add to Cart</button>
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
</script>