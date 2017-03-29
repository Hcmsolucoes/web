<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->model('Log'); 
	}
	
	public function sendmail()
	{
		$this->load->library('email');
		$this->email->from('contato@hcmsolucoes.com.br','Team OnePage');
		$this->email->to("yuri@synergie.com.br");
		$this->email->subject('Um email teste do CodeIgniter usando Gmail');
		$this->email->message("Eu posso agora enviar email do CodeIgniter usando o Gmail como meu servidor!");
		$this->email->send();
		echo $this->email->print_debugger();
	}

	public function index()
	{ 
		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '1');
		$dados = array('menupriativo' => 'painel' );

		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');

		$mes = date("m");
		$dia = date("d");
		$this->db->where('MONTH(fun_datanascimento)',$mes);
		$this->db->where('DAY(fun_datanascimento) >= ',$dia);
		$this->db->where('fun_idempresa', $idempresa);
		$this->db->where('fun_status', "A");
		$this->db->order_by("fun_datanascimento", "desc");
		$dados['aniversariantes'] = $this->db->get('funcionario')->result();

		$this->db->where("idempresa", $idempresa);
        $dados['parametros'] = $this->db->get("parametros")->row();

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();

		$this->db->where('contr_idfuncionario',$iduser);
		$dados['contratos'] = $this->db->get('contratos')->result();

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$feeds = $this->db->get('feedbacks')->num_rows();
		$dados['quantgeral'] = $feeds;

		$idcli = $this->session->userdata('idcliente');
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
		$this->db->order_by('pon_idpontoaponto', 'desc');
		$this->db->limit(1);
		$dados['pontoaponto'] = $this->db->get()->result();

		$dados['totalliquido'] =  $totalproventos - $totaldesconto;
		$dados['totalproventos'] =  $totalproventos;
		$dados['totaldesconto'] = $totaldesconto;
		$dados['mesativoref'] = $mesativoref;

		$dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Dashboard"=>"#" );

		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_destbord',$dados);
		$this->load->view('/geral/footer');
	}

	public function login()
	{
		
		if(!$this->session->userdata('id_funcionario') || !$this->session->userdata('logado')){ 


			$this->session->unset_userdata("instancia"); 
			$subdominio = $_SERVER['HTTP_HOST'];  
			$this->db->select("cli_nomecliente, cli_instancia, cli_fundoimagem, cli_fundologin");
			$this->db->where("cli_subdominio", $subdominio);
			$acesso = $this->db->get("cliente")->row();
			$dados['fundoimagem'] = ( empty($acesso->cli_fundoimagem) )? "wall_1.jpg" : $acesso->cli_fundoimagem;
			$dados['fundologin'] = ( empty($acesso->cli_fundologin) )? "" : $acesso->cli_fundologin;
			if (is_object($acesso)) {
		
              	$dados['instancia'] = $acesso->cli_instancia;
            	$this->session->set_userdata("instancia", $acesso->cli_instancia);
            	//echo $acesso->cli_nomecliente;
			}
           header ('Content-type: text/html; charset=ISO-8859-1');
			$this->load->view('/geral/login', $dados); 
			
		}else{
			$url = base_url('home');
			header("Location: $url ");

		}

	}
	public function teste()
	{
		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '1');
		$dados = array('menupriativo' => 'painel' );

		echo $this->Log->duascolunas($dados); 

	}

	public function calendario()
	{


		header ('Content-type: text/html; charset=ISO-8859-1');
		$this->load->view('/geral/box/modalcalendario');

	}

	public function programacao_ferias(){
		$this->Log->talogado(); 
            $dados = array( 'menupriativo' => 'gestao');             
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');
            $idcli = $this->session->userdata('idcliente');

            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get("parametros")->row();

            $this->db->where('Per_idfuncionario',$iduser);
            $this->db->where('Per_SitPer', 0);
            $this->db->order_by("Per_dataFim", "asc");
            $this->db->limit(1);
            $dados['periodos'] = $this->db->get('Periodos')->row();

            $dados['breadcrumb'] = array('Colaborador'=>base_url('home'), "Gest�o"=>"#", 'Programa��o de f�rias'=>'#' );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_ferias',$dados);
            $this->load->view('/geral/footer'); 
	}

	public function datapagamento(){
		$data = $this->input->post("data");
		$data_pag = $this->Log->alteradata2($data);
		$date = new DateTime($data_pag);
		$date->sub(new DateInterval('P2D'));
		$data_pag = $date->format('Y-m-d');

		$fer=true;
		while ($fer) {
			$this->db->where("data_feriado", $data_pag);
			$res = $this->db->get("feriado");			

			if ($res->num_rows()==0) {

				$fer=false;

			}else{
				$date = new DateTime($data_pag);
				$date->sub(new DateInterval('P1D'));
				$data_pag = $date->format('Y-m-d');
			}
			list($a, $m, $d) = explode("-", $data_pag);
			$dia_da_semana = date("D", mktime(0,0,0,$m,$d,$a) );

			if ($dia_da_semana  == "Sun" || $dia_da_semana  == "Sat") {
				$date = new DateTime($data_pag);
				$date->sub(new DateInterval('P1D'));
				$data_pag = $date->format('Y-m-d');
				$fer=true;
			}

		}

		
		echo $this->Log->alteradata1($data_pag);
	}

	public function salvarProgFerias(){

		$iduser = $this->session->userdata('id_funcionario');
		$dados['fer_idfuncionario'] = $iduser;
		$dados['fer_idperiodo'] = $this->input->post('periodos');
		$dados['fer_datainicio'] = $this->Log->alteradata2($this->input->post('data_inicio'));
		$dados['fer_dias'] = $this->input->post('dias');
		$dados['fer_abono'] = $this->input->post('fer_abono');
		$dados['fer_decimoterceiro'] = $this->input->post('decterceiro');
		$dados['fer_data_pagamento'] = $this->Log->alteradata2($this->input->post('data_pagto') );
		$dados['fer_adiantamento'] = $this->input->post('adiantamento');
		//echo $this->input->post('decterceiro') ." - ". $this->input->post('adiantamento');
		$this->db->insert("programacao_ferias", $dados);
		echo $this->db->insert_id();
	}




}