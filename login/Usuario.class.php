<?php
    require'Usuario.class.php';
    $usuario = new Usuario();
    $con = $usuario->conecta();

if(isset($_POST['cadastrar'])){
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($con){
        $teste = $usuario->procurarEmail($email);
        if(!$teste){
            $sucesso = $usuario->cadastraUsuario($nome, $email, $senha);
            
            if($sucesso){
                echo "<script>alert('Usuario cadastrado com SUCESSO')</script>";
            }else{
                echo "<script>alert('Nao consegui cadastrar o Usuario')</script>";
            }
        }else{
            echo "<script>alert('Esse usuario ja existe')</script>";
        }

    }else{
        echo "<script>alert('Nao consegui CONECTAR com o banco. Tente mais tarde!')</script>";
        exit;
    }
}elseif( isset($_POST['entrar']) ){
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if( $con ){
        $user = $usuario -> procurarEmail($email);
        if( $user ){
            $pass = $usuario->procuraSenha($senha);
            if( $pass ){
                $_SESSION['nome'] = $nome;
                echo header("location:home.php");
            }else{
                echo"<script>alert('Senha Incorreta')</script>";
            }
        }else{
            echo"<script>alert('Usuario Incorreto')</script>";
        }
    }
}
?>