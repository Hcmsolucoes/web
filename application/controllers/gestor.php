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

    switch ( $this->session->userdata('perfil') ) {

      case '3':
      header("Location: ".base_url('home') ); exit;
      break;
      
  }

    $idcli = $this->session->userdata('idcliente');
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');

    $mes = date("m");
    $ano = date("Y");
    $this->db->where('MONTH(fun_datanascimento)',$mes);
    $dados['aniversariantes'] = $this->db->get('funcionario')->result(); 

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    $this->db->where('contr_idfuncionario',$iduser);
    $dados['contratos'] = $this->db->get('contratos')->result();

    $this->db->where('feed_idfuncionario_recebe',$iduser);
    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;


    $noventa_dias = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +3 month");
    $noventa_dias = date("Y-m-d", $noventa_dias);
    $this->db->select('fun_idfuncionario, fun_foto, fun_sexo, fun_nome, vnccontr');
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->where('vnccontr >= ', date("Y-m-d"));
    $this->db->where('vnccontr <= ', $noventa_dias);
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_status', "A");
    $dados['vencimentos'] = $this->db->get('funcionario')->result();



    $this->db->select("escolaridade.*, fun_idfuncionario");
    $this->db->join('escolaridade', "fun_escolaridade = id_escolaridade");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario", "left");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->or_where('fun_idfuncionario',$iduser);
    $this->db->where('fun_status',"A");
    $dados['escolaridade'] = $this->db->get('funcionario')->result();
    


    $this->db->select('fun_idfuncionario, fun_foto, fun_sexo, fun_nome, contr_data_admissao');
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('MONTH(contr_data_admissao)',$mes);
    $this->db->where('YEAR(contr_data_admissao)',$ano);
    $this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "A");
    $dados['admitidos'] =$this->db->get('funcionario')->result();
    //$dados['sql'] = $this->db->last_query();


    $this->db->select('fun_idfuncionario, fun_foto, fun_sexo, fun_nome, datdem');
    //$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('MONTH(datdem)',$mes);
    $this->db->where('YEAR(datdem)',$ano);
    $this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "I");
    $dados['demitidos'] =$this->db->get('funcionario')->result();


    $this->db->select("fun_idfuncionario, fun_foto, fun_sexo, fun_nome, contr_cargo");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_status',"A");
    $dados['equipe'] = $this->db->get("funcionario")->result();


    $this->db->select('fun_datanascimento');
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    //$this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "A");
    $dados['idade'] =$this->db->get('funcionario')->result();


    $this->db->select('contr_data_admissao');
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->join("funcionario", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "A");
    $dados['tempo_trabalhado'] =$this->db->get('contratos')->result();


    $this->db->select('contr_situacao, fun_idfuncionario, fun_foto, fun_sexo, fun_nome');
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->or_where('fun_idfuncionario',$iduser);
    $this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "A");
    $dados['situacao'] =$this->db->get('funcionario')->result();


    $um_ano = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " -12 month");
    $um_ano = date("Y-m-d", $um_ano);
    $this->db->select('fun_idfuncionario, fun_foto, fun_sexo, fun_nome');
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('YEAR(contr_data_admissao) = YEAR(datdem)' );
    $this->db->where('contr_data_admissao <= ', date("Y-m-d"));
    $this->db->where('contr_data_admissao >= ', $um_ano);
    $this->db->where('fun_status', "I");
    $dem = $this->db->get('funcionario')->result();

    $this->db->select('COUNT(contr_idcontratos) AS admitidos');
    $this->db->where('contr_data_admissao <= ', date("Y-m-d"));
    $this->db->where('contr_data_admissao >= ', $um_ano);
    $admi = $this->db->get('contratos')->result();
    $dados['sql'] = $this->db->last_query();
    $dados['taxasaida'] = (count($dem) / $admi[0]->admitidos) * 100;
        

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

    $this->db->select("funcionario.*,  bairro.bair_nomebairro, cidade.cid_nomecidade, est_nomeestado " );
    $this->db->where('fun_idfuncionario',$iduser);
    //$this->db->join('endereco', "end_idendereco = fun_idendereco");
    $this->db->join('bairro', "end_idbairro = bair_idbairro", "LEFT");
    $this->db->join('cidade', "end_idcidade = cid_idcidade", "LEFT");
    $this->db->join('estado', "end_idestado = est_idestado", "LEFT");
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

public function solicitacoes(){

    $this->Log->talogado(); 
    $dados = array('menupriativo' => 'painel' );
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcli = $this->session->userdata('idcliente');

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    $this->db->where('fun_idempresa',$idempresa);
    $this->db->where('fun_status',"A");
    $dados['colaboradores'] = $this->db->get('funcionario')->result();

    $this->db->select('fun_nome, descricao_solicitacao, descricao_status_solicitacao, solicitacoes.*');
    $this->db->join('funcionario', "fun_idfuncionario = sol_idfuncionario");
    $this->db->join('solicitacao_tipo', "fk_tipo_solicitacao = id_tipo_solicitacao");
    $this->db->join('solicitacao_status', "id_status_solicitacao = solicitacao_status");
    $this->db->where('id_solicitante',$iduser);
    $dados['solicitacoes'] = $this->db->get('solicitacoes')->result();

    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();

    $dados['perfil'] = $this->session->userdata('perfil');

    $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Solicitações"=>"#" );

    $this->load->view('/geral/html_header',$dados);  
    $this->load->view('/geral/corpo_solicitacoes',$dados);
    $this->load->view('/geral/footer');
  

   }

