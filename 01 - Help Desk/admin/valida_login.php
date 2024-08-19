<?php
     //echo'Teste OK!';   
    //  print_r($_POST);

    //  echo '<br>';

    //  echo $_GET['email'];
    //  echo '<br>';
    //  echo $_GET['senha'];

    session_start();
    
    $usuarios_autenticado = false;

    $usuarios_app = array(
                    array('email' => 'admin@teste.com.br', 'senha' => '1234'),
                    array('email' => 'user@teste.com.br', 'senha' => 'abcd')
                );

    foreach($usuarios_app as $user){
        if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']){
            $usuarios_autenticado = true;
        }
    };

    if($usuarios_autenticado){
        //echo 'Usuário autenticado com sucesso';
        $_SESSION['autenticado'] = 'SIM';
        header('Location:home.php' );
    }else{
        //echo 'ERRO de autenticação';
        $_SESSION['autenticado'] = 'NÃO';
        header('Location:index.php?login=erro' );
    }
?>