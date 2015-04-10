<?php

// Data
$data                 = array();
//$data['base_url']     = 'http://'.$_SERVER['HTTP_HOST']."/";
$data['base_url']     = 'http://'.$_SERVER['HTTP_HOST']."/hsf/public/";
$data['current_url']  = $data['base_url'].trim($app->request->getResourceUri(), '/');

$app->get('/', function() use ($app, $data) {
    $app->render('index.html', $data);
})->name('home');

$app->get('/institucion', function() use ($app, $data) {
    $app->render('institucion.html', $data);
})->name('institucion');

$app->get('/medicos', function() use ($app, $data) {
    $app->render('medicos.html', $data);
})->name('medicos');

$app->get('/pacientes', function() use ($app, $data) {
    $app->render('pacientes.html', $data);
})->name('pacientes');

$app->post('/send-email', function() use($app){

  if($app->request->isAjax() && $app->request->isPost()){

    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $message = $app->request->post('message');


    $response = array('status'=>'error');

    try{


    //Create a new PHPMailer instance
        $mail = new PHPMailer(false);
        //$mail->IsMail();
        $mail->CharSet = 'UTF-8';
        //Set who the message is to be sent from
        $mail->setFrom('no-reply@hospitalsanfelipe.com.mx', "Hospital San Felipe");
        //Set an alternative reply-to address
        $mail->addReplyTo($email, $name);
        //Set who the message is to be sent to
        //$mail->addAddress('#', 'Title');
        $mail->addAddress('gerardo.gonzalez@dinkbit.com', 'Hospital San Felipe');
        //Set the subject line
        $mail->Subject = 'Contacto de Hospital San Felipe. De: '.$name. " Email: ".$email;
        //Replace the plain text body with one created manually
        $mail->Body = '

          DATOS DE CONTACTO

          Nombre:
          '.$name.'

          Email:
          '.$email.'

          Mensaje:
          '.$message.'
        ';

        if($mail->Send()){
          $response = array('status'=>'ok');
        }



    } catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
    }

    echo json_encode($response);
    die();
  }

})->name('form');