<?php

class m_siswa extends CI_Model{
	//tes login untuk siswa
	public function can_log_in($nis, $password){
		//membuat perintah sql dengan menggunakan fungsi bawaan ci
        //untuk perintah SELECT
        $this->db->select('*');
        //untuk perintah WHERE
        $this->db->where('nis', $nis);
        //untuk perintah WHERE
        $this->db->where('password', $password);
        //eksekusi peritah sql
        $query = $this->db->get('siswa');
        //struktur kendali untuk cek apakah data ada atau tidak
        if($query->num_rows() > 0){
            //memasukkan hasil eksekusi query kedalam row_array
            return $query->row_array();
        } else {
            return array();
        }
	}

    //get name by NIS
    public function name_by_NIS($nis){
        $this->db->select('nama_lengkap');
        $this->db->where('nis', $nis);
        $query = $this->db->get('siswa');
        $nama = $query->row_array();
        return $nama['nama_lengkap'];
    }

    //show timeline by user
    public function timeline_by_NIS($nis){
        $this->db->select('*');
        $this->db->where('nis', $nis);
        $query = $this->db->get('status');
        if($query->num_rows() > 0){
            //memasukkan hasil eksekusi query kedalam row_array
            return $query->result_array();
        } else {
            return array();
        }   
    }

    //SEARCH SISWA
    public function searchsiswa($id){
        $sql = "SELECT * FROM siswa WHERE nis = ?";
        $result = $this->db->query($sql, $id);
        if($result->num_rows()>0) {
            $result = $result->row_array();
            $v ='<div class="well well-sm">
              <p> Siswa : '.$result['nis'].' / '.$result['nama_lengkap']. ' <span style="color:green" class="glyphicon glyphicon-ok-circle"></span></p>
            </div>'; 
        } else {
            $v = '<div class="well well-sm">
              <p>Tidak ada user ditemukan</p>
            </div>';
        }        
        return $v;
    }

    //SEMUA PESAN BERDASAR NIS
    public function semuapesan($penerima){
        $sql = "SELECT pesan.pengirim AS 'pengirim',pesan.penerima AS 'penerima', pesan.isi AS 'isi',pesan.waktu AS 'waktu' FROM (SELECT * FROM pesan WHERE penerima=? ORDER BY waktu ASC) AS pesan WHERE penerima=? GROUP BY pengirim ORDER BY waktu DESC";
        $result = $this->db->query($sql, array($penerima,$penerima));
        if($result->num_rows()>0){
            return $result->result_array();
        }else{
            return array();
        }
    }

    //UPDATE PASSWORD
    public function updatepassword($param){
        $data = array('password'=>md5($param));
        $this->db->where('nis', $this->session->userdata('nis'));
        $this->db->update('siswa',$data);//EXEC
    }
}