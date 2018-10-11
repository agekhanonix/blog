/* =========================================================== **
*       management of the posting of the chapters               *
** =========================================================== */
/* Author    : Thierry CHARPENTIER                              *
*  Date      : 11.10.2018                                       *
*  Version   : V1R0                                             *
* ============================================================ */
var showPerPage = 1;
var currentPage = 0;
var numberOfPages = 0;
function setDisplay(first, last) {
    $('#chapter').children().css('display', 'none');
    $('#chapter').children().slice(first, last).css('display', 'block');
}
function showPrevious() {
    if(currentPage >= 0) showChapter(currentPage -1);
}
function showNext() {
    if(currentPage <= numberOfPages -3) showChapter(currentPage +1);
}
function showChapter(pageNum) {
    currentPage = pageNum;
    startFrom = currentPage + showPerPage;
    endOn = startFrom + showPerPage;
    setDisplay(startFrom, endOn);
    $('.active').removeClass('active');
    $('#id' + pageNum).addClass('active');
}
$(document).ready(function(){
    numberOfPages = Math.ceil($('#chapter').children().length / showPerPage);
    var nav = '<ul class="pager"><li><a href="javascript:showPrevious();"><span class="glyphicon glyphicon-backward btn-icon"></span>Precedent</a></li>';
    var i = -1;
    while(numberOfPages > ++i) {
        nav += '<li class="page_link'
        if(!i) nav += ' active';
        nav += '" id="id' + (i) + '">';
        nav += '<a href="javascript:showChapter(' + (i-1) + ');">' + (i+1) + '</a></li>';
    }
    nav += '<li><a href="javascript:showNext();">Suivant<span class="glyphicon glyphicon-forward btn-icon"></span></a></li></ul>';
    $('#tabs-chapter').html(nav);
    setDisplay(0, showPerPage);
});