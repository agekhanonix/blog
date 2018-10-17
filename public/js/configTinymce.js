/* =========================================================== **
*                           Tinymce config                      *
** =========================================================== */
/* Author    : Thierry CHARPENTIER                              *
*  Date      : 11.10.2018                                       *
*  Version   : V1R0                                             *
* ============================================================ */
tinymce.init({
  selector: 'textarea#editable',
  height: 380,
  theme: 'modern',
  // Liste des plugins
  plugins : "advlist, anchor, image, imagetools, code, colorpicker, emoticons, table, hr, insertdatetime, textcolor, lists, media, wordcount ",
  language: "fr_FR",
  // emplacement de la toolbar
  theme_modern_toolbar_location : "top",
  // alignement de la toolbar
  theme_modern_toolbar_align : "left",
  // positionnement de la barre de statut
  theme_modern_statusbar_location : "bottom",
  // permet de redimensionner la zone de texte
  theme_modern_resizing : true,
  // taille disponible
  theme_modern_font_sizes: "10px,11px,12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px,25px",
  // couleur disponible dans la palette de couleur
  theme_modern_text_colors : "33FFFF, 007fff, ff7f00",
  // balise html disponible
  theme_modern_blockformats : "h1, h2,h3,h4,h5,h6",
  // chemin vers le fichier css
  content_css : " ./design-tiny.css,", 
 });

// Prevent bootstrap dialog from blocking focusin

$(document).on('focusin', function(e) {
  if ($(e.target).closest(".mce-window").length) {
    e.stopImmediatePropagation();
  }
});

$('#open').click(function() {
  $("#dialog").dialog({
    width: 800,
    modal: true
  });
});