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
function getComments(chapterNum) {
    var postId = chapterNum;
    var url = 'index.php?action=getComments&id=' + postId + '&publish=yes';
    downloadUrl(url, function(data) {
        alert(data);
    });
}