<?php
/* *** ---------------------------------------- *** **
** ENVOI DES EMAILS AVEC GESTION DES PIECES JOINTES **
** *** ---------------------------------------- *** **/
define("BOUNDARY", "--".md5(rand()));
class CMail {
    public $from;                                   // Votre email
    public $fromName;                               // Votre nom
    public $to;                                     // Destinataire
    public $cc;                                     // Copie à
    public $bcc;                                    // Copie cachée à
    public $subject;                                // L'objet du mail
    public $priority;                               // La priorité du courriel 1-5
    public $returnPath;                             // Courriel utilisé pour la réponse;
    public $notify;                                 // Courriel utilisé pour la notification
    public $message;                                // Le corps du mail
    public $charset;                                // Le jeu de caractère
    public $mime;                                   // Le type mime, text/plain par défaut
    public $debug;                                  // Affichage ou non des erreurs
    public $debug_txt;                              // Les messages d'erreurs

    public $header;
    public $body;
    protected $attachments = Array();               // Les pièces jointes
    protected $priorities = Array(                  // Le tableau des priorités
        '1 (Highest)',
        '2 (High)',
        '3 (Normal)',
        '4 (Low)',
        '5 (Lowest)'
    );

    /* ---               CONSTRUCTEUR               *** */
    public function __construct() {
        $this->clear();
    }

    /* ---  INITIALISATION DES VALEURS PAR DEFAUT   *** */
    public function clear() {
        $this->mime     = "text/plain";
        $this->message  = "";
        $this->charset  = "iso-8859-1";
        $this->from     = "";
        $this->fromName = "";
        $this->to       = "";
        $this->cc       = "";
        $this->bcc      = "";
        $this->subject  = "";
        $this->returnPath = "";
        $this->notify   = "";
        $this->priority = 0;
        $this->debug    = false;
        $this->clearAttachments();
    }

