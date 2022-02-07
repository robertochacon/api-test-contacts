<?php

require('./models/contacts.php');

if(isset($_GET['url'])){

    $url = $_GET['url'];

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        switch($url){
            case 'contacts':
                $contacts = new Contacts();
                echo json_encode($contacts->getContacts());
                http_response_code(200);
            break;
    
            default:
                echo json_encode(['message'=>'metodo no encontrado.']);
                http_response_code(404);
            break;
    
        }
    
    }else if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $postBody = file_get_contents("php://input");
        $request =  json_decode($postBody, true);

        if(json_last_error()==0){

            switch($url){
                case 'contacts':

                    $nombre = $request['nombre'];
                    $apellido = $request['apellido'];
                    $email = $request['email'];
                    $telefonos_request = $request['telefonos'];

                    $telefonos = array();
                    foreach ($telefonos_request as $telefono) {
                      array_push($telefonos, $telefono);
                    }
                    $telefonos_total = implode(",", $telefonos);

                    if( empty($nombre) || empty($apellido) || empty($email) || count($telefonos_request) <= 0 ){
                        echo json_encode(['message'=>'bad request']);
                        http_response_code(400);
                        return;
                    }

                    $contacts = new Contacts();
                    $result = $contacts->setContacts($nombre, $apellido, $email, $telefonos_total);

                    if($result){
                        echo json_encode(['message'=>'ok']);
                        http_response_code(200);
                    }else{
                        echo json_encode(['message'=>'fail']);
                        http_response_code(500);
                    }
                    

                break;

                default:
                    echo json_encode(['message'=>'metodo no encontrado.']);
                    http_response_code(404);
                break;
            }
    
    
        }else{
            http_response_code(400);
        }
    
    }else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

        $postBody = file_get_contents("php://input");
        $request =  json_decode($postBody, true);

        if(json_last_error()==0){

            switch($url){
                case 'contacts':

                    $id = $request['id'];

                    $contacts = new Contacts();
                    $result = $contacts->deleteContacts($id);

                    if($result){
                        echo json_encode(['message'=>'ok']);
                        http_response_code(200);
                    }else{
                        echo json_encode(['message'=>'fail']);
                        http_response_code(500);
                    }
                    

                break;

                default:
                    echo json_encode(['message'=>'metodo no encontrado.']);
                    http_response_code(404);
                break;
            }
    
    
        }else{
            http_response_code(400);
        }
    
    }else {
        http_response_code(405);
    }


}else{

}