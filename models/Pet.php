<?php
// Class ligada com o banco de dados

require_once '../config/database_site.php'; // Conectar páginas

class Pet {
    private $conn; // Variável de conexão com o banco de dados
    private $table_name = "pets";

    public $id;
    public $nome;
    public $raca;
    public $idade;
    public $porte;
    public $peso;
    public $sexo;
    public $imagem;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para salvar um pet
    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (nome, raca, idade, porte, peso, sexo, imagem,) 
                  VALUES (:nome, :raca, :idade, :porte, :peso, :sexo, :imagem)";
        $stmt = $this->conn->prepare($query);
    
        // Vinculando os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':raca', $this->raca);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':porte', $this->porte);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':sexo', $this->sexo);
        $stmt->bindParam(':imagem', $this->imagem);
    
        // Executa a consulta
        return $stmt->execute();
    }

    // Método para listar todos os pets
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar um pet pelo ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id"; // Corrigido o nome da coluna
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para atualizar um pet
    public function update() {
        $query = "UPDATE pets SET nome = :nome, raca = :raca, idade = :idade, porte = :porte, peso = :peso, sexo = :sexo, imagem = :imagem WHERE id = :id"; // Corrigido a query
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':raca', $this->raca);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':porte', $this->porte);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':sexo', $this->sexo);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(':id', $this->id); // Agora bindamos o ID corretamente

        return $stmt->execute();
    }

    // Método para excluir um pet pelo ID
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id"; // Corrigido o nome do parâmetro
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id); // Corrigido o nome da variável

        return $stmt->execute();
    }
}