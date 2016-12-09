<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller {
	
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->model('Log'); 
        $this->load->model('Admbd');  
    }

    public function index()
    { 

    }
    public function email_senha(){

        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('usu_email',$this->input->post('email'));
        $funcionarios = $this->db->get()->result(); 

        $resposta = 'erro';

        foreach ($funcionarios as $value) {
            $resposta = 'ok';
            $mensagem = "<h3>Olá ".$value->usu_nome."</h3>
            <h4>Segue suas credenciais de acesso ao portal da empresa </h4>
            <p>Login: <strong>".$value->usu_email."</strong> </p>
            <p>Senha: <strong>".$value->usu_senha."</strong> </p>";

            $this->load->library('email');
            $this->email->from('contato@hcmsolucoes.com.br','Credenciais de acesso');
            $this->email->to($this->input->post('email'));
            $this->email->subject('Esqueceu a senha');
            $this->email->set_mailtype("html");
            $this->email->message($mensagem);
            $this->email->send();

        }
        echo $resposta;
    }
    public function pdf()
    { 
            $this->load->view('/geral/edit/test/pdf',[]);
    }

    public function logar()
    { 
        $email = $this->input->post('email');
        $senha = md5($this->input->post('senha'));
        $empresa = (!empty($this->input->post('empresa') ) )? $this->input->post('empresa') : "";

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usu_email',$email);
        $this->db->where('usu_senha',$senha);
        $this->db->where('usu_status',"A");
        $usuario = $this->db->get()->result();	
        
        if(count($usuario)===1){

            $idfun = $usuario[0]->usu_idfuncionario;
            $this->db->select("empresa.em_nome, funcionario_empresa.*");
            $this->db->join("empresa", "fk_empresa = em_idempresa");
            $this->db->where('fk_funcionario', $idfun);
            $fun["empresas"] = $this->db->get("funcionario_empresa")->result();
            foreach ($fun['empresas'] as $key => $value) {
                $emp = $value->fk_empresa;
            }

            if( !empty($empresa) ){


                $emp = $empresa;
              
            }else if (count($fun['empresas'])>1) {

                //echo count($fun['empresas']); exit();
               $select = '<div class="form-group">
               <div class="col-md-12">
                <select class="form-control" id="empresa" name="empresa" required>
                    <option value="">Selecione uma empresa</option>';
                    foreach ($fun['empresas'] as $key => $value) {

                        $select .= '<option value="'.$value->fk_empresa.'">'. $value->em_nome.'</option>';

                    }
                    $select .= '</select></div></div>';
                    echo $select;
                    exit();
                }
                
                $this->db->where('eme_idempresa', $emp);
                $modulos = $this->db->get('modulos_e_empresa')->result();
                $mod = '';

                foreach ($modulos as $value) {
                    $mod = $mod.','.$value->eme_idmodulo;
                }
                $dados = array(
                    'id_funcionario' => $usuario[0]->usu_idfuncionario,
                    'perfil'         => $usuario[0]->usu_perfil,
                    'idempresa'      => $emp,
                    'idcliente'      => $usuario[0]->usu_idcliente,     
                    'modulos'        => $mod,
                    'logado'         => TRUE
                    );
                $this->session->set_userdata($dados);

                //redirect( base_url());
                echo "ok";                  
            }else{
               echo "erro";
           }
       }


    public function primeiroacesso(){ 

        $nascimento = $this->Log->alteradata2( $this->input->post('nascimento') );
        $cpf = $this->input->post('cpf');

        $this->db->select('usu_senha');
        $this->db->where('usu_cpf',$cpf);
        $fun = $this->db->get("usuarios")->row();

        if( is_object($fun) ){
            echo 1;
            exit();
        }
        $this->db->select('*');
        $this->db->from('funcionario');
        $this->db->where('fun_datanascimento',$nascimento);
        $this->db->where('fun_cpf',$cpf);
        $this->db->limit(1);
        $usuario = $this->db->get()->result();		

        if(count($usuario)===1){
            $this->db->where('eme_idempresa',$usuario[0]->fun_idempresa);
            $modulos = $this->db->get('modulos_e_empresa')->result();
            $mod = '';
            foreach ($modulos as $value) {
                $mod = $mod.','.$value->eme_idmodulo;
            }
            $dados = array(
                'id_funcionario' => $usuario[0]->fun_idfuncionario,
                'perfil'         => $usuario[0]->fun_perfil,
                'idempresa'      => $usuario[0]->fun_idempresa,
                'nome'           => $usuario[0]->fun_nome,
                'nascimento'           => $usuario[0]->fun_datanascimento,
                'email'           => $usuario[0]->fun_email,
                'idcliente'      => $usuario[0]->fun_idcliente,     
                'cpf'      => $usuario[0]->fun_cpf,
                'modulos'        => $mod,
                'logado'         => false
                );
            //$this->session->set_userdata($dados);

                //$dados["usu"] = array('nome' => $usuario[0]->usu_nome);
            $this->load->view('/geral/box/login_cad1', $dados);                 
        }else{
            echo "erro";
        } 
    }

    public function primeirocadastro()
    { 
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
        $idfun = $this->input->post('idfun');           

        $dados['fun_email'] = $email;
        $dados['fun_senha'] = $senha;

        $this->Admbd->armazenar('funcionario', $dados, $idfun, 'fun_idfuncionario');

        $usu['usu_email'] = $email;
        $usu['usu_senha'] = $senha;
        $usu['usu_idfuncionario'] = $idfun;
        $usu['usu_nome'] = (!empty( $this->input->post('nome') ) )?$this->input->post('nome') :"";
        $usu['usu_nascimento'] = (!empty( $this->input->post('nasc') ) )?$this->input->post('nasc') :"";
        $usu['usu_perfil'] = (!empty( $this->input->post('perfil') ) )?$this->input->post('perfil') :"";
        $usu['usu_idempresa'] = (!empty( $this->input->post('empresa') ) )?$this->input->post('empresa') :"";
        $usu['usu_idcliente'] = (!empty( $this->input->post('cliente') ) )?$this->input->post('cliente') :"";
        $usu['usu_cpf'] = (!empty( $this->input->post('cpf') ) )?$this->input->post('cpf') :"";

        $this->db->insert('usuarios', $usu);
        $res = $this->db->insert_id();
        if($res>0){
            $this->session->set_userdata('logado', true);
            echo "ok";
        }

    }
    public function deslogar()
    { 
        $this->session->sess_destroy();
        redirect( base_url());
    }

    public function mudartema(){

        if( !empty($this->input->post('fundo')) ){ $dados['tema_fundo'] = $this->input->post('fundo'); }

        if( !empty($this->input->post('cor')) ){$dados['tema_cor'] = $this->input->post('cor'); }

        $idcli = $this->session->userdata('id_funcionario');
        $this->db->where('fun_idfuncionario', $idcli);
        $res = $this->db->update("funcionario", $dados);
        echo $res;

    }

    public function evsalarial(){
        $idcli = $this->session->userdata('id_funcionario');
        $this->db->where('sal_idfuncionario', $idcli);
        $this->db->order_by('sal_idsalarios', "asc");
        $this->db->limit(5);
        $arr = $this->db->get('salarios')->result();


        foreach ($arr as $key => $value) {
            $d =  $this->Log->alteradata1($value->sal_dataini);
            $d = substr($d, 3,7);
            $v = (float)number_format( $value->sal_valor, 2, ".", "");


            $f = 'R$'.number_format( $value->sal_valor, 2, ",", ".")."\n".$value->sal_motdescricao;
            $rows[] = array( $d, $v, $f );
        }
        $dados = array("cols"=> array('string'=>"data", "number"=>"valor", "col"=>array('type' => 'string', 'role' => 'tooltip', 'p' => array('html' => true))),
            "rows"=> $rows, "teste"=>$idcli );
            /*
            $dados[] = array("x"=>"2006", "a"=>128, "motivo"=>"aumento");
            $dados[] = array("x"=>"2007", "a"=>108, "motivo"=>"bonus");
            $dados[] = array("x"=>"2008", "a"=>38, "motivo"=>"teste");
            $dados[] = array("x"=>"2010", "a"=>58, "motivo"=>"admissâo");
            $dados[] = array("x"=>"2011", "a"=>78, "motivo"=>"aumento");
            */

            echo json_encode($dados);
        }

    public function buscaColabChefia(){

            if (!empty($this->input->post('busca'))) { 

                $busca = $this->input->post('busca');
                $this->db->like('fun_nome',$busca);

            }

            $iduser = $this->session->userdata('id_funcionario');   
            $empresa = $this->session->userdata('idempresa');            
            $this->db->select("funcionario.fun_nome, funcionario.fun_cargo, funcionario.fun_perfil, funcionario.fun_idfuncionario, empresa.em_nomefantasia");
            $this->db->from('funcionario');
            $this->db->join("empresa", "fun_idempresa = em_idempresa");
            //$this->db->where('fun_idfuncionario != ', $iduser);
            $this->db->where('fun_idempresa', $empresa);
            $this->db->where('(fun_perfil = 2 OR fun_perfil = 4)');
            $this->db->where('fun_status', "A");
            $dados['usuarios'] = $this->db->get()->result();
            $this->load->view('/geral/edit/chefia_busca',$dados); 

        }

    public function alteraNivelPerfil(){

            if (!empty($this->input->post('perfil'))) {

                $dados['fun_perfil'] = $this->input->post('perfil');
                $idfuncionario = $this->input->post('idfuncionario');            
                $this->db->where("fun_idfuncionario", $idfuncionario);

                $this->db->update('funcionario', $dados);

            }

        }

    public function jsonHierarquia(){

            $idchefe = $this->input->post('chefe');            
            $dados['chefe']=$idchefe;
            $corpo = (!empty( $this->input->post('corpo') )? $this->input->post('corpo') : 1) ;

            $this->db->select("funcionario.*, contratos.contr_data_admissao, contratos.contr_departamento, contratos.contr_centrocusto, chefiasubordinados.subor_id");
            $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
            $this->db->where("chefiasubordinados.chefe_id", $idchefe);
            $this->db->where("fun_status", "A");
            $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
            $this->db->from('funcionario');
            $dados['subordinados'] = $this->db->get()->result();

            $this->db->select("funcionario.*, contratos.contr_data_admissao, contratos.contr_departamento, endereco.*, bairro.bair_nomebairro, cidade.cid_nomecidade, est_nomeestado ");
            $this->db->join('contratos',"contr_idfuncionario = fun_idfuncionario");
            $this->db->join('endereco', "end_idendereco = fun_idendereco");
            $this->db->join('bairro', "end_idbairro = bair_idbairro");
            $this->db->join('cidade', "end_idcidade = cid_idcidade");
            $this->db->join('estado', "end_idestado = est_idestado");

            $this->db->where('fun_idfuncionario',$idchefe);
            $dados['dadoschefe'] = $this->db->get("funcionario")->result();

            
            switch ($corpo) {
             case '2': $this->load->view('/geral/corpo_equipe_resultado',$dados); break;                   
             default: $this->load->view('/geral/edit/chefia_subordinados_busca',$dados); break;
         }
     }

    public function chefia_edit_subor(){


        if (!empty($this->input->post('chefe'))) {

            $dados['chefe_id'] = $this->input->post('chefe');
            $dados['subor_idfuncionario'] = $this->input->post('colab');

            if ($this->input->post('operacao')==1) {

                $this->db->insert("chefiasubordinados", $dados);
                echo $this->db->insert_id();

            }else{

                $this->db->where("chefe_id", $this->input->post('chefe'));
                $this->db->where("subor_idfuncionario", $this->input->post('colab'));
                $this->db->delete("chefiasubordinados");
                echo 0;
            }


        }

    }

    public function buscaGestor(){
        $idchefe = $this->input->post('chefe');
        $this->db->where("fun_idfuncionario", $idchefe);
        $this->db->join("contratos", "fun_idfuncionario = contr_idfuncionario", "LEFT");
        $dados['chefe'] =$this->db->get('funcionario')->result();

        $this->db->select("funcionario.fun_nome, funcionario.fun_cargo, funcionario.fun_perfil, funcionario.fun_idfuncionario, funcionario.fun_sexo, empresa.em_nomefantasia");

        $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");            
        $this->db->where("chefiasubordinados.chefe_id", $idchefe);
        $this->db->where('fun_status',"A");
        $this->db->from('funcionario');
        $this->db->join("empresa", "fun_idempresa = em_idempresa");

        $dados['subordinados'] = $this->db->get()->result();
        $this->load->view('/geral/edit/chefia_consulta_gestor',$dados);
    }

    public function buscaColabSubor(){

        $idchefe = $this->input->post('chefe');

        $this->db->where('fun_idfuncionario', $idchefe);
        $arr = $this->db->get("funcionario")->result();
        foreach ($arr as $key => $value) {
          $idempresa = $value->fun_idempresa;
      }

      $iduser = $this->session->userdata('id_funcionario');           
      $this->db->select("funcionario.*, empresa.em_nomefantasia");
      $this->db->from('funcionario');
      $this->db->join("empresa", "fun_idempresa = em_idempresa");
      $this->db->where('fun_status',"A");
      $this->db->where('fun_idempresa', $idempresa);
      $this->db->where_not_in('fun_idfuncionario', $iduser);
      $dados['usuarios'] = $this->db->get()->result();

      $this->db->select("chefiasubordinados.subor_idfuncionario");
      $this->db->where("chefiasubordinados.chefe_id", $idchefe);            
      $dados['subordinados'] = $this->db->get("chefiasubordinados")->result();

      $this->load->view('/geral/edit/chefia_modal_colab',$dados);
  }

    public function atualizarFeed(){

        $idfeed = $this->input->post('idfeed');
        $dados['ic_aprovado'] = $this->input->post('status');
        $this->db->where("feed_idfeedback", $idfeed);
        echo $this->db->update('feedbacks', $dados);
    }

    public function salvarPergunta(){

        $idempresa = $this->session->userdata('idempresa');
        $dados['desc_pergunta'] = $this->input->post('desc');

        $dados['fk_empresa'] = $idempresa;

        if ($this->input->post('operacao')==1) {
            $this->db->insert("feedbacks_pergunta", $dados);
            echo $this->db->insert_id();
        }

     }

    public function buscaPessoa(){

        $idempresa = $this->session->userdata('idempresa');
        $iduser = $this->session->userdata('id_funcionario'); 
        $busca = $this->input->post('busca');
        $this->db->where("idempresa", $idempresa);
        $parametros = $this->db->get("parametros")->row();


        $this->db->where("fun_idfuncionario", $iduser);
        $user = $this->db->get("funcionario")->row();            

        if ($parametros->Param_feed==1) {

            $this->db->where("fk_departamento", $user->fk_departamento);

        }else if( ($parametros->Param_feed=="0") && ($parametros->Param_chefia=="0") ){

            $this->db->select("fun_nome, fun_foto, fun_idfuncionario");
            $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
            $this->db->where("chefiasubordinados.chefe_id", $iduser);

        }else if($parametros->Param_chefia==1){

            $this->db->where("fk_departamento", $user->fk_departamento);

     }


        $this->db->where("fun_idempresa", $idempresa);
        $this->db->where("fun_idfuncionario != ", $iduser);
        $this->db->like("fun_nome", $busca);
        $this->db->where('fun_status',"A");
        $dados['funcionarios'] = $this->db->get("funcionario")->result();

        $this->load->view('/geral/busca_feed_pessoa',$dados);

     }

    public function enviarFeedback(){

        $colabs = $this->input->post('colaboradores');
        $ratings = $this->input->post('ratings') ;
        $comps = $this->input->post('competencia');
        $dados['feed_depoimento'] = $this->input->post('mensagem');
        $dados['feed_data'] = date("Y")."-".date("m")."-".date("d");
        $dados['feed_idfuncionario_envia'] = $this->session->userdata('id_funcionario');

        $i=0;
        foreach ($colabs as $key => $value) {
            $dados['feed_idfuncionario_recebe'] = $value;
            $this->db->insert("feedbacks", $dados);
            $idfeed = $this->db->insert_id();
            $i++;

        foreach ($comps as $k => $v) {
            $arraycomp['desc_competencia'] = $v;
            $arraycomp['fk_feedback'] = $idfeed;
            if (!empty( $ratings)) {
                $arraycomp['rating_competencia'] = current($ratings);
                next($ratings);
            }                
            $this->db->insert("feedbacks_competencia", $arraycomp);                
        }
        if(!empty( $ratings)){
            reset($ratings);
        } 

        }
            echo 1;//$this->db->affected_rows();
    }

    public function autocompleteLembrete(){

        $idempresa = $this->session->userdata('idempresa');
        $iduser = $this->session->userdata('id_funcionario'); 
        $busca = $this->input->post('busca');
        $campo = $this->input->post('campo');

        $dados['campo'] = $campo;
            //$parametros = $this->db->get("parametros")->row();
        $this->db->where("fun_idempresa", $idempresa);
        $this->db->where("fun_idfuncionario", $iduser);
        $user = $this->db->get("funcionario")->row();       

        if ($campo =="departamento") {
            $this->db->where("idempresa", $idempresa);
            $this->db->like("descricao", $busca);
            $dados['lista'] =$this->db->get("tabeladepartamento")->result();

        }else if($campo =="colab"){

            $this->db->like("fun_nome", $busca);
            $this->db->where("fun_idempresa", $idempresa);
            $this->db->where("fun_idfuncionario != ", $iduser);
            $dados['lista'] =$this->db->get("funcionario")->result();

        }

        $this->load->view('/geral/autocomplete_lembrete',$dados);

     }

    public function salvarLembrete(){

        $idempresa = $this->session->userdata('idempresa');
        $iduser = $this->session->userdata('id_funcionario'); 

        $dados["fk_remetente"] = $iduser;
        $dados["fk_empresa"] = $idempresa;

        $dados["fk_categoria"] = $this->input->post("categoria");
        $dados["titulo_lembrete"] = $this->input->post("titulo");

        if (!empty($this->input->post("descricao"))) {
            $dados["descricao_lembrete"] = str_replace("\n",'<br />', addslashes($this->input->post("descricao") ) ); 
        }

        $dados["ic_recorrente_lembrete"] = $this->input->post("recorrente");

        $hora_aviso = (!empty($this->input->post("hora_aviso")) )? $this->input->post("hora_aviso") : "00:00:00";
        if(!empty( $this->input->post("data_aviso") ) ){

        $dados["dt_inicio_lembrete"] = $this->Log->alteradata2($this->input->post("data_aviso"))." ".$hora_aviso;

        }
        
        $hora_termino = (!empty($this->input->post("hora_termino")) )? $this->input->post("hora_termino") : "00:00:00";
        if (!empty($this->input->post("data_termino"))) {
           $dados["dt_final_lembrete"] = $this->Log->alteradata2($this->input->post("data_termino"))." ".$hora_termino;
       }

       if (!empty($this->input->post("periodo"))) {
          $dados["id_periodo_lembrete"] = $this->input->post("periodo");
      }

            //$dados["ic_frequencia_lembrete"] = $this->input->post("frequencia");
      if (!empty($this->input->post("validade"))) {
         $dados["ic_validade_lembrete"] = 1;//$this->input->post("validade");
     }

        $dest = $this->input->post("destinatario");
        $this->db->insert("lembrete", $dados);
        //echo $this->db->last_query(); exit();
        $idlembrete = $this->db->insert_id();
        if ($idlembrete > 0) {

        $arr['fk_lembrete'] = $idlembrete;
        $noti['descricao_notificacao'] = "Existem lembretes para você";
        $noti['link_notificacao'] = base_url("/perfil/lembretes") ;
        $noti['ic_tipo_notificacao'] = 1;


        if ($dest=="filtro") {

            $colabs = $this->input->post("colabs");
            $departs = $this->input->post("depts");

            if (!empty($colabs) ) {
               foreach ($colabs as $key => $value) {
                  $arr['fk_destinatario'] = $value;
                       $arr['ic_tipo_destinatario'] = 1;//indica que é para colaboradores
                       $this->db->insert("lembrete_destinatario", $arr);

                       $noti['fk_idfuncionario'] = $value;
                       $this->db->insert("notificacao", $noti);
                   }
               }

               if (!empty($departs) ) {
                   foreach ($departs as $key => $value) {

                        $arr['fk_destinatario'] = $value;
                        $arr['ic_tipo_destinatario'] = 2;//indica que é para departamentos
                        $this->db->insert("lembrete_destinatario", $arr);

                        $this->db->where('fun_status', "A");
                        $this->db->where('fk_departamento', $value);
                        $this->db->where('fun_idempresa', $idempresa);
                        $funcs = $this->db->get("funcionario")->result();

                        foreach ($funcs as $k => $v) {
                            $noti['fk_idfuncionario'] = $v->fun_idfuncionario;
                            $this->db->insert("notificacao", $noti);
                        }
                    }
                }


            }else{

                $this->db->where('fun_status', "A");
                $this->db->where('fun_idempresa', $idempresa);
                $funcs = $this->db->get("funcionario")->result();
                $arr['ic_tipo_destinatario'] = 3;//indica que é para todos
                $this->db->insert("lembrete_destinatario", $arr);

                    foreach ($funcs as $key => $value) {
                        $noti['fk_idfuncionario'] = $value->fun_idfuncionario;
                        $this->db->insert("notificacao", $noti);
                    }

                }
            }
            echo $idlembrete;
     }

    public function calendarLembretes(){

        $iduser = $this->session->userdata('id_funcionario'); 

        $this->db->select("fk_departamento");
        $this->db->where('fun_idfuncionario',$iduser);
        $func = $this->db->get('funcionario')->row();
        $iddepart = $func->fk_departamento;

        $this->db->join("lembrete_categoria", "lembrete.fk_categoria = id_categoria");
        $this->db->join("lembrete_destinatario", "lembrete.id_lembrete = lembrete_destinatario.fk_lembrete", "left");
        $this->db->where('fk_remetente',$iduser);
        $this->db->or_where('fk_destinatario',$iduser);
        $this->db->or_where('(fk_destinatario = '.$iddepart.' AND ic_tipo_destinatario = 2)');
        $this->db->or_where('ic_tipo_destinatario', 3);
        $dados = $this->db->get('lembrete')->result();

        $lem = array();
        foreach ($dados as $key => $value) {

            $lem[$value->id_lembrete] = $value;

        }
        foreach ($lem as $key => $value) {
            $termino = ( substr($value->dt_final_lembrete, 0,4)=="0000" )? "" : $value->dt_final_lembrete;
            $arr[] = array('allDay' => "false", 
                "title"=>$value->titulo_lembrete, 
                "id"=>$value->id_lembrete, 
                "start"=>$value->dt_inicio_lembrete, 
                "end"=>$termino
                );
        }

        echo json_encode($arr);
     }

    public function maismensagens(){

        $iduser = $this->session->userdata('id_funcionario');
        $fim = $this->input->post('fim');
        $this->db->select('mensagem.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
        $this->db->join('funcionario', 'mensagem.fk_remetente_mensagem = funcionario.fun_idfuncionario');
        $this->db->where('(fk_remetente_mensagem = '.$iduser.' OR fk_destinatario_mensagem = '.$iduser.' )');
        $this->db->where('(id_mensagem < '. $fim. ')');
        $this->db->order_by("id_mensagem", "desc");
        $this->db->limit(10);
        $dados = $this->db->get("mensagem")->result();
        //$this->load->view('/geral/box/maismensagens',$dados);
        $msg="";
        if ( !is_object($dados)) {
           echo 1; exit();
        }
        foreach ($dados as $key => $value) { 

                $primsg = $value->id_mensagem;
            
                if($value->fk_remetente_mensagem==$iduser){
                  $in = "in";
                  $float = "fright";
                  $margin = "margin-right: 7px;";
                }else{
                  $in = "";
                  $float = "fleft";
                  $margin = "margin-left: 7px;";
                }
               
                list($data, $hora) = explode(" ", $value->datahora_mensagem);
                $data = $this->Log->alteradata1( $data );
                $msg .= '<div class="item '. $in . ' item-visible" id="item'.$value->id_mensagem.'">
              <div class="image">
                <img src="'. $value->fun_foto . '">
              </div>                           
              <div class="text '.$float.' " style="width: 94%; '.$margin.' ">              
                <div class="heading">
                  <a href="#" class="fleft">'.$value->fun_nome.'</a>
                  <span class="fa fa-times fright excmsg" id="<?php echo $value->id_mensagem; ?>" style="font-size: 1.5em; cursor: pointer; margin-top: 30px;"></span>
                  <span class="date"'. $data." ".substr($hora, 0, 5). '</span>
                </div>
                <span style="float: left;color: #000;font-size: 12px;clear: left;">'.$value->texto_mensagem.'</span>
              </div>
            </div>';
             }
        $json['fim']= $primsg;
        $json['status']= "ok";
        $json['mensagens'] = $msg;
        echo json_encode($json);
        //echo $this->db->last_query();

    }

    public function excluirLembrete(){

        $id = $this->input->post("id");
        //echo $id; exit();
        $this->db->where("id_lembrete", $id);
        $this->db->delete("lembrete");

        $this->db->where("fk_lembrete", $id);
        $this->db->delete("lembrete_destinatario");

        $res['msg']=1;
        echo json_encode($res);

    }

    public function excluirmensagens(){

        $id = $this->input->post("id");
        //echo $id; exit();
        $this->db->where("id_mensagem", $id);
        $this->db->delete("mensagem");

    }

    public function addMensagem(){

        if (!empty($this->input->post("texto"))) {
            $dados["texto_mensagem"] = $this->input->post("texto"); 
        }
       
        $dados["fk_remetente_mensagem"] = $this->session->userdata("id_funcionario");

        if (!empty($this->input->post("destinatario"))) {
            $dados["fk_destinatario_mensagem"] = $this->input->post("destinatario"); 
        }

        $this->db->insert("mensagem", $dados);
        $idmensagem = $this->db->insert_id();

        $this->db->select("fun_nome");
        $this->db->where("fun_idfuncionario", $this->session->userdata("id_funcionario"));
        $fun = $this->db->get("funcionario")->row();
        $nome = explode(" ", $fun->fun_nome);
        $noti['descricao_notificacao'] = $nome[0]. " enviou uma mensagem para você";

        $noti['link_notificacao'] = base_url("/perfil/lembretes");
        $noti['ic_tipo_notificacao'] = 2;
        $noti['fk_idfuncionario'] = $this->input->post("destinatario");
        $this->db->insert("notificacao", $noti);



        if($idmensagem>0){
            echo json_encode($id_mensagem);
        }else{
            echo json_encode("erro");
        }
        
    }

    public function modaLembrete(){

        $id = $this->input->post("id");
        //echo $id; exit();
        $this->db->select("lembrete.*, funcionario.fun_nome, lembrete_destinatario.*");
        $this->db->where("id_lembrete", $id);        
        $this->db->join("lembrete_categoria", "lembrete.fk_categoria = id_categoria");
        $this->db->join("lembrete_destinatario", "lembrete.id_lembrete = lembrete_destinatario.fk_lembrete", "left");
        $this->db->join("funcionario", "lembrete.fk_remetente = fun_idfuncionario");
        $dados['lembrete'] = $this->db->get('lembrete')->row();
        $this->load->view("/geral/box/modalembrete", $dados);

    }

    public function perfilPrivacidade(){
        $iduser = $this->session->userdata('id_funcionario');
        $campo = $this->input->post("campo");
        $valor = ($this->input->post("valor")=="true" )? 1:0 ;
        $array[$campo] = $valor;

        $this->db->select($campo);
        $this->db->where("fk_priv_funcionario", $iduser);
        $dados = $this->db->get('perfil_privacidade')->row();

        if (is_object($dados)) {
            $this->db->where("fk_priv_funcionario", $iduser);
           $this->db->update("perfil_privacidade", $array);
        }else{
            $array["fk_priv_funcionario"] = $iduser;
            $this->db->insert("perfil_privacidade", $array);
        }
        echo "ok";
    }

    public function vistoNotificacao(){

        $iduser = $this->session->userdata('id_funcionario');
        $idnoti = $this->input->post("idnoti");
        $array['ic_visualizado'] = 1;

        $this->db->where("id_notificacao", $idnoti);
        $this->db->update("notificacao", $array);

    }



 }    