    /* ---    VERIF. SYNTAXE D'UNE ADRESSE MAIL     *** */
    public static function checkAddress($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /* ---   RETOURNE LE TYPE MIME D'UN FICHIER     *** */
    public static function getMimeType($file) {
        static $mimeTypes = Array(
            '.aac'  => 'audio/aac',
            '.abw'  => 'application/x-abiword',
            '.arc'  => 'application/octet-stream',
            '.avi'  => 'video/x-msvideo',
            '.azw'  => 'application/vnd.amazon.ebook',
            '.bin'  => 'application/octet-stream',
            '.bmp'  => 'image/bmp',
            '.bz'   => 'application/x-bzip',
            '.bz2'  => 'application/x-bzip2',
            '.csh'  => 'application/x-csh',
            '.css'  => 'text/css',
            '.doc'  => 'application/msword',
            '.docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            '.eot'  => 'application/vnd.ms-fontobject',
            '.epub' => 'application/epub+zip',
            '.gif'  => 'image/gif',
            '.htm'  => 'text/html',
            '.html' => 'text/html',
            '.ico'  => 'image/x-icon',
            '.ics'  => 'text/calendar',
            '.jar'  => 'application/java-archive',
            '.jpg'  => 'image/jpeg',
            '.jpeg' => 'image/jpeg',
            '.jpe'  => 'image/jpeg',
            '.js'   => 'application/javascript',
            '.json' => 'application/json',
            '.mid'  => 'audio/midi',
            '.midi' => 'audio/midi',
            '.mpeg' => 'video/mpeg',
            '.mpkg' => 'application/vnd.apple.installer+xml',
            '.odp'  => 'application/vnd.oasis.opendocument.presentation',
            '.ods'  => 'application/vnd.oasis.opendocument.spreadsheet',
            '.odt'  => 'application/vnd.oasis.opendocument.text',
            '.oga'  => 'audio/ogg',
            '.ogv'  => 'video/ogg',
            '.ogx'  => 'application/ogg',
            '.otf'  => 'font/otf',
            '.png'  => 'image/png',
            '.pdf'  => 'application/pdf',
            '.ppt'  => 'application/vnd.ms-powerpoint',
            '.pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            '.rar'  => 'application/x-rar-compressed',
            '.rtf'  => 'application/rtf',
            '.sh'   => 'application/x-sh',
            '.svg'  => 'image/svg+xml',
            '.swf'  => 'application/x-shockwave-flash',
            '.tar'  => 'application/x-tar',
            '.tgz'  => 'application/x-gzip',
            '.tif'  => 'image/tiff',
            '.tiff' => 'image/tiff',
            '.ts'   => 'application/typescript',
            '.ttf'  => 'font/ttf',
            '.txt'  => 'text/plain',
            '.vsd'  => 'application/vnd.visio',
            '.wav'  => 'audio/x-wav',
            '.weba' => 'audio/webm',
            '.webm' => 'video/webm',
            '.webp' => 'image/webp',
            '.woff' => 'font/woff',
            '.woff2'    => 'font/woff2',
            '.xhtml'    => 'application/xhtml+xml',
            '.xls'  => 'application/vnd.ms-excel',
            '.xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            '.xml'  => 'application/xml',
            '.xul'  => 'application/vnd.mozilla.xul+xml',
            '.zip'  => 'application/zip',
            '.3gp'  => 'video/3gpp',
            '.3g2'  => 'video/3gpp2',
            '.7z'   => 'application/x-7z-compressed'
        );
        $att = strrchr(StrToLower($file), '.');
        return (!isset($mimeType[$att])) ? "application/octet-stream" : $mimeTypes[$att];
    }

    /* ---        SUPPRIME LES PIECES JOINTES       *** */
    public function clearAttachments() {
        $this->attachments = Array();
    }

    /* ---   AJOUT D'UNE P.J. ENCODEE EN BASE64     *** */
    /* @param $filename     : nom du fichier            **
    ** @param $innerName    : nom du fichier attaché    **
    ** @param $mime         : type mime                 */
    public function addAttachment($filename, $innerName='', $mime='') {
        if(!file_exists($filename)) $this->debug_txt .= "Fichier " . $filename . " non trouvé";
        if(!is_readable($filename)) $this->debug_txt .= "Fichier " . $filename . " innacessible";

        $fp = @fopen($filename, "r");
        if(!$fp) $this->debug_txt .= "Impossible d'ouvrir le fichier " . $filename;
        if($innerName == "") $innerName = basename($filename);
        if($mime == "") $mime = $this->getMimeType($innerName);

        $attachment = "";
        $attachment .= "\r\n\r\n--".BOUNDARY."\r\n";
        $attachment .= "Content-Transfer-Encoding: base64\r\n";
        $attachment .= "Content-Type: " . $mime . "; name=\"" . $innerName . "\"; charset=\"us-ascii\"\r\n";
        $attachment .= "Content-Disposition: attachment; filename=\"" . $innerName . "\"\r\n\r\n";
        $attachment .= chunk_split(base64_encode(@fread($fp, @filesize($filename))));

        array_push($this->attachments, $attachment);
        @fclose($fp);
    }

    /* ---          ENVOI DU COURRIEL               *** */
    /* @param $emailfile    : le mail est envoye en PJ  */
    public function send($emailfile="") {
        $this->body = "";
        $this->header = "";
        /* --- Construction du HEADER --- */
        if(strlen($this->from)) {
            if(!$this->checkAddress($this->from)) $this->debug_txt .= "From:" . $this->from . " n'est une adresse courriel valide";
        }
        if(strlen($this->returnPath)) {
            if(!$this->checkAddress($this->returnPath)) $this->debug_txt .= "From:" . $this->returnPath . " n'est une adresse courriel valide";
            $this->header .= "Return-path: <" . $this->returnPath .">\r\n";
        }
        if(strlen($this->from)) $this->header .= "From: " . $this->fromName . " <" . $this->from . ">\r\n";
        $ok = true;
        if(is_array($this->to)) {
            foreach($this->to as $addr) {
                if($ok && $this->checkAddress($addr)) { $ok = true;}
                else { $ok = false; }
            }
        } else {
            if($ok && $this->checkAddress($this->to)) { $ok = true;}
            else { $ok = false;}
        }
        if(!$ok) $this->debug_txt .= "Email To: " . (is_array($this->to)) ? implode(', ', $this->to) : $this->to . " n'est pas une addesse courriel valide";
        if(!empty($this->cc)) {
            $ok = $this->checkAddress($this->cc);
            if(!$ok) $this->debug_txt .= "Email Cc: " . $this->cc . " n'est pas une adresse courriel valide";
            $this->header .= "Cc:";
            $this->header .= $this->cc;
            $this->header .= "\r\n";
        }
        if(!empty($this->bcc)) {
            $ok = $this->checkAddress($this->bcc);
            if(!$ok) $this->debug_txt .= "Email Bcc: " . $this->bcc . " n'est pas une adresse courriel valide";
            $this->header .= "Bcc: ";
            $this->header .= is_array($this->bcc) ? implode(", ", $this->bcc) : $this->bcc;
            $this->header .= "\r\n";
        }
        $this->header .= "Mime-Version: 1.0\r\n";
        if(intval($this->notify) == 1) {
            $this->header .= "Disposition-Notification-To: <" . $this->from .">\r\n";
        } else if(strlen($this->notify)) {
            $this->header .= "Disposition-Notification-To: <" . $this->notify . ">\r\n";
        }
        if(!empty($this->attachments)) { /* HEADER avec PJ */
            $this->header .= "Content-Type: multipart/mixed; boundary=\"" . BOUNDARY . "\"\r\n";
            $this->header .= "Content-Transfer-Encoding: 7bit\r\n";
            $this->body .= "This is a multi-part message in MIME format.\r\n\r\n";
        } else { /* HEADER sans PJ */
            $this->header .= "Content-Transfer-Encoding: 8bit\r\n";
            $this->header .= "Content-Type: " . $this->mime . "; charset=\"" . $this->charset . "\"" .
                (empty($emailfile) ? "" : " name=\"" . $emailfile ."\"") . "\r\n";
            $this->body .= $this->message;   
        }
        if($this->priority) $this->header .= "X-Priority: " . $this->priorities[$this->priority] . "\r\n";
        if(!empty($this->attachments)) {
            $this->body .= "\r\n\r\n--" . BOUNDARY . "\r\n";
            $this->body .= "Content-Transfer-Encoding: 8bit\r\n";
            $this->body .= "Content-Type: " . $this->mime . "; charset=\"" . (empty($emailfile) ? "" : " name=\"" . $emailfile . "\"\r\n");
            $this->body .= "Mime-Version: 1.0\r\n\r\n";
            $this->body .= $this->message . "\r\n\r\n";
            reset($this->attachments);
            while(list($key, $attachment) = each ($this->attachments)) {
                $this->body .= $attachment;
            }
            $this->body .= "\r\n\r\n--" . BOUNDARY . "--"; 
        }
        if($this->debug) { /* texte pour le deboguage */
            echo "<pre>";
            echo "\r\nTO\r\n" . HTMLSpecialChars($this->to);
            echo "\r\nSUBJECT\r\n" . HTMLSpecialChars($this->subject);
            echo "\r\nBODY\r\n" . HTMLSpecialChars($this->body);
            echo "\r\nHEADER\r\n" . HTMLSpecialChars($this->header);
            echo "</pre>";
        }
        if(is_array($this->to)) {
            reset($this->to);
            while(list($key, $val) = each($this->to)) {
                $this->sendTo($val);
            }
        } else {
            $this->sendTo($this->to);
        }
    }

    protected function sendTo($to) {
        if(!@mail($to, $this->subject, $this->body )) $this->debug_txt .= "PHP::Mail() erreur d'envoi du mail " . $to;
    }
}