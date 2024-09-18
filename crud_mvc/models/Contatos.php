<?php 
class Contatos extends model{
    
    public function getAll(){
        $array = array();
        $sql = "SELECT * FROM contatos";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function add($nome, $email){
        if($this->emailExists($email) == false){
            $sql = "INSERT INTO contatos(nome, email) VALUE (:nome, :email)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->execute();
        }
    }

    public function emailExists($email){
        $sql = "SELECT * FROM contatos WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}