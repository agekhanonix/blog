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
    var outHtml = '';
    downloadUrl(url, function(data) {
        var jsonObj = JSON.parse(data);
        if(jsonObj.length > 0) {
            for(var i=0; i<jsonObj.length; i++) {
                outHtml += '<div class="row">';
                outHtml += '<div class="col-md-12 col-sm-12 col-xs-12">';
                outHtml += '<img src="public/images/avatars/ico0' + jsonObj[i]['avatar'] + '.png" width="15px">&nbsp;' + jsonObj[i]['author'] + ' à écrit le ' + jsonObj[i]['comment_date_fr'];
                if(jsonObj[i]['moderated'] == 0) {
                    outHtml += '<a href="index.php?action=modComment&post=' + jsonObj[i]['post_id'];
                    outHtml += '&com=' + jsonObj[i]['id'] + '&val=1" title="Demander que cet article soit modéré"><span class="glyphicon glyphicon-thumbs-up register-comment-glyph blue"></span></a>';
                } else {
                    outHtml += '<span class="glyphicon glyphicon-thumbs-down register-comment-glyph red"></span>';
                }
                outHtml += '</div>';
                outHtml += '<div class="col-md-12 col-sm-12 col-xs-12">' + jsonObj[i]['comment'] + '</div>';
                outHtml += '</div>';
            }
        } else {
            outHtml += '<div class="row">';
            outHtml += '<div class="col-md-12 col-sm-12 col-xs-12">';
            outHtml += 'Il n&apos;y a pas de commentaires pour ce chapitre';
            outHtml += '</div>';
            outHtml += '</div>';
        }
        $('#rComment' + postId).html(outHtml);
    });   
}