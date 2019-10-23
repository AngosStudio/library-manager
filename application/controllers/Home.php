<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends LB_Controller {
	public function index(){
		$this->load->model('genre_model', '_genre');
		$this->data['genres'] = $this->_genre->getAll();
		$this->loadPagina('home');
	}
}
