<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/classes/phpexcel.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Excel extends PHPExcel {
        public function __construct() {
            parent::__construct();
        }
    }
?>;
