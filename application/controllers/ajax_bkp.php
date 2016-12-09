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
            $this->db->from('funcionario');
            $this->db->join('empresa', 'empresa.em_idempresa = funcionario.fun_idempresa');  
            $this->db->where('fun_email',$this->input->post('email'));
            $funcionarios = $this->db->get()->result(); 
            
            
            $resposta = 'erro';
            
            foreach ($funcionarios as $value) {
                $resposta = 'ok';
                $mensagem = "<h3>Olá ".$value->fun_nome."</h3>
                             <h4>Segue suas credenciais de acesso ao portal da empresa ".$value->em_nome."</h4>
                             <p>Login: <strong>".$value->fun_email."</strong> </p>
                             <p>Senha: <strong>".$value->fun_senha."</strong> </p>";
                
                
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

        public function logar()
        { 
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
       
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->where('fun_email',$email);
            $this->db->where('fun_senha',$senha);
            $usuario = $this->db->get()->result();		
            if(count($usuario)===1){
                $this->db->where('eme_idempresa',$usuario[0]->fun_idempresa);
                $modulos = $this->db->get('modulos_e_empresa')->result();
                $mod = '';
                $avatar = ( strcasecmp($usuario[0]->fun_sexo, "masculino")==0 )?"avatar1":"avatar2";
                $foto = (empty( $usuario[0]->fun_foto) )? "http://hcmsolucoes.com.br/people/img/".$avatar.".jpg" : $usuario[0]->fun_foto; 
                 
                foreach ($modulos as $value) {
                    $mod = $mod.','.$value->eme_idmodulo;
                }
                $dados = array(
                    'id_funcionario' => $usuario[0]->fun_idfuncionario,
                    'perfil'         => $usuario[0]->fun_perfil,
                    'perfil_atual'   => $usuario[0]->fun_perfil,
                    'nome'           => $usuario[0]->fun_nome,
                    'foto'           => $foto,
                    'email'          => $usuario[0]->fun_email,   
                    'cargo'          => $usuario[0]->fun_cargo,   
                    'idempresa'      => $usuario[0]->fun_idempresa,
                    'idcliente'      => $usuario[0]->fun_idcliente,     
                    'modulos'        => $mod,
                    'logado'         => TRUE
                 );
                $this->session->set_userdata($dados); 
                redirect( base_url());                      
            }else{
                 echo "erro";
            }
	   }
        
        public function primeiroacesso()
        { 
            $matricula = $this->input->post('matricula');
            $cpf = $this->input->post('cpf');
                        
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->where('fun_matricula',$matricula);
            $this->db->where('fun_cpf',$cpf);
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
                    'perfil_atual'   => '1',
                    'nome'           => $usuario[0]->fun_nome,
                    'foto'           => $usuario[0]->fun_foto,
                    'email'          => $usuario[0]->fun_email,   
                    'cargo'          => $usuario[0]->fun_cargo,   
                    'idempresa'      => $usuario[0]->fun_idempresa,     
                    'modulos'        => $mod,
                    'logado'         => TRUE
                 );
                $this->session->set_userdata($dados);
                $this->load->view('/geral/box/login_cad1',$dados);                 
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
            $cliente = $this->session->userdata('idcliente');            
            $this->db->select("funcionario.fun_nome, funcionario.fun_cargo, funcionario.fun_perfil, funcionario.fun_idfuncionario, empresa.em_nomefantasia");
            $this->db->from('funcionario');
            $this->db->join("empresa", "fun_idempresa = em_idempresa");
            $this->db->where_not_in('fun_idfuncionario', $iduser);
            $this->db->where('fun_idcliente', $cliente);
            $this->db->where('fun_perfil', 2);
            $this->db->or_where('fun_perfil', 4);
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


}