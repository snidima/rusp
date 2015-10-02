<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class transactionM extends CI_Model
{

    public function getLastInfo($id, $num, $range)
    {
        $this->db->where('userId', $id)->order_by('date', 'DESC');
        $query = $this->db->get('transaction', $num, $range);

        return $query->result_array();
    }
}