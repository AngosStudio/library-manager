<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class LB_Controller extends CI_Controller {

    public $data = [];

    public function __construct(){

        parent::__construct();

        session_start();
        date_default_timezone_set('America/Sao_Paulo');

        $this->form_validation->set_error_delimiters('', '');
    }

    public function loadPagina( $view ){
        $this->load->view( $view.'.php', $this->data );
    }

    public function json($success, $dados = [], $message = false, $code = 200) {
        header('Content-Type: application/json');
        http_response_code($code);

        if(is_array($success)){
            die(json_encode($success));
        }

        if(is_string($dados) && !$message){
            $message = $dados;
            $dados   = [];
        }

        $json = json_encode([
            'status'  => $code,
            'success' => $success,
            'message' => $message,
            'data'    => $dados,
        ]);

        die($json);
    }

    public function json_error($message = false, $code = 400) {
        http_response_code($code);
        header('Content-Type: application/json');
        die(json_encode([
            'status'  => $code,
            'success' => false,
            'message' => $message,
            'data'    => [],
        ]));
    }

}
