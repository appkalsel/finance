<?php

class M_fin extends CI_Model
{

    function load_tr($id_users = NULL, $id = NULL)
    {
        $this->db->order_by("date", "desc");
        if ($id_users !== NULL && $id === NULL) {
            return $this->db->get_where('fin_transaction', array('id_users' => $id_users))->result();
        } elseif ($id_users === NULL && $id !== NULL) {
            return $this->db->get_where('fin_transaction', array('id' => $id))->row_array();
        } else {
            return $this->db->get('fin_transaction')->result();
        }
    }

    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return true;
    }

    function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        return true;
    }

    function get_tr($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('fin_transaction');
        return $result->row_array();
    }

    function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return true;
    }
}
