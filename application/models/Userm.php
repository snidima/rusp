<?php
/**
 * Created by PhpStorm.
 * User: Tan4ik
 * Date: 23.03.15
 * Time: 14:21
 */
class userM extends CI_Model {

    var $table   = 'user';

    public function getUserBy($field, $value){
        $w = array($field => $value);
        $this->db->where($w);
        $q = $this->db->get($this->table);
        if ($q->num_rows()) {
            $res = $q->result_array();
            return $res[0];
        }
        else {
            return array();
        }

    }


    public function addBuyer($post)
    {
        $confCode = md5(time().microtime());

        $data = array(
            'email' => $post['email'],
            'nickname' => $post['nickname'],
            'added' => time(),
            'password' => md5($post['pwd']),
            'confCode' => $confCode,
            'usertype' => 'buyer',
            'status' => 'pending'
        );


        $this->db->insert($this->table, $data);

        $link = 'http://rusportdev.paragraph54.com/user/confirm/'.$confCode;
        $this->sendEmail($post['email'], "signup", array('cLink'), array($link), 0, $subject = "Регистрация на RuSport");

        return $this->db->insert_id();
    }

    public function addSeller($post)
    {
        $confCode = md5(time().microtime());

        $data = array(
            'email' => $post['email'],
            'nickname' => $post['nickname'],
            'added' => time(),
            'password' => md5($post['pwd']),
            'confCode' => $confCode,
            'usertype' => 'seller',
            'maillistDesc' => $post['maillistDesc'],
            'status' => 'pending'
        );


        $this->db->insert($this->table, $data);

        $link = 'http://rusportdev.paragraph54.com/user/confirm/'.$confCode;
        $this->sendEmail($post['email'], "signup", array('cLink'), array($link), 0, $subject = "Регистрация на RuSport");

        return $this->db->insert_id();
    }


    public function confirmRegistration($id)
    {

        $data = array(
            'status' => 'active'
        );
        $this->db->where('userId', $id);
        $this->db->update($this->table, $data);

    }

    public function createCode($id){
        $code = md5(time().microtime());
        $data = array(
            'confCode' => $code
        );
        $this->db->where('userId', $id);
        $this->db->update($this->table, $data);

        return $code;
    }



    public function login($login, $pass){
        if (!empty($login) && !empty($pass)) {

            $w = array(
                'email' => $login,
                'password' => md5($pass),
                'status' => 'active'
            );
            $this->db->where($w);
            $q = $this->db->get($this->table);
            $res = $q->result_array();
            if(!empty($res)){
                $user = $res[0];
                $this->session->set_userdata($user);
                return $user;
            }

        } else {
            return false;
        }

    }

    public function changePassword($uid, $password){
        $data = array(
            'password' => md5($password),
            'confCode' => md5(time().microtime())
        );
        $this->db->where('userId', $uid);
        $q = $this->db->update($this->table, $data);

    }


    public function getInfo($id)
    {

        $this->db->where('userId', $id)->select('delivery, description');
        $query = $this->db->get($this->table,'delivery', 'description');

        return $query->result_array();
    }
}