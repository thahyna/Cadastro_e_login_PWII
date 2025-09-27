<?php
session_start();
require 'Usuario.class.php';

$usuario = new Usuario();
$con = $usuario->conecta();

// Cadastro
if(isset($_POST['cadastrar'])) {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($con){
        if(!$usuario->procurarEmail($email)){
            if($usuario->cadastraUsuario($nome, $email, $senha)){
                echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar usuário');</script>";
            }
        } else {
            echo "<script>alert('Usuário já existe');</script>";
        }
    }
}

// Login
if(isset($_POST['entrar'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($con){
        $user = $usuario->procurarUsuarioPorEmail($email);
        if($user){
            $pass = $usuario->procuraSenha($senha);
            if($pass){
                $_SESSION['email'] = $email;
                echo header("location:home.php");
            } else {
                echo "<script>alert('Senha incorreta');</script>";
            }
        } else {
            echo "<script>alert('Usuário Imcoorreto');</script>";
        }
    }
}
?>