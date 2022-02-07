<?php

require("./core/libs/conexion.php");
require("./qs/qs_contacts.php");

class Contacts{

    public function getContacts(){
        $qs = new ContactsQS();
        $sql  = $qs->get_contacts_qs();

        $conn = new Conexion();
        $result = $conn->consultar($sql);
        return $result;
    }

    public function setContacts($nombre, $apellido, $email, $telefonos){
        $qs = new ContactsQS();
        $sql  = $qs->set_contacts_qs($nombre, $apellido, $email, $telefonos);

        $conn = new Conexion();
        $result = $conn->ejecutar($sql);
        return $result;
    }

    public function deleteContacts($id){
        $qs = new ContactsQS();
        $sql  = $qs->delete_contacts_qs($id);

        $conn = new Conexion();
        $result = $conn->ejecutar($sql);
        return $result;

    }

}