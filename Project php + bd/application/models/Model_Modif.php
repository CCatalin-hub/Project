<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Modif extends CI_Model{
    public function ModifierJeux($name, $data=null, $DevelopeurName=null) {

        $idDevelopeurNeuf= $this->modifDevelopeur($DevelopeurName);
        $data['developerId']=$idDevelopeurNeuf;
        $this->db->where('name', $name);

        return $this->db->update('game', $data);
    }

    public function modifDevelopeur($DevelopeurName=null) {

        $idPresente= $this->qweryBuilderModifRow($DevelopeurName,"id", "developer", "name");
        if($idPresente->id !== null && !empty($idPresente->id)){
            return $idPresente->id;
        }
        else{
            do {
                $idDevelopeurNeuf = random_int(1, 100000);
                $test = $this->qweryBuilderModifRow($idDevelopeurNeuf, "name", "developer", "id");} 
            while ($test !== null);

            $nouveauDev = array('id'=>$idDevelopeurNeuf, 
                                'name'=>$DevelopeurName);

            $this->db->insert('developer', $nouveauDev);
            return $idDevelopeurNeuf;
        }
    }

    public function modifCategoriesGenre($name, $table, $type) {
        //type va renplace le "category" et "genre" aussi dans le nomme de variable

        $IdJeux= $this->qweryBuilderModifRow($name, "id", "game", "name");

        $ListeIdJeux= $this->qweryBuilderModifResult($IdJeux->id, $type."Id", "game_".$type, "gameId"); //get Categories/Genre Jeux
        for($i= 0; $i < count($table); $i++){
            $resultat_objet= $this->qweryBuilderModifRow($table[$i], "id", $type, "description"); //getId Categories/Genre
            if($resultat_objet !== null) {
                $ListeIdJeuxDeBD[]= $resultat_objet->id; 
            }
        }

        $anciensIdEnBD = array();
        foreach($ListeIdJeux as $typeEnBD) {
            $anciensIdEnBD[] = $typeEnBD->{$type."Id"}; 
        }

        if(!empty($table)){
            for($i = 0; $i < count($anciensIdEnBD); $i++){
                if(!in_array($anciensIdEnBD[$i], $ListeIdJeuxDeBD)){
                    $this->db->where('gameId', $IdJeux->id); 
                    $this->db->where( $type.'Id', $anciensIdEnBD[$i]);
                    $this->db->delete('game_'.$type);
                } 
            }
            for($i = 0; $i < count($ListeIdJeuxDeBD); $i++){
                if(!in_array($ListeIdJeuxDeBD[$i], $anciensIdEnBD)){
                    $listeNeufDone = array('gameId'=>$IdJeux->id,
                                            $type.'Id'=>$ListeIdJeuxDeBD[$i]);
                    $this->db->insert('game_'.$type, $listeNeufDone);
                } 
            }
        }
    }

    public function ajouetCategoriesGenre($name, $table, $type) {
        $IdJeux= $this->qweryBuilderModifRow($name, "id", "game", "name");

        if(empty($table)){
            return;
        }

        $ListeIdJeuxDeBD = array();

        for($i= 0; $i < count($table); $i++){
            $resultat_objet= $this->qweryBuilderModifRow($table[$i], "id", $type, "description"); //getId Categories/Genre
            if($resultat_objet !== null) {
                $ListeIdJeuxDeBD[]= $resultat_objet->id; 
            }
        }
        for($i = 0; $i < count($ListeIdJeuxDeBD); $i++){
            $listeNeufDone = array('gameId'=>$IdJeux->id,
                $type.'Id'=>$ListeIdJeuxDeBD[$i]);
            $this->db->insert('game_'.$type, $listeNeufDone);
        }
    }

    public function CreerJeux($liste, $DevelopeurName) {

        do {
            $idJeuxNeuf = random_int(1, 100000);
            $test = $this->qweryBuilderModifRow($idJeuxNeuf, "name", "game", "id");} 
            while ($test !== null);

        $liste['id']=$idJeuxNeuf;
        $liste['developerId']= $this->modifDevelopeur($DevelopeurName);
        $liste['posterId']= 557;
        
        return $this->db->insert('game', $liste);
       
    }

    public function SuprimerJeux($name) {
        $IdJeux = $this->qweryBuilderModifRow($name, "id", "game", "name");

        if ($IdJeux === null || empty($IdJeux->id)) {
            return false;
        }

        $this->db->where('gameId', $IdJeux->id);
        $this->db->delete('game_genre');

        $this->db->where('gameId', $IdJeux->id);
        $this->db->delete('game_category');

        $this->db->where('id', $IdJeux->id);
        return$this->db->delete('game');
    }

    public function qweryBuilderModifRow($variable, $cologne, $table, $option) {
        $sql = "SELECT ".$cologne." FROM ".$table." WHERE ".$option." = ?";
        return $this->db->query($sql, $variable)->row();
    }

    public function qweryBuilderModifResult($variable, $cologne, $table, $option) {
        $sql = "SELECT ".$cologne." FROM ".$table." WHERE ".$option." = ?";
        return $this->db->query($sql, $variable)->result();
    }

}
