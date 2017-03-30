<div class="message-box animated fadeIn" data-sound="alert" id="mb-exclembrete">
  <div class="mb-container">
    <div class="mb-middle">
      <div class="mb-title"><span class="fa fa-times"></span> Excluir Lembrete ?</div>
      <div class="mb-content">
        <p>Deseja excluir esse lembrete?</p>                    
        <p>Clique em Não para continuar trabalhando. Clique em Sim apagá-lo.</p>
      </div>
      <div class="mb-footer">
        <div class="pull-right">
          <a id="exclembrete" href="#" data-id="" class="btn btn-danger btn-lg mb-control-close ">Sim</a>
          <button id="nao" class="btn btn-default btn-lg mb-control-close">Não</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-title">                    
  <h2><span class="fa fa-thumbs-o-up"></span>&nbsp;Aprovações</h2>
  <!-- <div style="float: left; font-weight: bold; margin: 8px 0px 0px 10px;" id="itematual"></div> -->
  <div class="pull-right">                                                                                    
    <button class="btn btn-default"><span class="fa fa-print"></span> Imprimir </button>
  </div>
</div>

<div class="col-md-12">
             <h3><span class="fa fa-search"></span>&nbsp;&nbsp;Solicitações 
             <img id="load_sol" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </h3>
             
             <table id="tabelasolicitacoes" class="table table-striped table-hover">
              <thead>
                <tr>
                <th>Selecionar</th>
                  <th>Colaborador</th>
                  <th>Natureza</th>
                  <th>Data da solicitação</th>
                  <th>Status</th>                  
                </tr>
              </thead>
              <tbody>
                <?php foreach ($solicitacoes as $key => $value) { 
                  $datahora = date('Y-m-d H:m:s' , strtotime($value->data_hora_solicitacao) );
                  list($data, $hora) = explode(" ", $datahora);
                  $data = $this->Log->alteradata1( $data );

                  $datahora_efetiva = date('Y-m-d H:m:s' , strtotime($value->data_efetiva) );
                  list($data2, $hora2) = explode(" ", $datahora_efetiva);
                  $data2 = $this->Log->alteradata1( $data2 );
                ?>

                <tr id="<?php echo $value->solicitacao_id; ?>" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" style="cursor: pointer;">
                  <td>
                  <label class="check"><input type="radio" class="iradio icheckbox" name="iradio[<?php echo $value->solicitacao_id; ?>]"/>Aprovar</label>
                  <label class="check"><input type="radio" class="iradio icheckbox" name="iradio[<?php echo $value->solicitacao_id; ?>]"/>Reprovar</label>
                  </td>
                  <td><?php echo $value->fun_nome; ?></td>
                  <td><?php echo $value->descricao_solicitacao; ?></td>
                  <td><?php echo $data." ".$hora;  ?></td>
                  <td><?php echo $value->descricao_status_solicitacao; ?></td>
                </tr>
                <?php }  ?>
              </tbody>
            </table>


           </div>

           <script type="text/javascript">
             $('#tabelasolicitacoes').DataTable({
              "language": {
                "paginate": {
                 "next": "Avan&ccedil;ar", previous: "Voltar"
               },
               "lengthMenu": "Mostrar _MENU_ linhas por p&aacute;gina",
               "search":"Filtrar",
               "zeroRecords": "Nada encontrado",
               "info": "Exibindo _PAGE_ de _PAGES_",
               "infoEmpty": "Nenhum registro encontrado"          
             }
           });
         </script>