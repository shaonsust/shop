<?php
/**
 * Created by PhpStorm.
 * User: sayed
 * Date: 1/22/2015
 * Time: 12:09 PM
 */

class Login_Model extends CI_Model {

    public function login_check($username,$password)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }


    public function get_email($email)
    {
        $this->db->select('*')
                  ->from('users')
                    ->where('email',$email);
        $query_result=$this->db->get();
        return $result=$query_result->row();
    }

    public function update_token($user_id,$data)
    {
        $this->db->where('id',$user_id);
        $this->db->update('users',$data);
    }

    public function get_check_token($id,$token)
    {
        $this->db->select('*')
            ->from('users')
            ->where('id',$id)
            ->where('token',$token)
            ->where('token_type','forgot_password');
        $query_result=$this->db->get();
        return $result=$query_result->row();
    }

    public function update_password($user_id,$data)
    {
        $this->db->where('id',$user_id);
        $this->db->update('users',$data);
    }




} 