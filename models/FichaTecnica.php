<?php
// Class ligada com o banco de dados

require_once '../config/database_site.php'; // Conectar páginas

class Ficha {
    private $conn; // Variável de conexão com o banco de dados
    private $table_name = "ficha_tecnica";

    public $id;

     public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
