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
			//$dados['instancia'] = "HCMSOLUCOES";
			$dados['fundoimagem'] = ( empty($acesso->cli_fundoimagem) )? "wall_1.jpg" : $acesso->cli_fundoimagem;
			$dados['fundologin'] = ( empty($acesso->cli_fundologin) )? "" : $acesso->cli_fundologin;
			if (is_object($acesso)) {
		
              	$dados['instancia'] = $acesso->cli_instancia;
            	$this->session->set_userdata("instancia", $acesso->cli_instancia);
            	//echo $acesso->cli_nomecliente;
			}
           
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
		$this->load->view('/geral/calendario');

	}




}