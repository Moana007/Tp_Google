<?php
class News_model extends CI_Model{

	protected $table = 'zinsearchbot';

	public function ajouter_lien()
	{

		if(empty($this->input->post('lien'))){
			$site = 'http://www.yahoo.fr';
		} else {
			$site = $this->input->post('lien');
		}


		return $this->db->set('adresse', $site)
						->set('date', 'NOW()', false)
						->insert($this->table);


	}

}