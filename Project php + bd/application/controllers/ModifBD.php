<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModifBD extends CI_Controller{
	private $isOn = false;
	

	public function __construct(){
		parent::__construct();
		
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('Model_Genre');
		$this->load->model('Model_Categories');
		$this->load->model('Model_Jeux');
		$this->load->model('Model_Modif');

		$this->genres = $this->Model_Genre->getGenres();
		$this->categories = $this->Model_Categories->getCategories();

		$this->load->view('layout/header.php');
		$this->load->view('view_nav', ['genres'=>$this->genres, 'categories'=>$this->categories, 'isOn'=>$this->isOn]);

	}

	public function index($nom=null){
		$nom_decode = base64_decode(strtr($nom, '-_', '+/'));
		
		$liste['jeu'] = $this->Model_Jeux->DonneJeux($nom_decode); 

		$this->load->view('view_page_jeu', $liste);
	}

	public function modifier($nom=null) {
		$nom_decode = base64_decode(strtr($nom, '-_', '+/'));

		$liste['tous_les_genres'] = $this->genres;
    	$liste['toutes_les_categories'] = $this->categories;

		$liste['jeu'] = $this->Model_Jeux->DonneJeux($nom_decode);

		$this->load->view('view_modifier_jeu', $liste);
	}

	public function valider($nom = null){

	    $nom_decode = base64_decode(strtr($nom, '-_', '+/'));

		$note_metacritic = $this->input->post('note_metacritic');
		$metacritic_null = $this->input->post('metacritic_null');

		if ($metacritic_null || $note_metacritic == '') {
    		$metacritic = null;
		} 
		else {
    		$metacritic = (int)$note_metacritic;};

	    $DonneesFormulaire = array('name'=> $this->input->post('nom_jeu'),
	        						'metacritic'=> $metacritic,
	        						'releaseYear'=> $this->input->post('anne'),
	        						'windows'=> $this->input->post('check_windows') ? 1 : 0,
	        						'mac'=> $this->input->post('check_mac') ? 1 : 0,
	        						'linux'=> $this->input->post('check_linux') ? 1 : 0,
	        						'price'=> $this->input->post('prix'),
	        						'shortDescription'=> $this->input->post('description_jeu'));

	    $DevelopeurName = $this->input->post('developer_jeu');
	    $GenresDonne = $this->input->post('genres') ?? array();
	    $CategoriesDonne = $this->input->post('categories') ?? array();

	    $this->Model_Modif->ModifierJeux($nom_decode, $DonneesFormulaire, $DevelopeurName);
	    $this->Model_Modif->modifCategoriesGenre($DonneesFormulaire['name'], $GenresDonne, "genre");
	    $this->Model_Modif->modifCategoriesGenre($DonneesFormulaire['name'], $CategoriesDonne, "category");

	    redirect('ModifBD/index/'.rtrim(strtr(base64_encode($DonneesFormulaire['name']), '+/', '-_'), '='));
	}

	public function ajouter() {

	    $liste['tous_les_genres']= $this->genres;
    	$liste['toutes_les_categories']= $this->categories;

	    $liste['jeu'] = (object)['name'=>'',
	    				'metacritic'=>'',
	        			'releaseYear'=>'',
	        			'price'=>'',
	        			'shortDescription'=>'',
	        			'developer_name'=>'',
	        			'windows'=>0,
	        			'mac'=>0,
	        			'linux'=>0,
	        			'genres'=>'',
	        			'categories'=>'',
	        			'poster_jpeg' =>null];

		$this->load->view('view_modifier_jeu', $liste);
	}

	public function valider_ajouter() {

	    $note_metacritic = $this->input->post('note_metacritic');
		$metacritic_null = $this->input->post('metacritic_null');

		if ($metacritic_null || $note_metacritic === '') {
    		$metacritic = null;
		} 
		else {
    		$metacritic = (int)$note_metacritic;};

	    $DevelopeurName = $this->input->post('developer_jeu');
	    $GenresDonne = $this->input->post('genres') ?? array();
	    $CategoriesDonne = $this->input->post('categories') ?? array();

	    $DonneesFormulaire =  array('name'=> $this->input->post('nom_jeu'),
	        						'metacritic'=> $metacritic,
	        						'releaseYear'=> $this->input->post('anne'),
	        						'windows'=> $this->input->post('check_windows') ? 1 : 0,
	        						'mac'=> $this->input->post('check_mac') ? 1 : 0,
	        						'linux'=> $this->input->post('check_linux') ? 1 : 0,
	        						'price'=> $this->input->post('prix'),
	        						'shortDescription'=> $this->input->post('description_jeu'));

	    $this->Model_Modif->CreerJeux($DonneesFormulaire, $DevelopeurName);
	   	$this->Model_Modif->ajouetCategoriesGenre($DonneesFormulaire['name'], $GenresDonne, "genre");
	    $this->Model_Modif->ajouetCategoriesGenre($DonneesFormulaire['name'], $CategoriesDonne, "category");

		redirect('ModifBD/index/'.rtrim(strtr(base64_encode($DonneesFormulaire['name']), '+/', '-_'), '='));

	}

	public function suprimer($nom = null){
		$nom_decode = base64_decode(strtr($nom, '-_', '+/'));

		$resultat=$this->Model_Modif->SuprimerJeux($nom_decode);

		if (!$resultat){redirect('ModifBD/index/'.rtrim(strtr(base64_encode($nom_decode), '+/', '-_'), '='));}

		redirect('GameBD/index/');
	}
}