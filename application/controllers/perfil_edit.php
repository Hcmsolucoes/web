<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Perfil_edit extends CI_Controller {
	
	public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('html');
            $this->load->library('session');
            $this->load->model('Log'); 
            $this->load->model('Admbd');  
            $this->load-> database();
	}
	

    public function recu_senha()
    {

        if (!empty($this->input->post('usu_email'))) {$dados['usu_email'] = $this->input->post('usu_email'); }  

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usu_email',$dados['usu_email']);
        $usuario = $this->db->get()->result();

        if(!$usuario){
            echo json_encode(array(
                'success' => false,
                'msg' => 'E-mail não cadastrado.'
             ));
            return false;
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 9; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $dados['usu_senha'] = md5($randomString);

        $body = 'Sua nova senha é : ' . $randomString;

        if(!$this->Admbd->emailto('Recuperação de senha HCM People', 'contato@hcmsolucoes.com.br', $dados['usu_email'], $body))
        {
            echo 'Error ao enviar e-mail!';
            return false;
        }

            $this->db->where('usu_email',$dados['usu_email']);
            $this->db->update('usuarios', ['usu_senha' => $dados['usu_senha']]); 

            echo json_encode(array(
                'success' => true,
                'msg' => 'Recuperação de senha enviado.'
             ));
    }

    public function alterar_senha()
    { 
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->where('fun_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['funcionario'] = $this->db->get()->result();
            $idcliente = $dados['funcionario'][0]->fun_idcliente;
            
            $this->load->view('/geral/edit/alterar_senha',$dados);
    }

    public function envia_senha()
    {       
            $dados = [];
            $this->load->view('/geral/edit/enviar_senha',$dados);
    }

    public function alterar_senha_salva()
    { 
            if (!empty($this->input->post('for_senha'))) {$dados['fun_senha'] = $this->input->post('for_senha'); }
            if (!empty($this->input->post('for_senhaconfirma'))) {$dados['fun_senhaconfirma'] = $this->input->post('for_senhaconfirma'); }

           // print_r($dados);

            if($dados['fun_senha'] != $dados['fun_senhaconfirma']){
                echo json_encode(array(
                    'success' => false,
                    'msg' => 'As senhas não são iguais.'
                 ));

                return false;
            }

            $regS = '/^(?=.*[!@#$%&? "])/';
            if(!preg_match($regS, $dados['fun_senha'])){
                echo json_encode(array(
                    'success' => false,
                    'msg' => 'Sua senha deve conter um digito especial.'
                 ));

                return false;
            }

            $regN = '/[^0-9]/';
            if(!preg_match($regN, $dados['fun_senha'])){
                echo json_encode(array(
                    'success' => false,
                    'msg' => 'Sua senha deve conter um número.'
                 ));

                return false;
            }


            if(strlen($dados['fun_senha']) <= 10 ){
                echo json_encode(array(
                    'success' => false,
                    'msg' => 'Sua senha deve conter no mínimo de 10 caracteres.'
                 ));

                return false;
            }

                unset($dados['fun_senhaconfirma']);
                $dados['fun_senha'] = md5($dados['fun_senha']);

                
                $this->db->where('fun_idfuncionario',$this->session->userdata('id_funcionario'));
                $this->db->update('funcionario', $dados);

                $dados['usu_senha'] = $dados['fun_senha'];
                unset($dados['fun_senha']);

                $this->db->select('*');
                $this->db->from('usuarios');
                $this->db->where('usu_idfuncionario',$this->session->userdata('id_funcionario'));
                $usuario = $this->db->get()->result();

                if($usuario)
                {

                $this->db->where('usu_idfuncionario',$this->session->userdata('id_funcionario'));
                $this->db->update('usuarios', $dados);                    

                }
                //echo $this->db->last_query();

                echo json_encode(array(
                    'success' => true,
                    'msg' => 'Senha alterada com sucesso!.'
                 ));


    }

    public function pessoal_info()
    { 
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->where('fun_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['funcionario'] = $this->db->get()->result();
            $idcliente = $dados['funcionario'][0]->fun_idcliente;

            $dados['etnia'] = $this->db->get("etnia")->result();
            $dados['estadocivil'] = $this->db->get("estadocivil")->result();

            $this->db->where('escolaridade_idcliente', $idcliente );
            $dados['escolaridade'] = $this->db->get("escolaridade")->result();
            $this->load->view('/geral/edit/perfil_pessoal',$dados);        
    }
        public function pessoal_info_salva()
        {    
            if (!empty($this->input->post('for_nome'))) {$dados['fun_nome'] = $this->input->post('for_nome'); }
            if (!empty($this->input->post('for_nacio'))) {$dados['fun_nacionalidade'] = $this->input->post('for_nacio'); }
            if (!empty($this->input->post('for_natual'))) {$dados['fun_naturalidade'] = $this->input->post('for_natual'); }
            if (!empty($this->input->post('for_sexo'))) {$dados['fun_sexo'] = $this->input->post('for_sexo'); }
            if (!empty($this->input->post('for_civil'))) {$dados['fun_estadocivil'] = $this->input->post('for_civil'); }
            if (!empty($this->input->post('for_datanasc'))) {$data1 = $this->input->post('for_datanasc'); $data1 = explode("/", $data1);                                          
                       list($dia, $mes, $ano ) = $data1; $dados['fun_datanascimento'] = ($ano.'-'.$mes.'-'.$dia);}
            if (!empty($this->input->post('for_raca'))) {$dados['fun_etnia'] = $this->input->post('for_raca'); }
            if (!empty($this->input->post('for_escola'))) {$dados['fun_escolaridade'] = $this->input->post('for_escola'); }
            $this->session->set_userdata('nome', $dados['fun_nome']);
            $this->Admbd->armazenar('funcionario', $dados, $this->session->userdata('id_funcionario'), 'fun_idfuncionario');
            echo 'ok';
        }        
        public function pessoal_contato()
        { 
            $this->db->select('*');
            $this->db->from('emails');
            $this->db->where('ema_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['emails'] = $this->db->get()->result();
            
            $this->db->select('*');
            $this->db->from('redesocial');
            $this->db->where('rede_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['redesocial'] = $this->db->get()->result();
            
            $this->db->select('*');
            $this->db->from('contato');
            $this->db->where('con_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['contato'] = $this->db->get()->result();
            
            $this->load->view('/geral/edit/perfil_contato',$dados);        
	}
        public function pessoal_contato_edit()
        {
            if (!empty($this->input->post('id'))) {
                
                $id = $this->input->post('id'); 
                $this->db->select('*');
                $this->db->from('contato');
                $this->db->where('con_idcontato',$id);
                $dados['contato'] = $this->db->get()->result();
            
            $this->load->view('/geral/edit/perfil_contatoemeredit',$dados);   
            }    
        }
        public function pessoal_contato_salva()
        {
            if (!empty($this->input->post('for_nome1'))) {$dados['con_nome'] = $this->input->post('for_nome1'); }
            if (!empty($this->input->post('for_sexo1'))) {$dados['con_sexo'] = $this->input->post('for_sexo1'); }
            if (!empty($this->input->post('for_parent1'))) {$dados['con_parentesco'] = $this->input->post('for_parent1'); }
            if (!empty($this->input->post('for_ddi1'))) {$dados['con_ddi'] = $this->input->post('for_ddi1'); }
            if (!empty($this->input->post('for_ddd1'))) {$dados['con_ddd'] = $this->input->post('for_ddd1'); }
            if (!empty($this->input->post('for_numero1'))) {$dados['con_telefone'] = $this->input->post('for_numero1'); }
            if (!empty($this->input->post('for_ramal1'))) {$dados['con_ramal'] = $this->input->post('for_ramal1'); }
            if (!empty($this->input->post('for_noper1'))) {$dados['con_operadora'] = $this->input->post('for_noper1'); }
            if (!empty($this->input->post('for_id1'))) {$id = $this->input->post('for_id1'); }

            $this->Admbd->armazenar('contato', $dados, $id, 'con_idcontato');
            echo 'ok'; 
        }
        public function pessoal_contato_add()
        {
            if (!empty($this->input->post('for_nome1'))) {$dados['con_nome'] = $this->input->post('for_nome1'); }
            if (!empty($this->input->post('for_sexo1'))) {$dados['con_sexo'] = $this->input->post('for_sexo1'); }
            if (!empty($this->input->post('for_parent1'))) {$dados['con_parentesco'] = $this->input->post('for_parent1'); }
            if (!empty($this->input->post('for_ddi1'))) {$dados['con_ddi'] = $this->input->post('for_ddi1'); }
            if (!empty($this->input->post('for_ddd1'))) {$dados['con_ddd'] = $this->input->post('for_ddd1'); }
            if (!empty($this->input->post('for_numero1'))) {$dados['con_telefone'] = $this->input->post('for_numero1'); }
            if (!empty($this->input->post('for_ramal1'))) {$dados['con_ramal'] = $this->input->post('for_ramal1'); }
            if (!empty($this->input->post('for_noper1'))) {$dados['con_operadora'] = $this->input->post('for_noper1'); }
            $dados['con_idfuncionario'] = $this->session->userdata('id_funcionario');

            $this->Admbd->armazenar('contato', $dados);
            echo 'ok'; 
        }
        public function pessoal_contato_remove()
        {
           if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('contato', $id, 'con_idcontato');                
            }
       }
        public function pessoal_contatoemer()
        {             
      
            $this->load->view('/geral/edit/perfil_contatoemer');        
	}
        public function pessoal_addemail()
        { 
             if (!empty($this->input->post('for_tipo'))) {$dados['ema_tipo'] = $this->input->post('for_tipo'); }
             if (!empty($this->input->post('for_email'))) {$dados['ema_email'] = $this->input->post('for_email'); }
             $dados['ema_idfuncionario'] = $this->session->userdata('id_funcionario');
             $idvolta = $this->Admbd->armazenar('emails', $dados);
             
             echo '<tr id="email'.$idvolta.'">
                             <td>'.$dados['ema_tipo'].'</td>
                             <td>'.$dados['ema_email'].'</td>
                             <td><button type="button" class="btn btn-default btn-sm removeemail" id="'.$idvolta.'"><span class="glyph-icon glyphicon-remove"></span></button></td>
                   </tr>';
          
             
         }
        public function pessoal_addrede()
         { 
             if (!empty($this->input->post('for_tipo1'))) {$dados['rede_tipo'] = $this->input->post('for_tipo1'); }
             if (!empty($this->input->post('for_usu'))) {$dados['rede_nomeuser'] = $this->input->post('for_usu'); }
             $dados['rede_idfuncionario'] = $this->session->userdata('id_funcionario');
             $idvolta = $this->Admbd->armazenar('redesocial', $dados);
             
             echo '<tr id="email'.$idvolta.'">
                             <td>'.$dados['rede_tipo'].'</td>
                             <td>'.$dados['rede_nomeuser'].'</td>
                             <td><button type="button" class="btn btn-default btn-sm removeemail" id="'.$idvolta.'"><span class="glyph-icon icon-remove"></span></button></td>
                   </tr>';
          
             
         } 
        public function pessoal_removerede()
        { 
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('redesocial', $id, 'rede_idredesocial');                
            }
        }
        public function pessoal_removeemail()
        { 
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('emails', $id, 'ema_idemail');                
            }
        }
        
        public function pessoal_profissional()
        { 
            $iduser = $this->session->userdata('id_funcionario');  
            $this->db->where('perfil_idfuncionario',$iduser);
            $dados['perfil_profissional'] = $this->db->get('perfil_profissional')->result();
            $this->load->view('/geral/edit/perfil_resumoprofis',$dados);  
	}
        public function pessoal_profissional_edit()
        {
            if (!empty($this->input->post('resumoprof'))) {$dados['perfil_resumo'] = $this->input->post('resumoprof'); }
            $this->Admbd->armazenar('perfil_profissional', $dados, $this->session->userdata('id_funcionario'), 'perfil_idfuncionario');
            echo 'ok';
        }

        public function interesse_edit(){             
      
            $iduser = $this->session->userdata('id_funcionario');
            $this->db->where('inter_idfuncionario',$iduser);
            $dados['interessepessoal'] = $this->db->get('interessepessoal')->result();
            $this->load->view('/geral/edit/perfil_interesse_edit', $dados);

         }

         public function interesse_add(){

            if (!empty($this->input->post('inter_area'))) {$dados['inter_area'] = $this->input->post('inter_area'); }
            if (!empty($this->input->post('inter_areadetalhe'))) {$dados['inter_areadetalhe'] = $this->input->post('inter_areadetalhe'); }
            
            $dados['inter_idfuncionario'] = $this->session->userdata('id_funcionario');

            $this->Admbd->armazenar('interessepessoal', $dados);
            echo 'ok'; 
        }

        public function interesse_remove(){
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('interessepessoal', $id, 'inter_idinteressepessoal');                
            }
        }

        public function academico_edit(){     
            
            $this->load->view('/geral/edit/perfil_academico_edit');

         }

         public function academico_add(){

            if (!empty($this->input->post('curso'))) {$dados['for_graduacao_curso'] = $this->input->post('curso'); }
            if (!empty($this->input->post('inter_area'))) {$dados['for_educacao_nivel'] = $this->input->post('inter_area'); }
            if (!empty($this->input->post('universidade'))) {$dados['for_nome_facu'] = $this->input->post('universidade'); }
            if (!empty($this->input->post('area'))) {$dados['for_areaconhecimento'] = $this->input->post('area'); }

            if (  !empty($this->input->post('inicio')) && !empty($this->input->post('fim'))  ) {
            
            $data1 = $this->input->post('inicio'); 
            $data1 = explode("/", $data1);                                          
            list($dia, $mes, $ano ) = $data1;
            $dados['for_datainicio'] = ($ano.'-'.$mes.'-'.$dia);
            
            $data2 = $this->input->post('fim'); 
            $data2 = explode("/", $data2);                                          
            list($dia, $mes, $ano ) = $data2;
            $dados['for_datafim'] = ($ano.'-'.$mes.'-'.$dia); 

            }else {
                $dados['for_detalhes'] = "Cursando";
            }
            $dados['for_idfuncionario'] = $this->session->userdata('id_funcionario');

            $this->Admbd->armazenar('formacao_academica', $dados);
            echo 'ok'; 
        }

        public function academico_remove(){
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('formacao_academica', $id, 'for_idformacao');                
            }
        }
}