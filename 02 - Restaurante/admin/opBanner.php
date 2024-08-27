<?php
require_once 'config.php';

if ($_FILES['file_foto']['size'] != 0) {

  $foto = $_FILES['file_foto']['name'];
  $foto = str_replace(" ", "", $foto);

  // CAMINHO TEMPORÁRIO

  $foto_temp = $_FILES['file_foto']['tmp_name'];
  $destino = "img/" . $foto;
}

// CADASTRAR 
if (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar') {
  if (move_uploaded_file($foto_temp, $destino)) {
    $insert = $pdo->prepare("INSERT INTO banner (foto) VALUES (?)"); // NÃO SABEMOS OS VALORES DENTRO
    $insert->bindValue(1, $foto); // SELECIONAMOS  A POSICAO 2 
    $insert->execute(); // EXECUTANDO

    header("Location: pgBanner.php");
  }
}

// EXCLUIR
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
  //echo "Cardápio excluído: id = " . $_GET['id'] . "<br>Foto: " . $_GET['foto'];
  $id = $_GET['id'];
  $foto = $_GET['foto'];

  $del = $pdo->prepare("DELETE FROM banner WHERE idbanner = ?");
  $del->bindValue(1, $id);
  $del->execute();

  unlink('img/' . $foto);
  header("Location: pgBanner.php");
}

// EDITAR
if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
  //echo "Cardápio excluído: id = " . $_GET['id'] . "<br>Foto: " . $_GET['foto'];
  $id = $_GET['id'];
  $fotodb = $_GET['foto'];

  // TESTAR
  if ($_FILES['file_foto']['size'] == 0) {
    header("Location: pgBanner.php");
  } else {
    //echo 'Mudou a foto';
    unlink('img/' . $fotodb);

    if (move_uploaded_file($foto_temp, $destino)) {
      $edit = $pdo->prepare("UPDATE banner SET foto = ? WHERE idbanner = ?");
      $edit->bindValue(1, $foto);
      $edit->bindValue(2, $id);
      $edit->execute();

      header("Location: pgBanner.php");
    };
  };

};