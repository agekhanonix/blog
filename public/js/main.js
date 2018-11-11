/* =========================================================== **
*       PRINCIPAL FUNCTIONS OF THE APPLICATION                  *
** =========================================================== */
/* Author    : Thierry CHARPENTIER                              *
*  Date      : 05.09.2018                                       *
*  Version   : V1R0                                             *
* ============================================================ */
window.addEventListener("load", function() {
    var node = document.querySelector("[data-loading]");
    node.setAttribute("data-loading", "complete");
});
window.onload = preloader;
var show_per_page = 3;
var current_page = 0;
function set_display(first, last) {
    $('#voltaire').children().css('display', 'none');
    $('#voltaire').children().slice(first, last).css('display', 'block');
}
function previous() {
    if($('.active').prev('.page_link').length) go_to_page(current_page - 1);
}
function next() {
    if($('.active').next('.page_link').length) go_to_page(current_page + 1);
}
function go_to_page(page_num) {
    current_page = page_num;
    start_from = current_page * show_per_page;
    end_on = start_from + show_per_page;
    set_display(start_from, end_on);
    $('.active').removeClass('active');
    $('#id' + page_num).addClass('active');
}
$(document).ready(function(){
    var number_of_pages = Math.ceil($('#voltaire').children().length / show_per_page);
    var nav = '<ul class="pagination pagination-sm"><li><a href="javascript:previous();"><span class="glyphicon glyphicon-backward btn-icon"></span>Precedent</a>';
    var i = -1;
    while(number_of_pages > ++i) {
        nav += '<li class="page_link'
        if(!i) nav += ' active';
        nav += '" id="id' + i + '">';
        nav += '<a href="javascript:go_to_page(' + i + ')">' + (i+1) + '</a>';
    }
    nav += '<li><a href="javascript:next();">Suivant<span class="glyphicon glyphicon-forward btn-icon"></span></a></li></ul>';
    $('#page_navigation').html(nav);
    set_display(0, show_per_page);
});
function preloader(){
    document.getElementById("loading").style.display = "none";
    document.getElementById("slideshow").style.visibility = "visible";
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
    tabs = document.querySelectorAll('.tabs-voltaire');
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