<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	public $tableName = 'user';

	public function tambah($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function get_by_email($email){
		$this->db->where('email_user', $email);
		return $this->db->get($this->tableName);
	}

	public function get_user($email,$password){
		$this->db->where('email_user', $email);
		$this->db->where('password', $password);
		return $this->db->get($this->tableName);
	}

	public function update($email,$data){
		$this->db->where('email_user', $email);
		$this->db->update($this->tableName, $data);
	}

	public function get_marketing(){
		$this->db->where('level', 'tim_marketing');
		return $this->db->get($this->tableName);
	}

	public function get_marketing_by_id($id){
		$this->db->where('id_user', $id);
		return $this->db->get($this->tableName);
	}

	public function insert_marketing($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function update_marketing($id,$data){
		$this->db->where('id_user', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function delete_marketing($id){
		$this->db->where('id_user', $id);
		return $this->db->delete($this->tableName);
	}

}

/* End of file RegisterModel.php */
/* Location: ./application/models/RegisterModel.php */