
<style type="text/css">
  .form-group{
    margin: 25px 0px;
  }
  .autocomplete{
    width: 100%;
    min-height: 33px;
    border: 1px solid #ccc;
    border-radius: 3px;
    float: left;
  }
  .autocomplete input, .autocomplete span{
    width: auto;
    float: left;
    border: none;
  }
</style>
<?php


?>

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
  <h2><span class="fa fa-retweet"></span> Solicitações</h2>
  <!-- <div style="float: left; font-weight: bold; margin: 8px 0px 0px 10px;" id="itematual"></div> -->
  <div class="pull-right">                                                                                    
    <button class="btn btn-default"><span class="fa fa-print"></span> Imprimir </button>
  </div>
</div>                                                                   

<div class="row">
  <div class="fleft-10">
    <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

    <!-- START CONTENT FRAME LEFT -->
    <div class="col-md-3" >
      <div class="content-frame-left">

        <div class="fleft-10" style="margin-bottom: 10px;">
          <div class="list-group border-bottom">
            <a href="#deslig" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item active aba"><span class="fa fa-times"></span> <span class="desc">Desligamento</span></a>
            <a href="#quadro" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-users"></span> <span class="desc">Aumento de Quadro</span></a>
            <a href="#altsal" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-money"></span> <span class="desc">Alteração Salarial</span></a>
            <a href="#mudcar" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-random"></span> <span class="desc">Mudança de Cargo</span></a>
            <a href="#ferias" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-plane"></span> <span class="desc">Férias</span></a>                          
            <a href="#treina" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-thumbs-o-up"></span> <span class="desc">Treinamento</span></a>
          </div>                        
        </div>

		<div class="fleft-10" style="margin-bottom: 10px;">
		  <a href="#msol" aria-controls="abacalendario" role="tab" data-toggle="tab" class="btn btn-info btn-block btn-lg"><span class="fa fa-search"></span> Consultar Minhas Solicitações </a>
        </div>
		

      </div>
    </div>
    <!-- END CONTENT FRAME LEFT -->

    <div class="col-md-9">


      <div class="tab-content">

        <!-- desligamento -->
        <div role="tabpanel" class="tab-pane active" id="deslig">
         <div class="widget widget-default">
           <div class="col-md-12">
             <h3><span class="fa fa-times"></span> Desligamento</h3>
             <form name="form_desligamento" id="form_desligamento">
             <span class="bold">Solicitante: </span><span><?php echo $funcionario[0]->fun_nome; ?></span>
             <div class="clearfix" style="margin-bottom: 20px;"></div>

             <div class="fleft-3">
             <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="colaborador" class="selectpicker" data-live-search="true">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>

           </div>

             <div class="fleft-2">
             <label for="dt_desligamento" class="control-label">Data do desligamento</label>
             <div class='input-group' >
                <input class="form-control txleft campodata" type="text" name="dt_desligamento" id="dt_desligamento" placeholder="Data do desligamento" required="">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
             </div>

             <div class="clearfix"></div>

             <div class="fleft" style="margin-top: 20px;">             
             <label for="motivo" class="control-label">Motivo do desligamento</label>
             <div class="clearfix" ></div>
               <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%"></textarea>
               <input type="submit" style="" name="salvar_desligamento" value="Salvar" class="btn btn-primary">
               <img id="load_desligamento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </div>
             <input type="hidden" name="tipo" value="1">
             </form>

           </div>
         </div>
       </div>
		<!-- fim desligamento -->

        <!-- aumento de quadro -->
        <div role="tabpanel" class="tab-pane" id="quadro">
         <div class="widget widget-default">
           <div class="col-md-12">
             <h3><span class="fa fa-users"></span> Aumento de Quadro</h3>
             <form name="form_aumento" id="form_aumento">
             <span class="bold">Solicitante: </span><span><?php echo $funcionario[0]->fun_nome; ?></span>
             <div class="clearfix" style="margin-bottom: 20px;"></div>

             <div class="fleft-3">
             <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="colaborador" class="selectpicker" data-live-search="true">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>

           </div>

             <div class="fleft-2">
             <label for="dt_desligamento" class="control-label">Data do Aumento de Quadro</label>
             <div class='input-group' >
                <input class="form-control txleft campodata" type="text" name="dt_aumento" id="dt_aumento" placeholder="Data do Aumento" required="">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
             </div>

             <div class="clearfix"></div>

             <div class="fleft" style="margin-top: 20px;">             
             <label for="motivo" class="control-label">Motivo do Aumento</label>

             <div class="clearfix" ></div>

               <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%"></textarea>
               <input type="submit" style="" name="salvar_aumento" value="Salvar" class="btn btn-primary">
               <img id="load_aumento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </div>
             <input type="hidden" name="tipo" value="2">
             </form>
           </div>
         </div>
       </div>
		<!-- fim aumento de quadro -->

        <!-- alteração salarial -->
		<div role="tabpanel" class="tab-pane" id="altsal">
			<div class="widget widget-default">
       <div class="col-md-12">
         <h3><span class="fa fa-money"></span> Alteração Salarial</h3>
         <div style="width: 30%;font-size: 20px;font-weight: bold;" class="centralizar">Disponível em breve</div>
       </div>
     </div>
        </div>
		<!-- fim alteração salarial -->		

        <!-- mudança de cargo -->
		<div role="tabpanel" class="tab-pane" id="mudcar">
			<div class="widget widget-default">
       <div class="col-md-12">
         <h3><span class="fa fa-random"></span> Mudança de Cargo</h3>
         <div style="width: 30%;font-size: 20px;font-weight: bold;" class="centralizar">Disponível em breve</div>
       </div>
     </div>
        </div>
		<!-- fim mudança de cargo -->				
		
        <!-- solicitação férias -->
        <div role="tabpanel" class="tab-pane" id="ferias">
         <div class="widget widget-default">
           <div class="col-md-12">
             <h3><span class="fa fa-plane"></span> Solicitação Férias</h3>
             <div style="width: 30%;font-size: 20px;font-weight: bold;" class="centralizar">Disponível em breve</div>
           </div>
         </div>
       </div>
		<!-- fim solicitação férias -->					

        <!-- treinamento -->
        <div role="tabpanel" class="tab-pane" id="treina">
         <div class="widget widget-default">
           <div class="col-md-12">
             <h3><span class="fa fa-thumbs-o-up"></span> Treinamento</h3>
             <div style="width: 30%;font-size: 20px;font-weight: bold;" class="centralizar">Disponível em breve</div>
           </div>
         </div>
       </div>
		<!-- fim treinamento -->				
		
    <!-- Minhas Solicitações -->
        <div role="tabpanel" class="tab-pane" id="msol">
         <div class="widget widget-default">
           <div class="col-md-12">
             <h3><span class="fa fa-search"></span> Minhas Solicitações 
             <img id="load_sol" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </h3>
             
             <table id="tabelasolicitacoes" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Colaborador</th>
                  <th>Natureza</th>
                  <th>Data da solicitação</th>
                  <th>Data para efetivar</th>
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
                <tr id="<?php echo $value->solicitacao_id; ?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" style="cursor: pointer;">
                  <td><?php echo $value->fun_nome; ?></td>
                  <td><?php echo $value->descricao_solicitacao; ?></td>
                  <td><?php echo $data." ".$hora;  ?></td>
                  <td><?php echo $data2;  ?></td>
                  <td><?php echo $value->descricao_status_solicitacao; ?></td>
                </tr>
                <?php }  ?>
              </tbody>
            </table>


           </div>
         </div>
       </div>
    <!-- Minhas Solicitações -->

      </div><!-- tab content -->

      </div><!--md 9-->

  </div><!--fleft-10 abas-->

