<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Perfil extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->model('Log'); 
        $this->load->model('Admbd');
	}
	
	public function pessoal()
        { 
            $this->Log->talogado(); 
            $dados = array( 'menupriativo' => 'perfil', 'menu_colab_perfil' => 'pessoal', 'menu_colab_perfil_contrato' => '');             
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');
            $idcli = $this->session->userdata('idcliente');

            $this->db->where('inter_idfuncionario',$iduser);
            $dados['interessepessoal'] = $this->db->get('interessepessoal')->result();
            
            //$this->db->select("funcionario.*, etnia.*, estadocivil.*");
            $this->db->where('fun_idfuncionario',$iduser);
            $this->db->join('estadocivil', 'estadocivil.id_estciv = funcionario.fun_estadocivil', 'left'); 
            $this->db->join('etnia', 'etnia.id_etnia = funcionario.fun_etnia', 'left');              
            $this->db->join('escolaridade', 'escolaridade.id_escolaridade = funcionario.fun_escolaridade', 'left'); 
            $this->db->join('bairro', 'funcionario.end_idbairro = bairro.bair_idbairro', 'left');
            $this->db->join('cidade', 'funcionario.end_idcidade = cidade.cid_idcidade', 'left');
            $this->db->join('estado', 'funcionario.end_idestado = estado.est_idestado', 'left');
            $dados['funcionario'] = $this->db->get('funcionario')->result();
            
            $this->db->where('ema_idfuncionario',$iduser);
            $dados['emails'] = $this->db->get('emails')->result();
            
            $this->db->where('rede_idfuncionario',$iduser);
            $dados['redesocial'] = $this->db->get('redesocial')->result();
            
            $this->db->where('con_idfuncionario',$iduser);
            $dados['contato'] = $this->db->get('contato')->result();

            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');


            $this->db->where('doc_idfuncionario',$iduser);
            $dados['documentos'] = $this->db->get('documentos')->result();


            $this->db->select('*');
            $this->db->join('motivos', 'motivos.mot_idmotivos = histcargos.car_motivo');
            $this->db->join('tabelacargos', 'tabelacargos.idcargo=histcargos.idcargo');
            $this->db->join('empresa', 'empresa.em_idempresa = histcargos.idempresa');
            $this->db->where('car_idfuncionario',$iduser);      
            $dados['histcargos'] = $this->db->get('histcargos')->result();


            $this->db->select('*');
            $this->db->join('motivos', 'motivos.mot_idmotivos = salarios.sal_idmotivo');
            $this->db->where('sal_idfuncionario', $iduser);
            $this->db->order_by('sal_idsalarios', "asc");
            $dados['histsalarios'] = $this->db->get('salarios')->result();


            $this->db->select('*');
            $this->db->join('tipoafastamento', 'afastamentos.afa_tipo = tipoafastamento.tipafa');
            $this->db->where('afa_idfuncionario', $iduser);
            $this->db->order_by('afa_inicio', "desc");
            $dados['histafastamento'] = $this->db->get('afastamentos')->result();


            $this->db->select('hiscus_inicio, descricao, em_nomefantasia');
            $this->db->join('tabelacentrocusto', 'tabelacentrocusto.idcentro = histcentrocusto.idcentro');
            $this->db->join('empresa', 'empresa.em_idempresa = histcentrocusto.idempresa');
            $this->db->where('hiscus_idfuncionario', $iduser);
            $this->db->order_by("hiscus_inicio", "desc");
            $dados['histcentrocusto'] = $this->db->get('histcentrocusto')->result();

            $this->db->select('tabelaescala.idescala, hisesc_inicio, idcliente, descricao, em_nomefantasia ');
            $this->db->join('histescalas', 'histescalas.idescala = tabelaescala.idescala');
            $this->db->join('empresa', 'histescalas.idempresa = empresa.em_idempresa');
            $this->db->where('hisesc_idfuncionario',$iduser);      
            $this->db->order_by("hisesc_inicio", "desc");
            $dados['histescalas'] = $this->db->get('tabelaescala')->result();

            $this->db->select('descricao, hisdep_inicio, em_nomefantasia');
            $this->db->join('histdepartamento', 'histdepartamento.iddpto = tabeladepartamento.iddpto');
            $this->db->join('empresa', 'tabeladepartamento.idempresa = empresa.em_idempresa');
            $this->db->where('tabeladepartamento.idempresa', $idempresa);      
            $this->db->where('hisdep_idfuncionario', $iduser);
            $this->db->order_by("hisdep_inicio", "desc");
            $dados['histdepartamento'] = $this->db->get('tabeladepartamento')->result();
            
            $this->db->where('banc_idfuncionario',$iduser);
            $dados['dadosbancarios'] = $this->db->get('dadosbancarios')->result();

            
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;


            $this->db->select('fun_idfuncionario, fun_nome, fun_foto, fun_sexo');
            $this->db->where('fun_idempresa', $idempresa);
            $this->db->where('fun_status', "A");
            $this->db->where_not_in('fun_idfuncionario', $iduser);
            $this->db->limit(6, 0);
            $equipe = $this->db->get('funcionario')->result();
            $dados['equipe'] = $equipe;

            $this->db->select('*');
            $this->db->from('dependentes');
            $this->db->join('tipodependente', 'dependentes.deptipo = tipodependente.tipdep');  
            $this->db->where('dep_idfuncionario',$iduser);
            $dados['dependentes'] = $this->db->get()->result();

            $this->db->where('perfil_idfuncionario',$iduser);
            $dados['perfil_profissional'] = $this->db->get('perfil_profissional')->result();

            $this->db->where('for_idfuncionario',$iduser);
            $dados['formacao_academica'] = $this->db->get('formacao_academica')->result(); 

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get("parametros")->row();

            $this->db->select('*');
            $this->db->from('contratos');
            $this->db->join('funcionario', 'funcionario.fun_idfuncionario = contratos.contr_idfuncionario');  
            $this->db->join('empresa', 'empresa.em_idempresa = contratos.contr_idempresa');
            $this->db->join('bairro', 'contratos.ctr_idbairro = bairro.bair_idbairro', 'left');
            $this->db->join('cidade', 'contratos.ctr_idcidade = cidade.cid_idcidade', 'left');
            $this->db->join('estado', 'contratos.ctr_idestado = estado.est_idestado', 'left');
            $this->db->where('contr_idfuncionario',$iduser);
            $dados['contratos'] = $this->db->get()->result();

            $this->db->where("fk_priv_funcionario", $iduser);
            $dados['privacidade'] = $this->db->get('perfil_privacidade')->row();
			
            $this->session->set_userdata('perfil_atual', '1');

            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Meu Perfil"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_pessoal',$dados);
            $this->load->view('/geral/footer'); 
	}
    
    public function pessoal_publico($id = null){ 
            $this->Log->talogado();            
            $dados = array( 'menupriativo' => 'publico', 'menu_colab_perfil' => 'publico', 'menu_colab_perfil_contrato' => '');             
            $iduser = $id; $idvisita = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');          

            $this->db->select("fun_idempresa");            
            $this->db->where('fun_idfuncionario',$iduser);
            $this->db->where('fun_status', "A");
            $empresa1 = $this->db->get('funcionario')->row();

            $this->db->select("fun_idempresa");
            $this->db->where('fun_idfuncionario',$idvisita); 
            $empresa2 = $this->db->get('funcionario')->row();

            if($empresa1->fun_idempresa == $empresa2->fun_idempresa){
                
                $this->db->where('fun_idfuncionario',$iduser);
                $this->db->join('estadocivil', 'estadocivil.id_estciv = funcionario.fun_estadocivil', 'left'); 
                $this->db->join('etnia', 'etnia.id_etnia = funcionario.fun_etnia', 'left');              
                $this->db->join('escolaridade', 'escolaridade.id_escolaridade = funcionario.fun_escolaridade', 'left');
                $this->db->join('bairro', 'funcionario.end_idbairro = bairro.bair_idbairro', 'left');
                $this->db->join('cidade', 'funcionario.end_idcidade = cidade.cid_idcidade', 'left');
                $this->db->join('estado', 'funcionario.end_idestado = estado.est_idestado', 'left');
                $dados['funcionario_visita'] = $this->db->get('funcionario')->result();


                $this->db->where('fun_idfuncionario',$idvisita);
                $dados['funcionario'] = $this->db->get('funcionario')->result();

                $idcli = $this->session->userdata('idcliente');
                $this->db->select('tema_cor, tema_fundo');
                $this->db->where('fun_idfuncionario',$idvisita);
                $dados['tema'] = $this->db->get('funcionario')->result();
                $dados['perfil'] = $this->session->userdata('perfil');

                $this->db->where("fk_priv_funcionario", $iduser);
                $dados['privacidade'] = $this->db->get('perfil_privacidade')->row();
                
                $this->db->where('perfil_idfuncionario',$iduser);
                $dados['perfil_profissional'] = $this->db->get('perfil_profissional')->result(); 

                
                $this->db->where('for_idfuncionario',$iduser);
                $dados['formacao_academica'] = $this->db->get('formacao_academica')->result();  
                
                $this->db->where('con_idfuncionario',$iduser);
                $dados['contato'] = $this->db->get('contato')->result();
                
                $this->db->where('ema_idfuncionario',$iduser);
                $dados['emails'] = $this->db->get('emails')->result();
                /*
                $this->db->select('*');
                $this->db->from('endereco');
                $this->db->join('funcionario', 'endereco.end_idendereco = funcionario.fun_idendereco'); 
                $this->db->join('estado', 'endereco.end_idestado = estado.est_idestado');  
                $this->db->join('cidade', 'endereco.end_idcidade = cidade.cid_idcidade');  
                $this->db->join('bairro', 'endereco.end_idbairro = bairro.bair_idbairro'); 
                $this->db->where('fun_idfuncionario',$iduser);
                $dados['endereco'] = $this->db->get()->result();*/

                $this->db->where("idempresa", $idempresa);
                $dados['parametros'] = $this->db->get("parametros")->row();
            
                $this->db->where('rede_idfuncionario',$iduser);
                $dados['redesocial'] = $this->db->get('redesocial')->result();

                $this->db->where('inter_idfuncionario',$iduser);
                $dados['interessepessoal'] = $this->db->get('interessepessoal')->result();

                $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');
            $this->db->where('feed_idfuncionario_recebe',$iduser);            
            $this->db->where('ic_aprovado', 1);
            $this->db->order_by("feed_idfeedback", "desc");
            $dados['feedbacks'] = $this->db->get("feedbacks")->result();
            foreach ($dados['feedbacks'] as $key => $value) {
                $this->db->where('fk_feedback', $value->feed_idfeedback);
                $dados['competencias'][$value->feed_idfeedback] = $this->db->get("feedbacks_competencia")->result();
            }

                $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Perfil p�blico"=>"#" );
                
                $this->load->view('/geral/html_header', $dados);  
                $this->load->view('/geral/corpo_perfil_publico',$dados);
                $this->load->view('/geral/footer'); 
                
            }else{
                redirect( base_url("/perfil/pessoal_publico"."/".$idvisita) );
                /*$this->load->view('/geral/html_header_proibido');  
                 echo '<p class="text-center tit" style="margin-top: 30px">Voc� n�o pode ver esse perfil.</p>';
                $this->load->view('/geral/footer');*/                
            }            
	}
    
    public function profissional(){ 
            $this->Log->talogado(); 
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'profissional',
                'menu_colab_perfil_contrato' => ''
                );
            $this->session->set_userdata('perfil_atual', '1');
            $iduser = $this->session->userdata('id_funcionario');  
            $this->db->where('perfil_idfuncionario',$iduser);
            $dados['perfil_profissional'] = $this->db->get('perfil_profissional')->result();  
            
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_profissional',$dados);
            $this->load->view('/geral/footer'); 
	     }
       
    public function academico()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');  
            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'academico',
                'menu_colab_perfil_contrato' => ''
                );            
            
            $this->db->where('for_idfuncionario',$iduser);
            $dados['formacao_academica'] = $this->db->get('formacao_academica')->result();  
            
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
			
            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_academico',$dados);
            $this->load->view('/geral/footer'); 
	}
    
    public function interessepessoal()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');  
            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'interesse',
                'menu_colab_perfil_contrato' => ''
                );            
            
            $this->db->where('inter_idfuncionario',$iduser);
            $dados['interessepessoal'] = $this->db->get('interessepessoal')->result();

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_interessepessoal',$dados);
            $this->load->view('/geral/footer'); 
        }
    
    public function contrato_demonstrativo(){ 
            $this->Log->talogado(); 
            //$iduser = $this->session->userdata('id_funcionario');
            $iduser = (!empty($this->input->post('colab') ) )? $this->input->post('colab') : $this->session->userdata('id_funcionario');
            $dados = array(
                'menupriativo' => 'demonstrativo',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'demonstrativo'
                );
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->where('tipo_idfuncionario',$iduser);
<<<<<<< HEAD
            $this->db->order_by("tipo_mesref", "desc");
            $this->db->order_by("tipo_tipocal", "desc");
=======
>>>>>>> parent of 1fed7f9... Ajustes
            $dados['tipodecalculo'] = $this->db->get('tipodecalculo')->result();             
            $this->session->set_userdata('perfil_atual', '1');

            /*
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Holerith"=>"#" );
			 */
            //$this->load->view('/geral/html_header',$dados);
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/corpo_perfil_contato_demonstrativo',$dados);
            //$this->load->view('/geral/footer'); 
	}

    public function espelho_ponto() 
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');
            $idcli = $this->session->userdata('idcliente');
            $dados = array(
                'menupriativo' => 'espelho',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'espelho'
                );
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->where('tipo_idfuncionario',$iduser);
            $this->db->where('tipo_tipocal', 11);
            $this->db->order_by("tipo_mesref", "desc");

            $dados['tipodecalculo'] = $this->db->get('tipodecalculo')->result();
            
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/corpo_espelho_ponto',$dados);
    }

    public function soap(){

        //ini_set('user_agent','MSIE 4\.0b2;');

        $iduser = (!empty($this->input->post('colab') ) )? $this->input->post('colab') : $this->session->userdata('id_funcionario');

        //$iduser = $this->session->userdata('id_funcionario');
        $idempresa = $this->session->userdata('idempresa');
        try {
        
        $instancia =$this->session->userdata('instancia');                
        $arquivo = '../web/docs/'. $instancia;

            if (!file_exists($arquivo)) {
                if( ! mkdir($arquivo, 0777, true) ){
                    throw new Exception("Nao foi possivel criar a pasta");
                }
            }
            $arquivo .= "/ponto".$iduser.".pdf";
            $fp = fopen($arquivo, "w");

        } catch (Exception $e) {
            echo $e->getMessage();
            return;
        }

        $this->db->where('fun_idfuncionario',$iduser);
        $funcionario = $this->db->get('funcionario')->row();

        $idcalculo = $this->input->post("calcespelho");
        $this->db->where('tipo_idtipodecalculo', $idcalculo);
        $calculo = $this->db->get('tipodecalculo')->row();

        $this->db->where("idempresa", $idempresa);
        $param = $this->db->get('parametros')->row();

        $prEntrada = $param->entradaponto;

        $inicio = date('d/m/Y', strtotime($calculo->inicio_apuracao));
        $fim = date('d/m/Y', strtotime($calculo->fim_apuracao));

        $x = array("{", "}", "fun_numemp", "fun_numcad", "fun_tipcol", "IniApu", "FimApu");
        $y = array("", "", $funcionario->fun_numemp, $funcionario->fun_numcad, $funcionario->fun_tipcol, $inicio, $fim);

        $prEntrada = str_replace($x, $y, $prEntrada);

            /*   
           $parameters =  array(
            'prExecFmt'=> 'tefFile', //fixo
            'prFileName'=> 'relatoriotestes', //nomedoaquivo
            'prRelatorio'=> $param->relponto, //parametro ponto
            'prFileExt'=> 'Arquivo Formato PDF',//fixo
            'prSaveFormat'=> 'tsfPDF',//fixo
            'prEntranceIsXML'=> 'F', //fixo
            'prEntrada'=> $prEntrada
            );

            ini_set('soap.wsdl_cache_enabled',0); //fixo
            ini_set('soap.wsdl_cache_ttl',0);
            $opts = array(
                'http'=>array(
                    'user_agent' => 'hcmpeople'
                    ),
                'socket' => ['bindto' => '179.228.1.189']
                );
            $context = stream_context_create($opts);
             $client = new SoapClient($param->endwsdl);
            $stringWithFile = $client->__soapCall("Relatorios", [$param->userwsdl, $param->senhawsdl, 0, $parameters]);
            */


        $url = 'http://200.98.66.44/ws/ws.php'; //servidor windows
        $fields = array(
         'relponto' => $param->relponto,
        'prEntrada' => $prEntrada,
        'endwsdl' => $param->endwsdl,
        'userwsdl' => $param->userwsdl,
        'senhawsdl' => $param->senhawsdl
        );
        $postvars = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, $fields);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        $stringWithFile = curl_exec($ch);
        curl_close($ch);
        $str = unserialize($stringWithFile);
    

        $decodeds = $str->prRetorno;

        //header('Content-Description: File Transfer');
        header("Content-Type: application/pdf");
        header('Content-Disposition: inline; filename=$arquivo');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        flush();
        file_put_contents($arquivo, base64_decode($decodeds));
        //readfile("document.pdf");
        $caminho = str_replace("/web", "", $arquivo);   
        echo '<iframe src="'.$caminho.'" width="100%" style="height:900px"></iframe>';
    }
    
    public function contrato_remuneracao_anual()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');   
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'remuneracao'
                );
            $this->session->set_userdata('perfil_atual', '1');

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
			
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_contato_remuneranual',$dados);
            $this->load->view('/geral/footer'); 
	}
    
    public function contrato_evolucao_salarial()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');   
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'evolucao'
                );
            $this->session->set_userdata('perfil_atual', '1');
			
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;


            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_contato_evolusalarial',$dados);
            $this->load->view('/geral/footer'); 
	}
    
    public function contrato_contratos()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');  
            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'contratos'
                );            
            
            $this->db->select('*');
            $this->db->from('contratos');
            $this->db->join('funcionario', 'funcionario.fun_idfuncionario = contratos.contr_idfuncionario');  
            $this->db->join('endereco', 'endereco.end_idendereco = funcionario.fun_idendereco');  
            $this->db->join('estado', 'endereco.end_idestado = estado.est_idestado');  
            $this->db->join('cidade', 'endereco.end_idcidade = cidade.cid_idcidade');  
            $this->db->join('bairro', 'endereco.end_idbairro = bairro.bair_idbairro'); 
            $this->db->join('empresa', 'empresa.em_idempresa = contratos.contr_idempresa');  
            $this->db->where('contr_idfuncionario',$iduser);
            $dados['contratos'] = $this->db->get()->result(); 
            
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_contato_contratos',$dados);
            $this->load->view('/geral/footer'); 
	}
    
    public function feedbacks()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');
            $idcli = $this->session->userdata('idcliente');

            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'feedback',
                'menu_colab_perfil' => 'feedback',
                'menu_colab_perfil_contrato' => ''
                );            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();


            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');
            $this->db->where('feed_idfuncionario_recebe',$iduser);            
            $this->db->where('ic_aprovado', 1);
            $this->db->order_by("feed_idfeedback", "desc");
            $dados['feedbacks'] = $this->db->get("feedbacks")->result();
            foreach ($dados['feedbacks'] as $key => $value) {
                $this->db->where('fk_feedback', $value->feed_idfeedback);
                $dados['competencias'][$value->feed_idfeedback] = $this->db->get("feedbacks_competencia")->result();
            }

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get("parametros")->row();           

            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');  
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $this->db->where('ic_aprovado', 0);
            $dados['aprovacao'] = $this->db->get("feedbacks")->result();


            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');  
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $this->db->where('ic_aprovado', 2);
            $dados['ocultos'] = $this->db->get("feedbacks")->result();

            /*
            $this->db->where('fk_empresa', $idempresa);
            $dados['perguntas'] = $this->db->get("feedbacks_pergunta")->result();
            */

            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
			
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
            
            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Feedbacks"=>"#", "meus feedbacks"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_feedbacks',$dados);
            $this->load->view('/geral/footer'); 
	}

    public function demonstrativoBusca(){

           $iduser = $this->session->userdata('id_funcionario');

           if ( $this->input->post('calcdata')!="" ) {
           	$idtipo = $this->input->post('calcdata');
            $this->db->where('tipo_idtipodecalculo',$idtipo);
            $dados["colapse"]=true;
           }else{
            $this->db->where('tipo_idfuncionario',$iduser);
            $this->db->where('tipo_tipocal', 11);
           	$this->db->order_by("tipo_mesref", "desc");
			$this->db->limit(1);
			$dados["colapse"]=false;
           }            
            
            $dados['tipodecalculo'] = $this->db->get('tipodecalculo')->result();
            //echo $this->db->last_query();exit;
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/corpo_perfil_contato_demonstrativo_busca',$dados);
    }

    public function demonstrativoUltimo(){
            $idfun = $this->session->userdata('id_funcionario');
            $this->db->where('tipo_idfuncionario',$idfun);
            $this->db->order_by('tipo_idtipodecalculo',"desc");
            $this->db->limit(1, 0);         
            $dados['tipodecalculo'] = $this->db->get('tipodecalculo')->result();
            $this->load->view('/geral/corpo_perfil_contato_demonstrativo_busca',$dados);
    }

    public function aniversariantes()
        { 
            $this->Log->talogado(); 
                     
            $iduser = $this->session->userdata('id_funcionario');   
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'Peril Publico',
                'menu_colab_perfil_contrato' => ''
                );  

            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $mes = date("m");
            $this->db->where('MONTH(fun_datanascimento)',"6");
            $dados['aniversariantes'] = $this->db->get('funcionario')->result();

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Feedbacks"=>"#", "meus feedbacks"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_aniversariantes',$dados);
            $this->load->view('/geral/footer'); 
         }

    public function familiar(){
            $this->Log->talogado();
            $dados = array( 'menupriativo' => 'perfil', 'menu_colab_perfil' => 'familiar', 'menu_colab_perfil_contrato' => '');
                  
            $iduser = $this->session->userdata('id_funcionario');
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();
            
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $this->db->select('*');
            $this->db->from('dependentes');
            $this->db->join('tipodependente', 'dependentes.deptipo = tipodependente.tipdep');  
            $this->db->where('dep_idfuncionario',$iduser);
            $dados['dependentes'] = $this->db->get()->result();            
            
            $this->session->set_userdata('perfil_atual', '1');
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_familiar',$dados);
            $this->load->view('/geral/footer'); 
         }

    public function lembretes(){
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');

            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'lembretes'
                );
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get("parametros")->row();

            $this->db->join("lembrete_categoria", "lembrete.fk_categoria = id_categoria");
            $this->db->where('fk_destinatario',$iduser);
            $dados['lembretes'] = $this->db->get('lembrete')->result();

            $dados["categorias"] = $this->db->get("lembrete_categoria")->result();          
            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Mensagens e lembretes"=>"#", "Cadastro de lembrete"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_lembrete_cadastro',$dados);
            $this->load->view('/geral/footer'); 
    }

    public function mensagem(){
        $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');

            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'mensagem'
                );

            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();


            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get("parametros")->row();
            
            $this->db->select('mensagem.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'mensagem.fk_destinatario_mensagem = funcionario.fun_idfuncionario');
            $this->db->where('fk_remetente_mensagem',$iduser);
            $this->db->where('ic_vizualizado != 2');        
            $this->db->order_by("id_mensagem", "desc");
            $this->db->limit(10);
            $dados['msg_enviadas'] = $this->db->get("mensagem")->result();

            $this->db->select('mensagem.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'mensagem.fk_remetente_mensagem = funcionario.fun_idfuncionario');
            $this->db->where('fk_destinatario_mensagem', $iduser);
            $this->db->where('ic_vizualizado != 3');
            $this->db->order_by("id_mensagem", "desc");
            $this->db->limit(10);
            $dados['msg_recebidas'] = $this->db->get("mensagem")->result();

            $this->db->select('mensagem.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'mensagem.fk_remetente_mensagem = funcionario.fun_idfuncionario');
            //$this->db->where('ic_vizualizado', 2);
            $this->db->where('(fk_remetente_mensagem = '.$iduser.' OR fk_destinatario_mensagem = '.$iduser.')');
            $this->db->order_by("id_mensagem", "desc");
            $this->db->limit(10);
            $dados['msg_excluidas'] = $this->db->get("mensagem")->result();
            $this->session->unset_userdata('primsg');
            $dados['breadcrumb'] = array('Colaborador'=>base_url('home'), "Mensagens"=>"#" );

            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_mensagem',$dados);
            $this->load->view('/geral/footer');
    }

    public function aso(){
        $iduser = $this->session->userdata('id_funcionario');
        $date = new DateTime(date("Y-m-d"));
        $date->add(new DateInterval('P15D'));
        $this->db->select("fun_idfuncionario, fun_foto, fun_nome, fun_sexo, contr_cargo, fun_proximoexame");
        $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");

        if ($this->input->post("dash")=="gestor"){
            $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
            $this->db->where("chefiasubordinados.chefe_id", $iduser);
        }        
        

        if ($this->input->post("opcao")=="1") {
            $dados['tipo'] = "Vencimento";
            $this->db->where("fun_proximoexame <=", $date->format('Y-m-d') );
            $this->db->where("fun_proximoexame >=", date('Y-m-d') );
        }else{
            $dados['tipo'] = "Vencido";
            $this->db->where("fun_proximoexame < ", date('Y-m-d') );
        }
        
        $this->db->where("fun_status", "A" );
        $dados['vencer'] = $this->db->get('funcionario')->result();

        header ('Content-type: text/html; charset=ISO-8859-1');
        $this->load->view("/geral/edit/modal_aso", $dados);
    }

    public function buscaColabEmpresa(){

      $iduser = $this->session->userdata('id_funcionario');
      $idempresa = $this->session->userdata('idempresa');

      $this->db->from('funcionario');
      $this->db->where('fun_status',"A");
      $this->db->where('fun_idempresa', $idempresa);
      $dados['usuarios'] = $this->db->get()->result();

      header ('Content-type: text/html; charset=ISO-8859-1');
      $this->load->view('/geral/edit/modal_funcionario',$dados);
  }

}