var bar = document.getElementById('navbar').children;
var local = window.location.hash;
var num = 0;

var swit = 0;

function x(btn){
    let dad = btn.parentNode;
    if (dad.classList.contains('active')) {
        dad.classList.remove('active');
    } else {
        dad.parentNode.classList.remove('active');
    }
}

function addp(){
    document.getElementById("addprod").classList.add("active");
}

//arruma isso depois pelo amor de deus aehuehuueha
document.getElementById("carrinho").addEventListener("click", function(){
    if(swit === 1)
    {
        document.getElementById("janela").style.display = 'none';
        swit = 0;
    }
    else
    {
        document.getElementById("janela").style.display = 'flex';
        swit = 1;
    }
});
//Login
document.getElementById("login").addEventListener("click", function(){
    document.getElementById("loginpop").classList.add("active");
    document.getElementById("registerpop").classList.remove("active");
});
document.getElementById("x").addEventListener("click", function(){
    document.getElementById("loginpop").classList.remove("active");
});

//Register
document.getElementById("register").addEventListener("click", function(){
    document.getElementById("registerpop").classList.add("active");
    document.getElementById("loginpop").classList.remove("active");
});
document.getElementById("x2").addEventListener("click", function(){
    document.getElementById("registerpop").classList.remove("active");
});


document.getElementById("addcategory").addEventListener("click", function(){
   const categ = document.getElementById("inputcat").value;
})