</div><!--row-->


<script type="text/javascript">

  $(document).ready(function(){

    $("#nao").click(function(){

      $("#exclembrete").data("id", "");
      
    });

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
    
    $('.data').datepicker({
      format: 'dd/mm/yyyy'
    });

    $('.hora').timepicker({
      showMeridian: false
    });


    $("a").click(function(){

      $(".aba").removeClass("active");

      if( $(this).hasClass("list-group-item") ){        

        $(this).addClass("active");

      }
    });


    $(".list-group-item").click(function(){
      var texto = $(this).find(".desc").text();
      $("#itematual").html(" > "+texto);

    });

    $('.campodata').datepicker({
            format: 'dd/mm/yyyy'
        });

    $("#form_desligamento").on("submit", function(e){

      $("#load_desligamento").show();
      e.preventDefault();
      //return;

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."gestor/salvarDesligamento"; ?>',
        dataType : 'html',
        data: $( this ).serialize(),

        success: function(msg){
         //console.log(msg);
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){
          $("#load_desligamento").hide();
          $(".alert").addClass("alert-success");
          $(".alert").html('Solicitação feita com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500);
          $("#dt_desligamento").val("");
          $("#motivo").val("");
          $("#colaborador").val("").change();
       }

     } 
     });

    });

    $("#tabelasolicitacoes tr").click(function(){
      var id = $(this).attr("id");
      var tipo = $(this).data("tipo");
      $("#load_sol").show();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."gestor/minhaSolicitacao"; ?>',
        dataType : 'html',
        data: {
          id: id,
          tipo: tipo
        },

        success: function(msg){
         //console.log(msg);
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else {
          
          $( "#dadosedit" ).html(msg);
          $('#myModal').modal('show');
          $("#load_sol").hide();
       }

     } 
     });
    });

    $('#myModal').on('hidden.bs.modal', function (e) {

      $( "#dadosedit" ).html("");
    });

    $(document).on("click", ".acao", function(e){
      e.preventDefault();
      $("#load_acao").show();
      var id = $("#solicitacao").val();
      var campo = $(this).data("campo");
      var valor = $(this).data("valor");

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."gestor/acao_solicitacao"; ?>',
        dataType : 'html',
        data: {
          id: id,
          campo: campo,
          valor: valor
        },

        success: function(msg){
         //console.log(msg); return;
         $("#myModal").modal("hide");

         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){      
          
          $(".alert").addClass("alert-success");
          $(".alert").html('Alteração realizada com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500, function(){
            window.location.href = '<?php echo base_url("gestor/solicitacoes"); ?>';
          });          
       }
     } 
     });

    });

  });

</script>