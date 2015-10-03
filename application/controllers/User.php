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
            echo -1; //next
            exit;
        }

        if(!empty($_POST['username']) && !empty($_POST['password'])){

            if($this->session->userdata('login_attempts') > 3){
                if(!$this->__checkCaptcha($this->input->post('g-recaptcha-response'))){
                    echo -3; // you are bot
                    exit;
                }
            }

            if(!$this->userM->login($_POST['username'], $_POST['password'])){

                $tries = $this->session->userdata('login_attempts');
                $this->session->set_userdata('login_attempts', $tries + 1);

                if($tries >= 3)
                    echo -2; // wrong pass
                else
                    echo 0;

                exit;
            }else{
                echo 1; //next
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
                "secret=6LeP4w0TAAAAAJq4MLXslyPLVJ40TEwXTGK6UdVZ&response=$captcha");

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

/**************************************************************/

    public function buyer($nickname)  //добавить линк на аву в бд
    {
        $id = $this->session->userId;
        $data['info'] = $this->userM->getInfo($id)[0];
        $this->view($data);
    }


    public function balance()
    {
        /*вывести первых 2 записей. для упрощения должно быть равно $num в function more()*/
        $num = 1;

        $id = $this->session->userId;
        $data['info'] = $this->transactionM->getLastInfo($id, $num, 0);

        /*Сумма выведенных средств*/
        //$data['sum'] = array_sum(array_column($data['info'], 'amount'));

        /*скрыть или показать кнопку "Показать еще"*/
        if (sizeof($this->transactionM->getLastInfo($id, 1, $num)) != 0)
            $data['nomore'] = true;
        else
            $data['nomore'] = false;

        $this->view($data);


    }

    public function more()
    {
        /*вывести еще 2 записи. для упрощения должно быть равно $num в function balance()*/
        $num = 1;

        $page = $this->input->post('page');
        $id = $this->session->userId;
        $data = $this->transactionM->getLastInfo($id, $num, $page * $num);

        $temp = '';
        foreach($data as $d){
            $temp .= "<tr><td>";
            $temp .= date('d.m.Y, G:H', $d['date']);
            $temp .= "</td><td>";
            $temp .= $d['type'];
            $temp .= "</td><td><b><i class='fa fa-usd'></i> ";
            $temp .= $d['amount'];
            $temp .= "</b></td></tr>";

        }
        $data['html'] = $temp;

        /*остались ли еще записи?*/
        if (sizeof($this->transactionM->getLastInfo($id, 1, ($page+1) * $num)) == 0)
            $data['stop'] = true;
        else
            $data['stop'] = false;

        echo json_encode($data);
    }


    public function supportsend()
    {
        $this->view();
    }

    public function supportdialog()
    {
        $this->view();
    }
}
