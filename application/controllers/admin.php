<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
      
      public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('html');
            $this->load->library('session');
            $this->load->model('Log'); 
            $this->load->model('Admbd');
                  
      }

      public function index(){ 
            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '3');
            $dados = array('menupriativo' => 'painel' );
            
            $iduser = $this->session->userdata('id_funcionario');

            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();
            
           
            
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
            
            //$idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            
           $dados['breadcrumb'] = array('Admin'=>base_url().'admin', "Dashboard"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_dash_admin',$dados);
            $this->load->view('/geral/footer'); 
      }

      public function chefia(){

            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '3');
            $dados = array('menupriativo' => 'painel' );
            
            $iduser = $this->session->userdata('id_funcionario');
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->where('fun_status',"A");
            $dados['colaboradores'] = $this->db->get('funcionario')->result();            
           
            
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
            
            //$idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            
           $dados['breadcrumb'] = array('Admin'=>base_url().'admin', "Chefia"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_chefia',$dados);
            $this->load->view('/geral/footer'); 
      }

      public function parametros(){ 
            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '3');
            $dados = array('menupriativo' => 'paramentros' );
            $iduser = $this->session->userdata('id_funcionario');
            $idcliente = $this->session->userdata('idcliente');
            $idempresa = $this->session->userdata('idempresa');
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->where('fun_perfil', 2);
            $this->db->where('fun_status',"A");
            $this->db->or_where('fun_perfil', 4);
            $dados['gestores'] = $this->db->get('funcionario')->result();
           
            $this->db->where('idcliente',$idcliente);
            $dados['parametros'] = $this->db->get('parametros')->row();           
            
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;            
            
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');     
            $dados['breadcrumb'] = array('Admin'=>base_url().'admin', "Parâmetros"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_parametros',$dados);
            $this->load->view('/geral/footer'); 
      }
       

      public function salvarparam(){

            $idempresa = $this->session->userdata('idempresa');
            $idcliente = $this->session->userdata('idcliente');
            $campo = $this->input->post("campo");
            $valor = $this->input->post("valor") ;
            $dados['idempresa'] = $idempresa;
            $dados['idcliente'] = $idcliente;
            $dados[$campo] = $valor;


/*
            $op = $this->input->post('operacao');

            switch ($op) {
                  case '1':
                       $dados['Param_chefia'] = (!empty($this->input->post('valor')) )  ? 1 : 0;
                        break;

                  case '2':
                       $dados['Param_feed'] = (!empty($this->input->post('valor')) ) ? $this->input->post('valor') : 0;
                        break;

                  case '3':
                       $dados['fun_id_aprovadorRH'] = (!empty($this->input->post('valor')) ) ? $this->input->post('valor') : 0;
                        break;

                  case '4':
                       $dados['fun_id_aprovador_Direcao'] = (!empty($this->input->post('valor')) ) ? $this->input->post('valor') : 0;
                        break;

                  case '5':
                       $dados['param_fer'] = (!empty($this->input->post('valor')) )  ? 1 : 0;
                        break;                  
               
            }*/
         
            
            if( !empty($this->input->post('paramid')) ){ 

                  $id = $this->input->post('paramid');
                  $this->db->where('param_id', $id);
                  $r['update'] = $this->db->update("parametros", $dados);
                 

            }else{

                  $this->db->insert("parametros", $dados);
                  $r['id'] = $this->db->insert_id();
                  
            }
            echo json_encode($r);

       }       
      
     


}