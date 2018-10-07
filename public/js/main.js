/* =========================================================== **
*       PRINCIPAL FUNCTIONS OF THE APPLICATION                  *
** =========================================================== */
/* Author    : Thierry CHARPENTIER                              *
*  Date      : 05.09.2018                                       *
*  Version   : V1R0                                             *
*
* JCD key    : 4b79668fa4a9e9f38c23f98a1a79d20d527a623c         *
*            : 7f305f4a66773eaaf355b25eb583029d707b8585         *
* Google key : AIzaSyCXB6yLq41R_CSfl2saDa1pqqOutPwVNnI          *
* TinyMCE    : 732xqa5s3ytb1ije9kwlfubjipvhexfw4fqwfgvoy05ckpee *
* ============================================================ */
window.onload = preloader;

function preloader(){
    document.getElementById("loading").style.display = "none";
    document.getElementById("slideshow").style.visibility = "visible";
    document.getElementById("slogan").style.visibility = "visible";
    document.getElementById("preload").style.visibility = "visible";
    initCarrousel();
    validComment();
}
/* ---        CARROUSEL INITIALISATION             --- */
function initCarrousel(auto=true) {
    var cID = 'slideshow';                             // Id of the container
    var slider = new Carrousel(cID);                   // The carrousel instanciation

    var interval = 15000;                              // Time interval setting to 15" between two images
    (auto === false) ? slider.next() : slider.next(interval); // Carrousel initialisation
}
function validComment() {
    tabs = document.querySelectorAll('.tabs-content');
    for(var i=0; i<tabs.length; i++){
        tabs[i].style.display = (i>0) ? 'none' : 'block';
        elMt = document.getElementById('tab-container' + (i+1));
        elMt.addEventListener('click', function(e){
            var elMenu = e.target.id;
            for(var j=0; j<tabs.length; j++) {
                tabs[j].style.display = 'none';
            }
            elTab = document.getElementById('tab-content' + elMenu.substring(elMenu.length -1, elMenu.length));
            elTab.style.display = 'block';
        });
    }
}