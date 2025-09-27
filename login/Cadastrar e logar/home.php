<?php
session_start();

if( isset($_SESSION['nome']) ){
    $nome = $_SESSION['nome'];
    echo "Ola $nome. Bem vindo à minha Página";
}else{
    echo "<script>alert('Voce nao esta logado')</script";
}