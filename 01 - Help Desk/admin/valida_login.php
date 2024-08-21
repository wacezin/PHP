<?php
     //echo'Teste OK!';   
    //  print_r($_POST);

    //  echo '<br>';

    //  echo $_GET['email'];
    //  echo '<br>';
    //  echo $_GET['senha'];

    session_start();
    
    $usuarios_autenticado = false;
    $usuarios_id = null;
    $usuarios_perfil_id = null;

    $perfis = array(
        1 => 'Administrativo',
        2 => 'Usuário'
    );

    $usuarios_app = array(
                    array('id' => 1, 'email' => 'admin@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
                    array('id' => 2, 'email' => 'user@teste.com.br', 'senha' => 'abcd', 'perfil_id' => 1),
                    array('id' => 3, 'email' => 'cassio@cassio.com.br', 'senha' => '1234', 'perfil_id' => 2)
                );

    foreach($usuarios_app as $user){
        if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']){
            $usuarios_autenticado = true;
           $usuarios_id = $user['id']; 
           $usuarios_perfil_id = $user['perfil_id'];
        }
    };

    if($usuarios_autenticado){
        //echo 'Usuário autenticado com sucesso';
        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['id'] = $usuarios_id;
        $_SESSION['perfil_id'] = $usuarios_perfil_id;
        header('Location:home.php' );
    }else{
        //echo 'ERRO de autenticação';
        $_SESSION['autenticado'] = 'NÃO';
        header('Location:index.php?login=erro' );
    }
?>