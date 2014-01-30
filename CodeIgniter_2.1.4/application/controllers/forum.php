<?php

class Forum extends CI_Controller //class
{
	public function __construct(){ 

	       //  Obligatoire 
	       parent::__construct(); 
	}

    public function index() //methode
    {
        // echo 'Hello World! (index) ';
        $this->manger();
    }
    // public function fourbe()
    // {
    // 	$this->load->view('form_indexa');
    // }
    public function manger()
    {
    	$data = array();
        $data['pseudo'] = 'Arthur';
        $data['email'] = 'email@ndd.fr';
        $data['en_ligne'] = true;
        
        $this->load->view('fourbe', $data);
    }

    // public function _output($output)
    // {
    //     var_dump($output);
    // }
}