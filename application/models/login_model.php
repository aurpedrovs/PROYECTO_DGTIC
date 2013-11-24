<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class login_model extends CI_Model{
    
    
    public function __construct(){
        
        parent::__construct();
      
        
    }
    /*Funcion para autenticación del usuario
     * donde:
     * usr_estado -> comprueba que el usuario este activo, si no esta activo no 
     * permitirá entrar
     */
    public function login_user($usuario,$password,$rol){
        $this->db->where('usr_nombre_usuario',$usuario);
        $this->db->where('usr_password',$password);
        $this->db->where('rol_nombre',$rol);
        $this->db->where('usr_estado','1');
        $query = $this->db->get('login');
        if($query->num_rows()==1){
            return $query->row();
        }else{
            $this->session->set_flashdata('usuario_incorrecto','Los datos de Usuario son Incorrectos');
           redirect('login','refresh');
           
        }
        
                
    }
    /* Verifica que el password sea correcto antes del cambio del password*/
    public function verificarpass($id,$password){
        $this->db->where('id_usuario',$id);
        $this->db->where('usr_password',$password);
        $this->db->from('usuario');
         $query = $this->db->get();
        if($query->num_rows()==1){
            return true;
        }else{
           return false;
        }
        
    }
    /*Función que Actualiza contraseña*/
    public function cambiar($id,$contraseña){
       $data = array(
           'usr_password' => $contraseña
       ); 
      $this->db->where('id_usuario',$id);
      $this->db->update('usuario',$data);
      return true;
        
    }
    /*Función que verifica que haya un usuario existente con ese correo*/
    public function verificaremail($correo){
        $this->db->where('usr_email',$correo);
        $this->db->from('usuario');
        $query = $this->db->get();
        if($query->num_rows()==1){
            return true;
        }else
            return false;
        
    }
    
}