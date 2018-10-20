/* =========================================================== **
*       management of the posting of the chapters               *
** =========================================================== */
/* Author    : Thierry CHARPENTIER                              *
*  Date      : 11.10.2018                                       *
*  Version   : V1R0                                             *
* ============================================================ */
var showPerPage = 1;
var currentPage = -1;
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
    downloadUrl('index.php?action=getPostsNo&publish=yes', function(data){
        var jsonObj = JSON.parse(data);
        var nav = '<ul class="pager pagination-sm"><li><a href="javascript:showPrevious();"><span class="glyphicon glyphicon-backward btn-icon"></span>Precedent</a></li>';
        for(var i=0; i<jsonObj.length; i++) {
            nav += '<li class="page_link'
            if(!i) nav += ' active';
            nav += ' " id="id' + (i-1) + '">';
            nav += '<a href="javascript:showChapter(' + (i-1) + ');">' + AtoR(jsonObj[i]['no']) + '</a></li>';
        }
        nav += '<li><a href="javascript:showNext();">Suivant<span class="glyphicon glyphicon-forward btn-icon"></span></a></li></ul>';
        $('#tabs-chapter').html(nav);
    });
    setDisplay(0, showPerPage);
});