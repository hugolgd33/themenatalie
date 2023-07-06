function menuBg() {
    const burger = document.getElementById("burger");
    const menu= document.getElementById("menu-container");
    const body = document.querySelector("body");
    var lignes = document.querySelectorAll(".ligne");
    var active =false;
    
    burger.onclick = () => {
        if(active){
            menu.style.animation = "fadeout 0.2s forwards";
            lignes.forEach (element => element.classList.remove("ligneO"));
            setTimeout(function() {
                menu.classList.add("close");
                active=false;
            }, 200);
            body.classList.remove("bodyMenuOpen");
            
        }
        else{
            lignes.forEach (element => element.classList.add("ligneO"));
            menu.style.animation = "fadein 0.5s forwards";
            menu.classList.remove("close");
            body.classList.add("bodyMenuOpen");
            active=true;
         
        };
};
}

function Popup(){
    const contactPopup =document.getElementById('popupContact');
    contactPopup.classList.remove('hidden');
}
function popupClose(){
    const contactPopup =document.getElementById('popupContact');
    contactPopup.classList.add('hidden');
}