<?php

class ContactsQS{

    public function get_contacts_qs(){
        return "SELECT * FROM contacts";
    }

    public function set_contacts_qs($nombre, $apellido, $email, $telefonos){
        return "INSERT INTO contacts (nombre, apellido, email, telefonos) VALUES ('{$nombre}', '{$apellido}', '{$email}', '{$telefonos}')";
    }

    public function delete_contacts_qs($id){
        return "DELETE FROM contacts WHERE id = {$id}";
    }  

}