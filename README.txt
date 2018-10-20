# PROJET IV : BLOG D'ECRIVAIN
# Auteur    : Thierry CHARPENTIER
# Version   : V3R0
# Date      : 30/09/2018
# ---   ooo O ooo    ---
# L'organisation des dossiers
# ----------------------
# []>/                      La racine du projet
#   |>index.php  
# []>config              
#   |>config.php            Fichier de configuration
# []>controller          
    |>frontend.php          Le controleur du frontend de l'application
# []>divers              
#   |>corps.html            Le corps de courriel envoyé par la page contact
# []>libs                
#   |>OCFram            
#     |>Cmail.php           La Class Cmail (pour le traitement des mails)
#     |>library.php         Bibliothèque de fonctions
# []>model
#   |>CommentManager.php    Gestion des accès à la table bl_comments
#   |>Manager.php           Manager générique
#   |>MemberManager.php     Gestion des accès à la table bl_members
#   |>PostManager.php       Gestion des accès à la table bl_posts
#   |>VisitManager.php      Gestion des accès à la table bl_visits    
# []>public                  
#   []>bootstrap            L'implémentaion du CMS Bootstrap
#   []>css
#     |>styles.css          La feuille de styles
#     []>images             le/les images de l'application
#       []>articles
#       []>avatars
#       []>covers
#       []>ico
#       []>slider
#   []>js 
#     |>configTinymce.js    Le fichier de configuration de TinyMce 
#     |>gestShowChapters.js La gestion de la pagination des chapitres
#     |>getComments.js      L'appel des commentaires pour un chapitres
#     |>main.js             L'algorithme de traitement principal
#     |>jquery-3.3.1.js     Le jQuery          
#     []>tinymce            L'outil "tinymce"
#     []>objects            Les objets JS au sens POO
#       |>canvas.js
#       |>carrousel.js
#       |>countdown.js
#       |>gmap.js
#       |>marker.js
#       |>objects.js
# []>template               
#   |>template.php          Le template d'affichage du site
# []>view
#   |>errorView.php         L'affichage des erreurs
#   |>footer.html           Le pied de page
#   |>header.html           L'entete de page
#   |>nav.html              La barre de navigation  
#   |>registering.php
#   []>frontend             Les # vues du "front office"
#     |>addCommentView.php
#     |>addPost.php
#     |>contact.php           Le 'panel' de saisie de demande de contact
#     |>delMembers.php
#     |>delPosts.php
#     |>home.html
#     |>home.php
#     |>listComments.php
#     |>listPosts.php
#     |>polities.html
#     |>polities.php          La politique de confidentialité
#     |>post.php
#     |>pubPosts.php
#   []>qry 