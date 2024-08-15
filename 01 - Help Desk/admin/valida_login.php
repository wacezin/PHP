<?php
     //echo'Teste OK!';   
    //  print_r($_POST);

    //  echo '<br>';

    //  echo $_GET['email'];
    //  echo '<br>';
    //  echo $_GET['senha'];

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
        echo 'Usuário autenticado com sucesso';
    }else{
        //echo 'ERRO de autenticação';
        header('Location: index.php?login=erro' );
    }


?>