<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GameBD extends CI_Controller{
	private $jeux;
	private $isOn = true;

	public function __construct(){
		parent::__construct();
		
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('Model_Genre');
		$this->load->model('Model_Categories');
		$this->load->model('Model_Jeux');

		$this->genres = $this->Model_Genre->getGenres();
		$this->categories = $this->Model_Categories->getCategories();

		$this->filters();

		$this->load->view('layout/header.php');
		$this->load->view('view_nav', ['genres'=>$this->genres, 'categories'=>$this->categories, 'isOn'=>$this->isOn]);
	}

	public function index() {
	    $this->Model_Jeux->updateCount('', []);
	    [$currentPage, $maxPages] = $this->pages();
	    $this->jeux = $this->Model_Jeux->getJeux();
	    $count = $this->Model_Jeux->getCount();
	    $message = $this->calculateMessage();

	    $this->load->view('view_titre', ['count'=>$count, 'message'=>$message]);
	    $this->load->view('view_jeux', ['jeux'=>$this->jeux]);

	    if ($maxPages > 1) {
	        $this->load->view('view_pagesBar', ['currentPage'=>$currentPage, 'maxPages'=>$maxPages]);
	    }
	}

	public function recherche($nom = null) {
	    $nom = base64_decode(strtr($nom, '-_', '+/'));
	    $where = "g.name LIKE ?";
	    $params = ["%{$nom}%"];

	    $this->Model_Jeux->updateCount($where, $params);
	    [$currentPage, $maxPages] = $this->pages();
	    $this->jeux = $this->Model_Jeux->getJeuxParNom($nom);
	    $count = $this->Model_Jeux->getCount();
	    $message = $this->calculateMessage();

	    $this->load->view('view_titre', ['count'=>$count, 'message'=>$message]);
	    $this->load->view('view_jeux', ['jeux'=>$this->jeux]);

	    if ($maxPages > 1) {
	        $this->load->view('view_pagesBar', ['currentPage'=>$currentPage, 'maxPages'=>$maxPages]);
	    }
	}

	public function categorie($filtre = null){
	    $filtre = $this->uri->segment(3);
	    $filtre = base64_decode(strtr($filtre, '-_', '+/'));
	    $found = false;

	    foreach ($this->categories as $cat){
	        if ($cat->description === $filtre){
	            $found = true;
	            $where  = "c.categories LIKE ?";
	            $params = ['%'.str_replace('%20', ' ', $filtre).'%'];
	            $this->Model_Jeux->updateCount($where, $params);
	            [$currentPage, $maxPages] = $this->pages();
	            $this->jeux = $this->Model_Jeux->getJeuxParCategories($filtre);
	            $count = $this->Model_Jeux->getCount();
	            $message = $this->calculateMessage();

	            $this->load->view('view_titre', ['count'=>$count, 'message'=>$message]);
	            $this->load->view('view_jeux', ['jeux'=>$this->jeux]);

	            if ($maxPages > 1) {
	                $this->load->view('view_pagesBar', ['currentPage'=>$currentPage, 'maxPages'=>$maxPages]);
	            }
	            break;
	        }
	    }

	    if (!$found){
	        redirect(site_url());
	    }
	}

	public function genre($filtre = null){
	    $filtre = $this->uri->segment(3);
	    $filtre = base64_decode(strtr($filtre, '-_', '+/'));
	    $found = false;

	    foreach ($this->genres as $ge){
	        if ($ge->description === $filtre){
	            $found = true;
	            $where  = "ge.genres LIKE ?";
	            $params = ['%'.str_replace('%20', ' ', $filtre).'%'];
	            $this->Model_Jeux->updateCount($where, $params);
	            [$currentPage, $maxPages] = $this->pages();
	            $this->jeux = $this->Model_Jeux->getJeuxParGenres($filtre);
	            $count = $this->Model_Jeux->getCount();
	            $message = $this->calculateMessage();

	            $this->load->view('view_titre', ['count'=>$count, 'message'=>$message]);
	            $this->load->view('view_jeux', ['jeux'=>$this->jeux]);

	            if ($maxPages > 1) {
	                $this->load->view('view_pagesBar', ['currentPage'=>$currentPage, 'maxPages'=>$maxPages]);
	            }
	            break;
	        }
	    }

	    if (!$found){
	        redirect(site_url());
	    }
	}

	private function calculateMessage(){
	    $count = $this->Model_Jeux->getCount();
	    $method = $this->router->fetch_method();
	    $filtre = $this->uri->segment(3);

	    if ($filtre) {
	        $filtre = base64_decode(strtr($filtre, '-_', '+/'));
	    }

	    if ($count < 1) {
	        switch ($method) {
	            case 'recherche':
	                return 'Aucun résultat trouvé pour "'.htmlspecialchars($filtre).'".';
	            case 'categorie':
	                return 'Aucun résultat trouvé pour la catégorie "'.htmlspecialchars($filtre).'".';
	            case 'genre':
	                return 'Aucun résultat trouvé pour le genre "'.htmlspecialchars($filtre).'".';
	            default:
	                return 'Aucun résultat trouvé.';
	        }
	    }

	    switch ($method) {
	        case 'recherche':
	            $message = 'Recherche : "'.htmlspecialchars($filtre).'"';
	            break;
	        case 'categorie':
	            $message = 'Catégorie : '.htmlspecialchars($filtre);
	            break;
	        case 'genre':
	            $message = 'Genre : '.htmlspecialchars($filtre);
	            break;
	        default:
	            $message = 'GameBD';
	    }

	    return $message;
	}

	private function pages(){
		$currentPage = $this->Model_Jeux->getPage();
		$maxPages = ceil($this->Model_Jeux->getCount()/$this->Model_Jeux->getPerPage());
		$newPage =  filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT, ['options' => ['min_range'=>1, 'max_range'=>$maxPages]]);

		if ($newPage === false || $newPage === null){
		    $newPage = $currentPage;
		}

		$this->Model_Jeux->setPage($newPage);
		return [$newPage, $maxPages];
	}

	private function filters(){
		$allowedSorts = ['name'=>'g.name', 'date'=>'g.releaseYear'];
        $allowedOrders = ['asc', 'desc'];

		$sort = $this->input->get('sort');
    	$order = $this->input->get('order');

    	if ($sort !== null && $order !== null) {
	        $sort  = strtolower($sort);
	        $order = strtolower($order);

	        if (isset($allowedSorts[$sort]) && in_array($order, $allowedOrders)){
				$this->Model_Jeux->setSort($allowedSorts[$sort], $order);
			}
		}
	}
}
