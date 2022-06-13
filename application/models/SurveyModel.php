<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SurveyModel extends CI_Model {

	private $tableName = 'survey';

	public function save($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function get(){
		$this->db->order_by('id_survey', 'asc');
		return $this->db->get($this->tableName);
	}

	public function delete($id){
		$this->db->where('id_survey', $id);
		return $this->db->delete($this->tableName);
	}

}

/* End of file SurveyModel.php */
/* Location: ./application/models/SurveyModel.php */