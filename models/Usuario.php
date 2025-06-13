<?php
require_once __DIR__ . '/../config/database_site.php';
require_once __DIR__ . '/../models/Usuario.php';

class Usuario { // <-- Corrigido aqui!
    private $conn;

    public $nome;
    public $email; 
    public $senha;

    public function __construct() {
        $this->conn = Conexao::conectar();
        
    }

    public function cadastrar() {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        return $stmt->execute([$nome, $email, $senhaHash]);
    }

    public function autenticar($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }

    public function salvarCodigo($email, $codigo) {
        $sql = "UPDATE usuarios SET codigo_recuperacao = ?, codigo_expira = NOW() + INTERVAL 10 MINUTE WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$codigo, $email]);
    }  

    public function verificarCodigo($email, $codigo) {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND codigo_recuperacao = ? AND codigo_expira > NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email, $codigo]);
        return $stmt->fetch();
    }

    public function redefinirSenha($email, $novaSenha) {
        $sql = "UPDATE usuarios SET senha = ?, codigo_recuperacao = NULL, codigo_expira = NULL WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        return $stmt->execute([$senhaHash, $email]);
    }

    // Método para atualizar um usuário sem apagar a imagem existente
    public function update() {
        $query = "UPDATE usuarios SET nome = :nome, email = :email, senha";
    
        if (!empty($this->imagem)) {
            $query .= ", imagem = :imagem";
        }
    
        $query .= " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        
        if (!empty($this->imagem)) {
            $stmt->bindParam(':imagem', $this->imagem);
        }
    
        $stmt->bindParam(':id', $this->id);
    
        return $stmt->execute();
    }
}