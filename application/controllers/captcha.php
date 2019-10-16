<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends CI_Controller
{
 
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation', 'Recaptcha'));
    }
 
    function index()
    {
        // $data = array(
        //     'action'          => site_url('captcha/login'),
        //     'username'        => set_value('username'),
        //     'password'        => set_value('password'),
        //     'captcha'         => $this->recaptcha->getWidget(), // menampilkan recaptcha
        //     'script_captcha'  => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        // );
 
        $this->load->view('vcaptcha');
    }
 
    function login()
    {
        // validasi form
        // $this->form_validation->set_rules('username', ' ', 'trim|required');
        // $this->form_validation->set_rules('password', ' ', 'trim|required');
        
        // $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
 
        // $recaptcha = $this->input->post('g-recaptcha-response');
        // $response = $this->recaptcha->verifyResponse($recaptcha);
    
        // if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
        //     $this->index();
        // } else {
        //     // lakukan proses validasi login disini
        //     // pada contoh ini saya anggap login berhasil dan saya hanya menampilkan pesan berhasil
        //     // tapi ini jangan di contoh ya menulis echo di controller hahahaha
        //     echo 'Berhasil';
        // }

        $this->load->view('content/vtestimoni');
    }
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
