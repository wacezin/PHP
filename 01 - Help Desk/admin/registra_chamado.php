<?php
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    //$texto = $_POST['titulo'] . $_POST['categoria'] . $_POST['descricao'];

    $titulo = str_replace('#', '-', $_POST['titulo']);
    $categoria = str_replace('#', '-', $_POST['categoria']);
    $descricao = str_replace('#', '-', $_POST['descricao']);

    $texto = $titulo . '#' . $categoria . '#' . $descricao . PHP_EOL;
    //echo $texto;
    
    // ABRIR O ARQUIVO
    $arquivo = fopen('arquivo.txt', 'a');

    // ESCREVA O TEXTO NO ARQUIVO
    fwrite($arquivo, $texto);

    // FECHANDO O ARRQUIVO
    fclose($arquivo);

    // REDIRECIONAR
    header('Location: abrir_chamado.pxp');
?>