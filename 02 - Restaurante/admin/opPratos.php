<?php
require_once 'config.php';

if (!empty($_POST['txt_prato'])) {

  $prato = $_POST['txt_prato'];
  $cardapio = $_POST['txt_cardapio'];
  $foto = $_FILES['file_foto']['name'];
  $foto = str_replace(" ", "", $foto);

  // CAMINHO TEMPORÁRIO

  $foto_temp = $_FILES['file_foto']['tmp_name'];
  $destino = "img/" . $foto;
}

// CADASTRAR 
if (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar') {
  if (move_uploaded_file($foto_temp, $destino)) {
    $insert = $pdo->prepare("INSERT INTO pratos (idcardapio, prato, foto) VALUES (?, ?, ?)"); // NÃO SABEMOS OS VALORES DENTRO
    $insert->bindValue(1, $cardapio); // SELECIONAMOS A POSICAO 1
    $insert->bindValue(2, $prato); // SELECIONAMOS A POSICAO 1
    $insert->bindValue(3, $foto); // SELECIONAMOS  A POSICAO 2 
    $insert->execute(); // EXECUTANDO

    header("Location: pgPratos.php");
  }
}

// EXCLUIR
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
  //echo "Cardápio excluído: id = " . $_GET['id'] . "<br>Foto: " . $_GET['foto'];
  $id = $_GET['id'];
  $foto = $_GET['foto'];

  $del = $pdo->prepare("DELETE FROM pratos WHERE idprato = ?");
  $del->bindValue(1, $id);
  $del->execute();

  unlink('img/' . $foto);
  header("Location: pgPratos.php");
}

// EDITAR
if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
  //echo "Cardápio excluído: id = " . $_GET['id'] . "<br>Foto: " . $_GET['foto'];
  $id = $_GET['id'];
  $fotodb = $_GET['foto'];
  $idcardapio = $_POST['txt_cardapio'];

  // TESTAR
  if ($_FILES['file_foto']['size'] == 0) {
    //echo 'Sem foto';
    $edit = $pdo->prepare("UPDATE pratos SET prato = ?, idcardapio = ? WHERE idprato = ?");
    $edit->bindValue(1, $prato);
    $edit->bindValue(2, $idcardapio);
    $edit->bindValue(3, $id);
    $edit->execute();

    header("Location: pgPratos.php");
  } else {
    //echo 'Mudou a foto';
    unlink('img/' . $fotodb);

    if (move_uploaded_file($foto_temp, $destino)) {
      $edit = $pdo->prepare("UPDATE pratos SET prato = ?, idcardapio = ?, foto = ? WHERE idprato = ?");
      $edit->bindValue(1, $prato);
      $edit->bindValue(2, $idcardapio);
      $edit->bindValue(3, $foto);
      $edit->bindValue(4, $id);
      $edit->execute();

      header("Location: pgPratos.php");
    };
  };

};