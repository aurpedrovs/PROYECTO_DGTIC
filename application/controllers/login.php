<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class login extends CI_Controller{



    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library(array('session','form_validation','email'));
        $this->load->helper(array('url','form'));
        $this->load->database();
        
        
    }
    public function index(){
        
        switch ($this->session->userdata('rol')){
            
            case '':
                    
                    $data['titulo'] = "LOGIN";
                    $data['toke'] = $this->token();
                    $this->load->view('login_view',$data);
                    
            break;
            
            case 'administrador':
              
                redirect('administrador/administrador');
            break;
            case 'auditor':
                   redirect('auditor/auditor');
            break;
            case 'colaborador':
                   redirect('administrador/administrador');
            break;
            default:
                echo "eror";
                $data['titulo'] = 'LOGIN';
                $this->load->view('/login_view',$data);
            break;
        }
       
    }
    
    function token(){
        $token = md5(uniqid(rand(),true));
        $this->session->set_userdata('token',$token);
        return $token;
        
    }
    
    public function autenticacion(){

       
        $checkuser =  $this->login_model->login_user($_POST['usr_nombre'],$_POST['usr_password'],$_POST['usr_rol']);
    
        if($checkuser == TRUE){
            $data = array(
                'is_logued_in' => TRUE,
                'id_usuario' =>$checkuser->id_usuario,
                'rol' => $checkuser->rol_nombre,
                'username' => $checkuser->usr_nombre_usuario
                                     
            );
            $this->session->set_userdata($data);
            redirect('/login');
            
        }else{
            
            redirect('/login');
        }
       
     
       
    }
    
    public function logout(){
        
        $this->session->sess_destroy();
        redirect('/login');
    }
    public function cambiarpassword(){
       
       
        if($this->session->userdata('id_usuario')==FALSE){
            redirect('/login');
        }else{
            if(empty($_POST)){
                $this->load->view('cambiarpassword_view');  
            }else{
                 
                  $comprobarContraseña = $this->login_model->verificarpass($this->session->userdata('id_usuario'),$_POST['password_actual']);
                  if($comprobarContraseña==true){
                       if(($_POST['nuevo1']<>$_POST['nuevo2'])){
                            $data['error'] = 'Las contraseñas no coincide';
                              $this->load->view('cambiarpassword_view',$data);  
                             
                        }else{
                               
                             $checkcambio =  $this->login_model->cambiar($this->session->userdata('id_usuario'),$_POST['nuevo2']);
                              if($checkcambio==true){
                                  echo "La contraseña ha sido actualizada Correctamente";
                              }
                        }
                  }else{
                      $data['error'] = 'Las contraseñas es incorrecta';
                      $this->load->view('cambiarpassword_view',$data);  
                      
                  }
                  
                
            
            }
        }
    }
    public function recuperarpassword(){
        if(empty($_POST)){
         $this->load->view('recupearpassword_view');   
        }else{
           $checkemail = $this->login_model->verificaremail($_POST['txt_emailrecupear']);
            if($checkemail==TRUE){
                echo "comenzando envio de correo";
                $this->email->from('aur.pedrovs@gmail.com');
                $this->email->to('falkon.x.admin@gmail.');
                $this->email->subject('Email Enviado');
                $this->email->message('hola');
                if($this->email->send()){
                  echo "MEnsaje enviador "; 
                  echo $this->email->print_debugget();exit;
                }
            }else{
                $data['error'] = "No se encontró correo electrónico";
                $this->load->view('recupearpassword_view',$data);
            } 
           
        }
        
        
    }
    
}
