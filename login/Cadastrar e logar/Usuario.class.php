<?php
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $pdo;

    public function conecta() {
        $dns  = "mysql:dbname=usuario;host=localhost";
        $user = "root";
        $pass = "";

        try {
            $this->pdo = new PDO($dns, $user, $pass);
            return true;
        } catch (Exception $e) {
            echo "<h1>Erro ao conectar: ".$e->getMessage()."</h1>";
            return false;
        }
    }

    public function cadastraUsuario($nome, $email, $senha) {
        $sql = "INSERT INTO usuario SET nome = :n, email = :e, senha = :s";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", $senha);
        return $sql->execute();
    }

    public function procurarEmail($email) {
        $sql = "SELECT * FROM usuario WHERE email = :e";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":e", $email);
        $sql->execute();
        return $sql->rowCount() > 0;
    }

    public function procurarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuario WHERE email = :e";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":e", $email);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function procuraSenha($senha){
        $sql = "SELECT * FROM usuario WHERE senha = :s";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":e", $senha);
        return $sql->rowCount() > 0;
    }
}