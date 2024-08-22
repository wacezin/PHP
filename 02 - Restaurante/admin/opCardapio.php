<?php
    require_once 'config.php';

    if(!empty($_POST['txt_cardapio'])){

      $cardapio = $_POST['txt_cardapio'];
      $foto = $_FILES['file_foto']['name'];
      $foto = str_replace(" ", "", $foto);

      // CAMINHO TEMPORÁRIO

      $foto_temp = $_FILES['file_foto']['tmp_name'];
      $destino = "img/". $foto;

      if(move_uploaded_file($foto_temp, $destino)){
        $insert = $pdo->prepare("INSERT INTO cardapios (cardapios, foto) VALUES (?, ?)"); // NÃO SABEMOS OS VALORES DENTRO
        $insert->bindValue(1, $cardapio); // SELECIONAMOS A POSICAO 1
        $insert->bindValue(2, $foto); // SELECIONAMOS  A POSICAO 2 
        $insert->execute(); // EXECUTANDO

        header("Location: pgCardapio.php");
      }

    }
    //echo "Cardápio: " . $cardapio . "<br> Foto: " . $foto;
