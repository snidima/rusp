<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

        $this->view();
	}

    public function forgotsent()
    {
        $this->view();
    }

    public function forgotnocode()
    {
        $this->view();
    }


    public function pwdchanged()
    {
        $this->view();
    }

    function forgot(){

        $this->load->helper(array('form'));

        $data = array();
        if(!@empty($_POST)){

            if(!$this->userM->getUserBy('email', $this->input->post('email')))
                $data['notRegistered'] = true;
            else{

                $user = $this->userM->getUserBy('email', $this->input->post('email'));
                $code = $this->userM->createCode($user['userId']);

                $link = 'http://rusportdev.paragraph54.com/user/passwordRecovery/'.$code;
                $this->userM->sendEmail($user['email'], "forgetpwd", array('cLink'), array($link), 0, $subject = "Восстановление пароля на RuSport");

                redirect('/user/forgotsent');
             }

        }
        $this->view($data);
        //
        //print_r($docs);
        //$this->load->view('register', $data);
    }

    function passwordRecovery($code){

        $data = array();
        $user = $this->userM->getUserBy('confCode', $code);

        if(empty($user))
            redirect('/user/forgotnocode');
        else{
            if(@$this->input->post('pwd') && @$this->input->post('pwd') == @$this->input->post('pwd2')){
                $this->userM->changePassword($user['userId'], $this->input->post('pwd'));
                redirect('/user/pwdchanged');
            }
        }


        $this->view($data);
    }

     public function login()
    {

        if($this->isLoggedIn()){
            echo -1;
            exit;
        }

        if(!empty($_POST['username']) && !empty($_POST['password'])){

            if($this->session->userdata('login_attempts') > 3){
                if(!$this->__checkCaptcha($this->input->post('g-recaptcha-response'))){
                    echo -3;
                    exit;
                }
            }

            if(!$this->userM->login($_POST['username'], $_POST['password'])){

                $tries = $this->session->userdata('login_attempts');
                $this->session->set_userdata('login_attempts', $tries + 1);

                if($tries >= 3)
                    echo -2;
                else
                    echo 0;

                exit;
            }else{
                echo 1;
                exit;
            }

        }

        echo 0;
    }

    public function signupSuccess()
    {

        $this->view();
    }

    public function invalidCode()
    {
        $this->view();
    }

    public function activated()
    {
        $this->view();
    }

    function __checkCaptcha($captcha){

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                "secret=6Lc_UQ0TAAAAAHqGt3p0vBo94ZfhqG4B6ZR1t5Ho&response=$captcha");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec ($ch);
            $captchaCheck = json_decode($server_output, true);

            curl_close ($ch);


        return $captchaCheck['success'];
    }

    public function signUpSeller(){

        $data = array();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nickname', 'Ник', 'required|is_unique[user.nickname]');
        $this->form_validation->set_rules('pwd', 'Пароль', 'required');
        $this->form_validation->set_rules("pwd2","Password",'required|matches[pwd]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');

        if ($this->form_validation->run() != FALSE)
        {


            if(!$this->__checkCaptcha($this->input->post('g-recaptcha-response'))){
                $data['wrongCaptcha']  = true;
            }else {
                $userId = $this->userM->addSeller($this->input->post());

                if(@$userId)
                    redirect('/user/signupSuccess');
            }

        }
        $this->view($data);
    }

    public function signUpBuyer(){

        $data = array();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');


        $this->form_validation->set_rules('nickname', 'Ник', 'required|is_unique[user.nickname]');
        $this->form_validation->set_rules('pwd', 'Пароль', 'required');
        $this->form_validation->set_rules("pwd2","Password",'required|matches[pwd]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');

        if ($this->form_validation->run() != FALSE)
        {


            if(!$this->__checkCaptcha($this->input->post('g-recaptcha-response'))){
                $data['wrongCaptcha']  = true;
            }else {
                $userId = $this->userM->addBuyer($this->input->post());

                if(@$userId)
                    redirect('/user/signupSuccess');
            }

        }
        $this->view($data);
    }



    public function checkNickname() {

        @$username = $_POST['nickname'];

        if(!@$username)
            return;

        header('Content-Type: application/json;charset=utf-8');
        $user = $this->userM->getUserBy('nickname', $username);

        $isAvailable = true;

        if(!@empty($user)){
                $isAvailable = false;
        }
        if(!preg_match( '#^[0-9a-zA-Z\-\_]+$#iu', $username )){
            $isAvailable = false;
        }
       // var_dump($isAvailable);

        if(!$this->checkCurses($username))
            $isAvailable = false;

        echo json_encode(array(
            'valid' => $isAvailable,
        ));

    }

    public function checkMailListDesc() {

        @$desc = $_POST['maillistDesc'];

        if(!@$desc)
            return;

        header('Content-Type: application/json');

        $isAvailable = true;


        if(!$this->checkCurses($desc))
            $isAvailable = false;

        echo json_encode(array(
                'valid' => $isAvailable,
            ));

    }

    public function checkEmail() {

        if(!@$_POST['email'])
            return;

        header('Content-Type: application/json');
        $user = $this->userM->getUserBy('email', $_POST['email']);

        $isAvailable = true;

        //if((!@empty($user)) || ($this->blackmodel->isBlocked($_GET['email']))){
        if(!@empty($user)){
            $isAvailable = false;
        }

        echo json_encode(array(
            'valid' => $isAvailable,
        ));

    }



    function confirm($code){

        @$user = $this->userM->getUserBy('confCode', $code);
        if (@!empty($user)) {

            $this->userM->confirmRegistration($user['userId']);
            $this->session->set_userdata($user);
            $this->view(array(), 'user/activated');
        }
        else {
            $this->view(array(), 'user/invalidCode');
        }
    }



    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }





}
