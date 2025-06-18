<?php
// Class ligada com o banco de dados

require_once '../config/database_site.php'; // Conectar páginas

class Ficha {
    private $conn; // Variável de conexão com o banco de dados
    private $table_name = "ficha_tecnica";

    public $id;

    public function __construct() {
        try {
            $database = new Database();
            $this->conn = $database->getConnection();

            // Verifica se a conexão foi bem-sucedida
            if (!$this->conn) {
                throw new Exception("Falha ao conectar com o banco de dados.");
            }
        } catch (PDOException $e) {
            die("Erro na conexão PDO: " . $e->getMessage());
        } catch (Exception $e) {
            die("Erro: " . $e->getMessage());
        }
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
