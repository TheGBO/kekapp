var toglado = false;
var menuconfig = document.getElementById("profile-settings");
var menuposts = document.getElementById("profile-posts");
var engrenagem = document.getElementById("engrenagem");
var seta = document.getElementById("seta");
menuconfig.style.display = "none";

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function mostrar(){
    if(!toglado){
        
        menuconfig.style.display = "block";
        engrenagem.style.animation = 'spin linear 0.5s';
        toglado = true;
        return
    }else{
        menuconfig.style.display = "none";
        engrenagem.style.animation = 'spin2 linear 0.5s';
        toglado = false;
        return
    }

}

function mostrar2(){
    if(!toglado){
        
        menuposts.style.display = "block";
        seta.style.animation = 'spin linear 0.1s';
        toglado = true;
        return
    }else{
        menuposts.style.display = "none";
        seta.style.animation = 'spin2 linear 0.1s';
        toglado = false;
        return
    }

}