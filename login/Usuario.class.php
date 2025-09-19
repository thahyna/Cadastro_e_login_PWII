<?php
class Usuario{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $pdo;

    public function conecta(){
        $dns  = "mysql:dbname=usuario;host=localhost";
        $user = "root";
        $pass = "";

        try{
            $this->pdo = new PDO($dns, $user, $pass);
            return true;
        }catch (Exception $e){
            echo "<h1>Erro ao conectar";
            return false;
        }
                
    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getSenha(){
        return $this->senha;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

  
    public function cadastraUsuario($nome, $email, $senha){
        #passo 1 - criar uma variavel com a consulta SQL
        $sql = "INSERT INTO usuario SET nome = :n, email = :e, senha = :s";

        #passo 2 - chamar o metodo prepare passando a variavel
        $sql = $this->pdo->prepare($sql);

        #passo 3 - para cada apelido, criar um bindValue
        $sql-> bindValue(":n", $nome);
        $sql-> bindValue(":e", $email);
        $sql-> bindValue(":s", $senha);

        #passo 4 executar o comando
        return $sql->execute();
    }
 public function procurarEmail($email){

        #passo 1 - criar uma variavel com a consulta SQL
        $sql = "SELECT *FROM usuario WHERE email = :e";

        #passo 2 - chamar o metodo prepare passando a variavel
        $sql = $this->pdo->prepare($sql);

        #passo 3 - para cada apelido, criar um bindValue
        $sql-> bindValue(":e", $email);
        
        return $sql->rowCount() > 0;
    }

    public function procuraSenha($senha){

        #passo 1 - criar uma variavel com a consulta SQL
        $sql = "SELECT *FROM usuario WHERE senha = :s";

        #passo 2 - chamar o metodo prepare passando a variavel
        $sql = $this->pdo->prepare($sql);

        #passo 3 - para cada apelido, criar um bindValue
        $sql-> bindValue(":s", $senha);
        
        return $sql->rowCount() > 0;
    }
    

}