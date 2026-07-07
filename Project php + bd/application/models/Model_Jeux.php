<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Jeux extends CI_Model{
    private $page = 1;
    private $perPage = 20;
    private $orderBy = 'g.name ASC';
    private $count = 0;
    private $sql="
        SELECT
            g.name,
            g.releaseYear,
            g.shortDescription,
            g.price,
            g.windows,
            g.linux,
            g.mac,
            g.metacritic,
            d.name AS developer_name,
            p.jpeg AS poster_jpeg,
            ge.genres,
            c.categories
        FROM game g
        JOIN developer d ON g.developerId = d.id
        JOIN poster p ON g.posterId = p.id
        LEFT JOIN (
            SELECT gg.gameId,
            GROUP_CONCAT(DISTINCT ge.description ORDER BY ge.description SEPARATOR ', ') AS genres
            FROM game_genre gg
            JOIN genre ge ON ge.id = gg.genreId
            GROUP BY gg.gameId
        ) ge ON ge.gameId = g.id
        LEFT JOIN (
            SELECT gc.gameId,
            GROUP_CONCAT(DISTINCT c.description ORDER BY c.description SEPARATOR ', ') AS categories
            FROM game_category gc
            JOIN category c ON c.id = gc.categoryId
            GROUP BY gc.gameId
        ) c ON c.gameId = g.id";

    public function __construct(){
        $this->load->database();
    }

    public function setPage($page){
        $this->page = $page;
    }

    public function setSort($sort, $order){
        $this->orderBy = $sort.' '.$order;
    }

    public function getJeux(){
       return $this->qweryBuilder('', []);
    }

    public function getCount(){
        return $this->count;
    }

    public function getPage(){
        return $this->page;
    }

    public function getPerPage(){
        return $this->perPage;
    }

    public function getJeuxParGenres($genre){
        $where = '';
        $params = [];

        if (!empty($genre)){
            $where = "ge.genres LIKE ?";
            $params[] = '%'.str_replace('%20', ' ', $genre).'%';
        }

        return $this->qweryBuilder($where, $params);
    }

    public function getJeuxParCategories($categorie){
        $where = '';
        $params = [];

        if (!empty($categorie)){
            $where = "c.categories LIKE ?";
            $params[] = '%'.str_replace('%20', ' ', $categorie).'%';
        }

        return $this->qweryBuilder($where, $params);
    }

    public function getJeuxParNom($nom){
        return $this->qweryBuilder("g.name LIKE ?", ["%{$nom}%"]);
    }

    public function updateCount($where, $params){
        $sql = $this->sql;

        if (!empty($where)){
            $sql .= ' WHERE '.$where;
        }

        $countSql = "SELECT COUNT(*) AS total FROM ({$sql}) AS counted";

        $this->count = (int) $this->db->query($countSql, $params)->row()->total;
    }

    private function qweryBuilder($where, $params){
        $sql = $this->sql;
        $this->offset = ($this->page-1)*$this->perPage;
        
        $this->updateCount($where, $params);

        if (!empty($where)){
            $sql .= ' WHERE '.$where;
        }

        $sql .= ' ORDER BY '.$this->orderBy;
        $sql .= ' LIMIT ? OFFSET ?';

        $params[] = $this->perPage;
        $params[] = ($this->page-1)*$this->perPage;

        return $this->db->query($sql, $params)->result();
    }

    public function DonneJeux($name) {
        $sql = $this->sql;

        $sql.=" WHERE g.name = ".'"'.$name.'";';
        return $this->db->query($sql)->row();
    }

}
