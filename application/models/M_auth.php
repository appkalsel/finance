<?php

class M_auth extends CI_Model
{

    function auth($email)
    {
        return $query = $this->db->get_where('users_login', array('email' => $email))->row_array();
    }

    function signup()
    {
        // GENERATE RANDOM STRING
        function generateRandomString($length = 5)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        };
        // END

        //get next id_users
        $query = $this->db->query('SELECT id FROM users ORDER BY id ASC')->num_rows();
        $jumlah_users = $query + 1;
        // var_dump($jumlah_users);
        // die;
        if ($jumlah_users < 10) {
            $next_id = "AGRO-77-000000" . $jumlah_users;
        } elseif ($jumlah_users < 100) {
            $next_id = "AGRO-77-00000" . $jumlah_users;
        } elseif ($jumlah_users < 1000) {
            $next_id = "AGRO-77-0000" . $jumlah_users;
        } elseif ($jumlah_users < 10000) {
            $next_id = "AGRO-77-000" . $jumlah_users;
        } elseif ($jumlah_users < 100000) {
            $next_id = "AGRO-77-00" . $jumlah_users;
        } elseif ($jumlah_users < 1000000) {
            $next_id = "AGRO-77-0" . $jumlah_users;
        } elseif ($jumlah_users < 10000000) {
            $next_id = "AGRO-77-" . $jumlah_users;
        }
        $randomstring = generateRandomString();
        $email = $this->input->post('email');
        $pw = $this->input->post('pw');
        $pw = password_hash($pw, PASSWORD_DEFAULT);
        $data = array(
            'id_users' => $next_id,
            'id_role' => '4',
            'email' => $email,
            'pw' => $pw,
            'nama' => $this->input->post('nama'),
            'date_active' => date('Y-m-d'),
            'otp' => $randomstring,
        );

        // Konfigurasi email
        // $config = [
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        //     'protocol'  => 'smtp',
        //     'smtp_host' => 'ssl://smtp.googlemail.com',
        //     'smtp_user' => 'agrowisatakb@gmail.com',  // Email gmail
        //     'smtp_pass'   => 'M4k4nS14ng',  // Password gmail
        //     'smtp_crypto' => 'tls',
        //     'smtp_port'   => 25,
        //     'crlf'    => "\r\n",
        //     'starttls' => true,
        //     'newline' => "\r\n"
        // ];

        // // Load library email dan konfigurasinya
        // $this->load->library('email', $config);
        // // Email dan nama pengirim
        // $this->email->from('agrowisatakb@gmail.com', 'DESA KARANG BUNGA');
        // // Email penerima
        // $this->email->to($email); // Ganti dengan email tujuan
        // // Subject email
        // $this->email->subject('AKTIVASI AKUN SIAGRO');
        // // Content email
        // $this->email->message($this->load->view('mail', $data, true));
        // // Sending email
        // // $this->email->send();
        // if ($this->email->send() == true) {
        //     $this->db->insert('users', $data);
        //     return true;
        // }
        $this->db->insert('users', $data);
        return true;
    }

    function load_user()
    {
        //select * from users;
        $data = $this->db->get('users');
        return $data->result();
    }

    // function cek_user($data)
    // {
    //     // building sql query = escape character
    //     // sql injection
    //     // select * from users where username = username and password = password
    //     $this->db->select('*');
    //     $this->db->where('username', $data['username']);
    //     $this->db->where('password', $data['password']);
    //     $this->db->from('users');
    //     $result = $this->db->get(); //eksekusi query
    //     if ($result->num_rows() > 0) { //cek jumlah baris
    //         $user = $result->row(); // ambil baris 1
    //         $_SESSION['is_login'] = TRUE;
    //         $_SESSION['username'] = $user->username;
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    function insert_user()
    {
        $data = array(
            'id' => '',
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'nohp' => $this->input->post('nohp'),
            'levels' => $this->input->post('levels'),
        );

        $this->db->insert('users', $data);
        return true;
    }

    function get_user($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('users');
        return $result->row_array();
    }

    function update_user($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
        return true;
    }
}
