<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Rh extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->model('Log'); 
	}

	public function index(){ 
		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '5');
		$dados = array('menupriativo' => 'painel' );

		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idcli = $this->session->userdata('idcliente');
		
		$this->db->where("idempresa", $idempresa);
        $dados['parametros'] = $this->db->get("parametros")->row();

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();
		/*
		$this->db->where('contr_idfuncionario',$iduser);
		$dados['contratos'] = $this->db->get('contratos')->result();
		*/

		$noventa_dias = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +3 month");
		$noventa_dias = date("Y-m-d", $noventa_dias);
		$this->db->select('fun_cargo, fun_idfuncionario, fun_foto, fun_sexo, fun_nome, vnccontr, contr_cargo');
		$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
		$this->db->where('vnccontr >= ', date("Y-m-d"));
		$this->db->where('vnccontr <= ', $noventa_dias);
		$this->db->where("fun_idempresa", $idempresa);
		$this->db->where('fun_status', "A");
		$dados['vencimentos'] = $this->db->get('funcionario')->result();


		$this->db->select('contr_situacao, fun_idfuncionario, fun_foto, fun_sexo, fun_nome');
		$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
		$this->db->where('fun_idempresa', $idempresa);
		$this->db->where('fun_status', "A");
		$dados['situacao'] =$this->db->get('funcionario')->result();


		$this->db->select("escolaridade.*, fun_idfuncionario");
		$this->db->join('escolaridade', "fun_escolaridade = id_escolaridade");
		$this->db->where('fun_status',"A");
		$dados['escolaridade'] = $this->db->get('funcionario')->result();


		//asos dos proximos 15 dias
		$date = new DateTime(date("Y-m-d"));
		$date->add(new DateInterval('P15D'));
		$this->db->select("COUNT(fun_idfuncionario) AS vencimento");
		$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
		$this->db->where("fun_proximoexame <=", $date->format('Y-m-d') );
		$this->db->where("fun_proximoexame >=", date('Y-m-d') );
		$this->db->where("fun_status", "A" );
		$dados['aso1'] = $this->db->get('funcionario')->row();

    	//asos vencidos
		$this->db->select("COUNT(fun_idfuncionario) AS vencidos");
		$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
		$this->db->where("fun_proximoexame < ", date('Y-m-d') );
		$this->db->where("fun_status", "A" );
		$dados['aso2'] = $this->db->get('funcionario')->row();

		$this->db->select("COUNT(fun_idfuncionario) AS masc");
		$this->db->where("fun_sexo", 1 );
		$this->db->where("fun_status", "A" );
		$this->db->where("fun_idempresa", $idempresa );
		$dados['masc'] = $this->db->get('funcionario')->row();
		$this->db->select("COUNT(fun_idfuncionario) AS fem");
		$this->db->where("fun_sexo", 2 );
		$this->db->where("fun_status", "A" );
		$this->db->where("fun_idempresa", $idempresa );
		$dados['fem'] = $this->db->get('funcionario')->row();

		$this->db->select('fun_datanascimento');
    	$this->db->where('fun_idempresa', $idempresa);
		$this->db->where('fun_status', "A");
		$dados['idade'] =$this->db->get('funcionario')->result();

		$this->db->select('contr_data_admissao');
		$this->db->join("funcionario", "contr_idfuncionario = fun_idfuncionario");
		$this->db->where('fun_idempresa', $idempresa);
		$this->db->where('fun_status', "A");
		$dados['tempo_trabalhado'] =$this->db->get('contratos')->result();

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$feeds = $this->db->get('feedbacks')->num_rows();
		$dados['quantgeral'] = $feeds;
		
		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();

		$dados['perfil'] = $this->session->userdata('perfil');

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$this->db->where('feed_data >=',date('Y/m/d'));
		$this->db->where('feed_data >=',date('Y/m/d', strtotime('-10 days', strtotime(date('Y/m/d')))));
		$feeds2 = $this->db->get('feedbacks')->num_rows();
		$dados['quantultimos'] = $feeds2;

		$dados['breadcrumb'] = array('RH'=>base_url('rh'), "Dashboard"=>"#" );

		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_dash_rh',$dados);
		$this->load->view('/geral/footer');
	}

	public function eventos(){
		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '5');
		$dados = array('menupriativo' => 'painel' );
		$dados['perfil'] = $this->session->userdata('perfil');
		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idcli = $this->session->userdata('idcliente');
		
		$this->db->where("idempresa", $idempresa);
		$dados['parametros'] = $this->db->get("parametros")->row();

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$feeds = $this->db->get('feedbacks')->num_rows();
		$dados['quantgeral'] = $feeds;
		
		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();
		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$this->db->where('feed_data >=',date('Y/m/d'));
		$this->db->where('feed_data >=',date('Y/m/d', strtotime('-10 days', strtotime(date('Y/m/d')))));
		$feeds2 = $this->db->get('feedbacks')->num_rows();
		$dados['quantultimos'] = $feeds2;

		$dados['breadcrumb'] = array('RH'=>base_url('rh'), "Eventos"=>"#" );
		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_eventos',$dados);
		$this->load->view('/geral/footer');
	}

}