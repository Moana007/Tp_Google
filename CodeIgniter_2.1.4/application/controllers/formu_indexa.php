<?php

class Formu_indexa extends CI_Controller //class
{

	public function __construct(){ 

	       //  Obligatoire 
	       parent::__construct(); 
	}

    public function index() //methode
    {
        $this->formu_indexation();
    }
    
    public function formu_indexation()
    {
    	$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('formu_indexa');
		}
		else
		{
			$this->load->view('formu_indexa');

		}
        
        //$this->load->view('formu_indexa', $data);
    }

    public function insert(){

		$this->load->model('news_model');

		if( $this->input->post('submit') ) {
        	$this->news_model->ajouter_lien();
    	}

    	$this->load->view('test_view');
    }

}