public function salvarDesligamento(){

    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcliente = $this->session->userdata('idcliente');    
    
    $dados['motivo_solicitacao'] = $this->input->post('motivo');
    $dados['data_efetiva'] = $this->Log->alteradata2( $this->input->post('dt_desligamento') );

    //echo $this->input->post('alterar_desligamento');exit;
    if ( !empty($this->input->post('alterar_desligamento')) ) {

        $idsol = $this->input->post('solicitacao');
        $this->db->where("solicitacao_id", $idsol);
        $this->db->update("solicitacoes", $dados);
        //echo $this->db->last_query();
        //exit;
    }else{

        $dados['idcliente'] = $idcliente;
        $dados['idempresa'] = $idempresa;
        $dados['id_solicitante'] = $iduser;
        $dados['fk_tipo_solicitacao'] = $this->input->post('tipo');
        $dados['sol_idfuncionario'] = $this->input->post('colaborador');
        $this->db->insert("solicitacoes", $dados);
        echo $this->db->insert_id();
    }
    header("Location: ". base_url('gestor/solicitacoes') );
 }

public function minhaSolicitacao(){

   $iduser = $this->session->userdata('id_funcionario');
   $idempresa = $this->session->userdata('idempresa');
   $idcliente = $this->session->userdata('idcliente');
   $idsolicitacao = $this->input->post('id');
   $tipo = $this->input->post('tipo');


   $this->db->select('fun_nome, descricao_solicitacao, descricao_status_solicitacao, solicitacoes.*');
    $this->db->join('funcionario', "fun_idfuncionario = sol_idfuncionario");
    $this->db->join('solicitacao_tipo', "fk_tipo_solicitacao = id_tipo_solicitacao");
    $this->db->join('solicitacao_status', "id_status_solicitacao = solicitacao_status");
    $this->db->where('solicitacao_id', $idsolicitacao);
    $dados['solicitacao'] = $this->db->get('solicitacoes')->row();
    //echo $this->db->last_query(); exit;
    $this->db->select('fun_nome, fun_idfuncionario');
    $this->db->where('fun_idfuncionario', $iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->row();

    header ('Content-type: text/html; charset=ISO-8859-1');
    switch ($tipo) {
        case '1': $this->load->view('/geral/edit/modal_desl_edit',$dados); break;
        default: break;
    }
    

   //echo $idsolicitacao;
 }

public function acao_solicitacao(){

    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcliente = $this->session->userdata('idcliente');

    $id = $this->input->post('id');
    $campo = $this->input->post('campo');
    $valor = $this->input->post('valor');
    $dados[$campo] = $valor;
    $this->db->where("solicitacao_id", $id);
    $this->db->update("solicitacoes", $dados);

    $this->db->select("descricao_solicitacao, fk_tipo_solicitacao, data_hora_solicitacao");
    $this->db->join('solicitacao_tipo', "id_tipo_solicitacao = fk_tipo_solicitacao");
    $this->db->where('solicitacao_id', $id);
    $solic = $this->db->get('solicitacoes')->row();

    $this->db->where('fun_idfuncionario', $iduser);
    $funcionario = $this->db->get('funcionario')->row();


    $this->db->select("fun_nome, fun_email");
    $this->db->join('funcionario', "fun_idfuncionario = fk_aprovador");
    $this->db->where('fk_tipo_solicitacao', $solic->fk_tipo_solicitacao );
    $this->db->where('fk_empresa', $idempresa);
    $aprovadores = $this->db->get('solicitacao_aprovador')->result();

    switch ($valor) {
        case '2': $acao_feita = "encaminhou"; break;    
        default: break;
    }
    /*
    $datahora = date('Y-m-d H:m:s' , strtotime($solic->data_hora_solicitacao) );
                  list($data, $hora) = explode(" ", $datahora);
                  $data = $this->Log->alteradata1( $data );
    */

    if ($valor==2) {
        
        foreach ($aprovadores as $key => $value) {
        
        $nome = explode(" ", $value->fun_nome) ;
        $mensagem = "<h3>Olá ".$nome[0]."</h3>
        <h4>Existem novas solicitações para serem avaliadas</h4>
        <p>".$funcionario->fun_nome. " ". $acao_feita ." uma solicitação de " .$solic->descricao_solicitacao. " </p>
        <p></p>";
        $this->load->library('email');
        $this->email->from('contato@hcmsolucoes.com.br','HCM People');
        $this->email->to($value->fun_email);
        $this->email->subject( utf8_encode('Novas solicitações para avaliar') );
        $this->email->set_mailtype("html");
        $this->email->message( utf8_encode($mensagem) );
        $this->email->send();
     }

    }

    echo 1;
 }


}