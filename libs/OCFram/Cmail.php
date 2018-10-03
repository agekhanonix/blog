<?php
/* *** -------------------------------------------- *** **
**              MAIL SENDER WITH ATTACHMENTS            **
** *** -------------------------------------------- *** **/
/*
    $from = "john.doe@ltd.com";
    $fromName = "John DOE";
    $cc = "alex.terieur@gmail.com";
    $to = array("alain.terieur@gmail.com");
    $subject = "ENVOI DE MAIL AVEC PJ";
    $message = "<strong>Un message</strong>  avec une piece jointe";
    $attachment = array('README.txt', 'image.jpeg', '2018171442362.pdf');

    $courriel = new Cmail();
    $courriel->to = $to;
    $courriel->cc = $cc;
    $courriel->from = $from;
    $courriel->fromName = $fromName;
    $courriel->subject = $subject;
    $courriel->message = $message;
    $courriel->attachment = $attachment;

    $courriel->send();
*/
define("BOUNDARY", md5(uniqid(microtime(), true)));
class CMail {
    /* ===                     PARAMS               === */
    public $to;                                     // Recipient
    public $subject;                                // Mail subject
    public $message;                                // Your message
    public $from;                                   // Your email
    public $fromName;                               // Your name
    public $bcc = array();                          // Blind carbon copy
    public $cc = array();                           // Carbon copy
    public $attachment = array();                   // Attachments

    /* ===                    CONSTANTS            === */ 
    const HEADER_BCC                    = "Bcc";
    const HEADER_CC                     = "Cc";
    const HEADER_FROM                   = "From";
    const HEADER_MIME_VERSION           = "MIME-Version";
    const HEADER_CONTENT_TYPE           = "Content-Type";
    const HEADER_CONTENT_TRANSFER_ENCODING = "Content-Transfer-Encoding";
    const HEADER_SEPARATOR_CRLF         = "\r\n";

    /* ***               CONSTRUCTOR                *** */
    public function __construct() {
    }
    /* ***        PREPARE MAIL BEFORE SENDING       *** */
    public function send() {
        $recipients = (!is_array($this->to)) ? explode(";", $this->to) : $this->to; 
        $bccs = (!is_array($this->bcc)) ? explode(";", $this->bcc) : $this->bcc;
        $ccs = (!is_array($this->cc)) ? explode(";", $this->cc) : $this->cc;
        $attachments = (!is_array($this->attachment)) ? explode(";", $this->attachment) : $this->attachment;

        $headers = "";
        $body = "";
        foreach($recipients as $recipient) {
            /* --- Mail origin                      --- */
            /* HEADERS      */
            $headers .= self::HEADER_FROM . ":" . $this->fromName . "<" . $this->from .">" . self::HEADER_SEPARATOR_CRLF;
            $headers .= self::HEADER_MIME_VERSION . ": 1.0" . self::HEADER_SEPARATOR_CRLF;
            $headers .= self::HEADER_CONTENT_TYPE . ": multipart/mixed; boundary=" . BOUNDARY . self::HEADER_SEPARATOR_CRLF;
            /*$headers .= self::HEADER_SEPARATOR_CRLF;*/
            /* BODY         */
            $body .= "This is a multipart/mixed message." . self::HEADER_SEPARATOR_CRLF;
            $body .= "--" . BOUNDARY . self::HEADER_SEPARATOR_CRLF;
            $body .= self::HEADER_CONTENT_TYPE . ": text/html; charset=utf-8" . self::HEADER_SEPARATOR_CRLF; 
            $body .= self::HEADER_CONTENT_TRANSFER_ENCODING . ":8bit" . self::HEADER_SEPARATOR_CRLF;
            $body .= $this->message . self::HEADER_SEPARATOR_CRLF;
            /* ATTACHMENTS  */ 
            foreach($attachments as $attachment) {
                if(file_exists($attachment) && !is_dir($attachment)) {
                    if (function_exists('finfo_open') && $finfo = finfo_open(FILEINFO_MIME_TYPE)) {
                        $contentType = finfo_file($finfo, $attachment);
                        finfo_close($finfo);
                    } elseif(function_exists('mime_content_type')) {
                        $contentType = mime_content_type($attachment);
                    } else {
                        $contentType = $this->getMimeType($attachment);
                    }
                    $fileContent = chunk_split(base64_encode(file_get_contents($attachment, false)));
                    $body .= '--' . BOUNDARY . self::HEADER_SEPARATOR_CRLF;
                    $body .= self::HEADER_CONTENT_TYPE . ":" . $contentType . "; name=" . $attachment . self::HEADER_SEPARATOR_CRLF;
                    $body .= self::HEADER_CONTENT_TRANSFER_ENCODING . ":base64" . self::HEADER_SEPARATOR_CRLF;
                    $body .= $fileContent . self::HEADER_SEPARATOR_CRLF;
                }
                $body .= '--' . BOUNDARY . self::HEADER_SEPARATOR_CRLF;
            }
            /* --- Blind carbon copy recipients     --- */
            foreach($bccs as $bcc) {
                if(self::checkAddress(trim($bcc))) $headers .= self::HEADER_BCC . ":" . null . "<" . trim($bcc) . "> ";
            }
            $headers .= self::HEADER_SEPARATOR_CRLF;
            /* --- Carbon copy recipients           --- */ 
            foreach($ccs as $cc) {
                if(self::checkAddress(trim($cc))) $headers .= self::HEADER_CC . ":" . null . "<" . trim($cc) . "> ";
                $headers .= self::HEADER_SEPARATOR_CRLF;
            }
            $headers .= self::HEADER_SEPARATOR_CRLF;
            if(self::checkAddress(trim($recipient))) $this->sendTo(trim($recipient), $this->subject, $body, $headers );
        }
    }
    /* ***           MAIL BEFORE SEND               *** */
    private function sendTo($to, $subject, $message, $headers) {
        @mail($to, $subject, $message, $headers);
    }
    /* *** SYNTAX CHECKING FOR AN ADDRESS E-MAIL    *** */
    protected static function checkAddress($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        if(function_exists('checkdnsrr')) {
            $host = substr($email, strpos($email, '@') + 1);
            return checkdnsrr($host, 'MX');
        }
        return true;
    }
    /* ***          GET MIME TYPE FOR FILE          *** */
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
        $att = strrchr(strtolower($file), '.');
        return (!isset($mimeType[$att])) ? "application/octet-stream" : $mimeTypes[$att];
    }
}