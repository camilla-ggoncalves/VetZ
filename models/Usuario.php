<?php
require_once __DIR__ . '/../config/database_site.php';
require_once __DIR__ . '/../models/Usuario.php';

class Usuario { // <-- Corrigido aqui!
    private $conn;

    public $nome;
    public $email; 
    public $senha;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();  
        
    }

   public function cadastrar($nome, $email, $senha) {
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $this->conn->prepare($sql); 
                
    // Hash da senha antes de salvar
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senhaHash);

    return $stmt->execute();
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

    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $email, $senha, $imagem = null) {
        if ($imagem) {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, imagem = :imagem WHERE id = :id";
        } else {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        if ($imagem) {
            $stmt->bindParam(':imagem', $imagem);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

