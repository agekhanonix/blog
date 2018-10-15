/* =========================================================== **
*         reading and posting of the comments for a chapter     *
** =========================================================== */
/* Author    : Thierry CHARPENTIER                              *
*  Date      : 12.10.2018                                       *
*  Version   : V1R0                                             *
* ============================================================ */
/* --- =================================================== --- **
**     comments listing for a chapter                          **
** --- =================================================== --- */
function getComments(chapterNum, uniqid) {
    var postId = chapterNum;
    var url = 'index.php?action=getComments&id=' + postId + '&publish=yes';
    downloadUrl(url);
    readFile(uniqid,chapterNum);
}
function readFile(id, chapter) {
    var file = getXMLHttpRequest();
    var outHtml = '';
    file.open('GET', 'tmp/getComments_' + id + '.json', false);
    file.onreadystatechange = function() {
        if(file.readyState == 4)  {
            try {status = file.status; } catch(e) {}
            if (status == 200) {
                var jsonObj = JSON.parse(file.responseText);
                for(var i=0; i<jsonObj.length; i++) {
                    outHtml += jsonObj[i]['author'] + ' à écrit le ' + jsonObj[i]['comment_date_fr'] + "<br/>" + jsonObj[i]['comment'];
                }
            }
        } else {
            outHtml += 'Il n\'y a pas de commentaires pour ce chapitre';
        }
    }
    //$('#shComment').html(outHtml);
    file.send(null);
    $('#shComments' + chapter).html(outHtml);
    $('#divComment' + chapter).css('display', 'block');
}