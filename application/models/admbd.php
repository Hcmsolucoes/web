<?php
class Admbd extends CI_Model
{
 
    public function __construct()
    {
            parent::__construct();
            $this->load-> database();
    }
    
    public function armazenar($tabela = null, $dados = null, $id = null, $nomeid = null) {		
            if ($dados) {
                    if ($id) {
                            $this->db->where($nomeid, $id);
                            if ($this->db->update($tabela, $dados)) {
                                    return true;
                            } else {
                                    return false;
                            }
                    } else {
                            if ($this->db->insert($tabela, $dados)) {
                                    return $this->db->insert_id();
                            } else {
                                    return false;
                            }
                    }
            }
    }

    public function buscar($tabela = null, $id = null, $nomeid = null){		
            if ($id) {
                $this->db->where($nomeid, $id);
            }
            $this->db->order_by($nomeid, 'desc');
            return $this->db->get($tabela);            
    }
    
    public function delete($tabela = null, $id = null, $nomeid = null){		
            if ($id) {
                return $this->db->where($nomeid, $id)->delete($tabela);
            }
    }    


    public function update($table, $data, $where)
    {
        $this->db->update($table, $data, $where); 
    }

    public function emailto($subject, $from, $to, $body){
      require './vendor/autoload.php';
      // Create the Transport
      $transport = Swift_SmtpTransport::newInstance('ssl://smtp.zoho.com', 465)
        ->setUsername('contato@hcmsolucoes.com.br')
        ->setPassword('yr135790');

      // Create the Mailer using your created Transport
      $mailer = Swift_Mailer::newInstance($transport);

      // Create a message
      $message = Swift_Message::newInstance($subject)
        ->setFrom($from)
        ->setTo($to)
        ->setBody($body)
        ;

      // Send the message
      return $mailer->send($message);
    }
}