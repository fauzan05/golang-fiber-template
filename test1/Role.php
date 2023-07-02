<?php


class Role{
    
//Membuat class role dengan visibility private
private string $IdRole;
private string $NameRole;
private string $Keterangan;

//Membuat setter IdRole
public function setIdRole($IdRole){
$this->IdRole = $IdRole;
}
//Membuat getter IdRole
public function getIdRole(){
return $this->IdRole;
}

//Membuat setter NameRole
public function setNameRole($NameRole){
$this->NameRole = $NameRole;
}
//Membuat getter NameRole
public function getNameRole(){
return $this->NameRole;
}

//Membuat setter Keterangan
public function setKeterangan($Keterangan){
$this->Keterangan = $Keterangan;
}
//Membuat getter Keterangan
public function getKeterangan(){
return $this->Keterangan;
}

public function saveAll(){

}

}

