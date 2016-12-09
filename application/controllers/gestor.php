<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Gestor extends CI_Controller {
	
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
    $this->session->set_userdata('perfil_atual', '2');
    $dados = array('menupriativo' => 'painel' );

    $iduser = $this->session->userdata('id_funcionario');

    $mes = date("m");
    $this->db->where('MONTH(fun_datanascimento)',$mes);
    $dados['aniversariantes'] = $this->db->get('funcionario')->result(); 

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    $this->db->where('contr_idfuncionario',$iduser);
    $dados['contratos'] = $this->db->get('contratos')->result();

    $this->db->where('feed_idfuncionario_recebe',$iduser);
    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;

            //$idcli = $this->session->userdata('idcliente');
    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();
    $dados['perfil'] = $this->session->userdata('perfil');

    $this->db->where('feed_idfuncionario_recebe',$iduser);
    $this->db->where('feed_data >=',date('Y/m/d'));
    $this->db->where('feed_data >=',date('Y/m/d', strtotime('-10 days', strtotime(date('Y/m/d')))));
    $feeds2 = $this->db->get('feedbacks')->num_rows();
    $dados['quantultimos'] = $feeds2;

    $this->db->where('tipo_idfuncionario',$iduser);     
    $mesativo = $this->db->order_by('tipo_mesref', 'desc')->get('tipodecalculo',1)->result();
    $mesativoref="";
    foreach ($mesativo as $value) { 
      $mesativoref = $value->tipo_mesref;
    }


    $this->db->where('tipo_idfuncionario',$iduser);
    $this->db->like('tipo_mesref', $mesativoref);
    $tipodecalculo = $this->db->get('tipodecalculo')->result(); 

    $totaldesconto = 0;
    $totalproventos = 0;
    $totalliquido = 0;
    foreach ($tipodecalculo as $value) { 
      if($value->tipo_tipocal == '11'){
        $this->db->where('even_idtipodecalculo',$value->tipo_idtipodecalculo);
        $eventos2 = $this->db->get('eventoscalculo')->result();                
        foreach ($eventos2 as $dados1) {                
          $valorevento = $dados1->even_valor;
          $valorevento = str_replace(',' , '.', $valorevento);
          if($dados1->even_tipoevento == '-'){$totaldesconto = $totaldesconto + $valorevento;}
          if($dados1->even_tipoevento != '-'){if($dados1->even_tipoevento != '#'){$totalproventos = $totalproventos + $valorevento;}}
        }
      }

    }

    $this->db->select('*');
    $this->db->from('pontoaponto');
    $this->db->join('ponto_parametros', 'ponto_parametros.para_idparametros = pontoaponto.pon_idparametros');
    $this->db->where('pon_idfuncionario',$iduser);
    $this->db->limit(1);
    $dados['pontoaponto'] = $this->db->get()->result();

    $dados['totalliquido'] =  $totalproventos - $totaldesconto;
    $dados['totalproventos'] =  $totalproventos;
    $dados['totaldesconto'] = $totaldesconto;

    $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Dashboard"=>"#" );
    $this->load->view('/geral/html_header',$dados);  
    $this->load->view('/geral/corpo_dash_gestor',$dados);
    $this->load->view('/geral/footer'); 
  } 

  public function equipe(){ 
    $this->Log->talogado(); 
    $dados = array( 'menupriativo' => 'perfil', 'menu_colab_perfil' => 'pessoal', 'menu_colab_perfil_contrato' => '');             
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');

            //$corpo = (!empty( $this->input->post('corpo') )? $this->input->post('corpo') : 1) ;

    $this->db->select("funcionario.*, endereco.*, bairro.bair_nomebairro, cidade.cid_nomecidade, est_nomeestado " );
    $this->db->where('fun_idfuncionario',$iduser);
    $this->db->join('endereco', "end_idendereco = fun_idendereco");
    $this->db->join('bairro', "end_idbairro = bair_idbairro");
    $this->db->join('cidade', "end_idcidade = cid_idcidade");
    $this->db->join('estado', "end_idestado = est_idestado");
    $dados['funcionario'] = $this->db->get('funcionario')->result();

/*
    $this->db->select("funcionario.*, contratos.contr_data_admissao, contratos.contr_departamento");
    $this->db->join('contratos',"contr_idfuncionario = fun_idfuncionario");
    $this->db->where('fun_idempresa',$idempresa);
    $this->db->where('fun_idfuncionario != ',$iduser);
    $dados['equipe'] = $this->db->get('funcionario')->result();
*/

    $this->db->select("funcionario.*, contratos.contr_data_admissao, contratos.contr_departamento, contratos.contr_centrocusto, chefiasubordinados.subor_id");
            $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
            $this->db->where("chefiasubordinados.chefe_id", $iduser);
            $this->db->where('fun_status',"A");
            $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
            $this->db->from('funcionario');
            $dados['equipe'] = $this->db->get()->result();   


    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();
    $dados['perfil'] = $this->session->userdata('perfil');

    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;            

    $this->session->set_userdata('perfil_atual', '2');
    $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Gestão da Equipe"=>"#", "minha equipe"=>base_url().'gestor/equipe' );
    $this->load->view('/geral/html_header',$dados);
            /*
            switch ($corpo) {
                   case '1': $this->load->view('/geral/corpo_equipe',$dados); break;
                   case '2': $this->load->view('/geral/corpo_equipe_resultado',$dados); break;                   
                   default: $this->load->view('/geral/corpo_equipe',$dados); break;
             }
             */
             $this->load->view('/geral/corpo_equipe',$dados);          
             $this->load->view('/geral/footer'); 
           }

  public function vagas(){

            $this->Log->talogado(); 
            $dados = array( 'menupriativo' => 'perfil', 'menu_colab_perfil' => 'pessoal', 'menu_colab_perfil_contrato' => '');             
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');
            $this->session->set_userdata('perfil_atual', '2');         
            
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $this->db->where('idempresa',$idempresa);
            $dados['cargos'] = $this->db->get('tabelacargos')->result();

            $this->db->order_by("vaga_id", "desc");
            $this->db->where('vaga_fk_empresa',$idempresa);
            $this->db->limit(850);
            $dados['vaga'] = $this->db->get('vaga')->result();


            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_vagas',$dados);
            $this->load->view('/geral/footer'); 
          }

          public function vagaManipular(){


            $idempresa = $this->session->userdata('idempresa');
            $dados['vaga_fk_empresa'] = $idempresa;
            $operacao = $this->input->post('operacao');

            if (!empty($this->input->post('titulo'))) {$dados['vaga_titulo'] = $this->input->post('titulo');}
            
            if (!empty($this->input->post('descricao'))) {

              $dados['vaga_descricao'] = $this->input->post('descricao');

            }

            $dados['vaga_ic_deficiente'] = (!empty($this->input->post('pcd'))? 1 : 0);
            if (!empty($this->input->post('cargo'))) {$dados['vaga_fk_cargo'] = $this->input->post('cargo');}
            
            if (!empty($this->input->post('encerramento'))) {

              $dados['vaga_final'] = $this->Log->alteradata2($this->input->post('encerramento'));

            }

            $dados['vaga_ic_ativo'] = (!empty($this->input->post('ativo')) )? 0:1 ;
            
            if ($operacao == 1) {

              $dados['vaga_inicio'] = date("Y-m-d");
              $this->db->insert('vaga', $dados);
              echo 1;
              exit;
            }


            if($operacao==2){
              $id = $this->input->post('idv');
              $this->db->where("vaga_id", $id);
              $this->db->update("vaga", $dados);
              echo 1;
              exit();
            }

            if($operacao==3){
              $id = $this->input->post('id');
              $this->db->where("vaga_id", $id);
              $up['vaga_ic_ativo'] = $this->input->post('status');
              $this->db->update("vaga", $up);
              echo 1;
              exit();
            }

          }

          public function vagadd(){


            if( !empty( $this->input->post("id") ) ){
              $id = $this->input->post("id");

              $this->db->where('vaga_id', $id);
              $dados['vaga'] = $this->db->get('vaga')->result();

            }
            $idempresa = $this->session->userdata('idempresa');
            $this->db->where('idempresa',$idempresa);
            $dados['cargos'] = $this->db->get('tabelacargos')->result();
            $this->load->view('/geral/corpo_vagas_add', $dados);

          }

        }