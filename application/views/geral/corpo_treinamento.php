<style type="text/css">
  .form-group{
    margin: 25px 0px;
  }
  
</style>
<?php $iduser = $this->session->userdata('id_funcionario'); 

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
  <h2><span class="fa fa-file-text"></span> Calendário</h2><div style="float: left; font-weight: bold; margin: 8px 0px 0px 10px;" id="itematual"></div>
  
</div>                                                                                




<div class="row">
  <div class="fleft-10" style="min-height: 800px;">
    <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

    <!-- START CONTENT FRAME LEFT -->
    <div class="col-md-3" >
      <div class="content-frame-left ">


        <div class="fleft-10" style="margin-bottom: 10px;">
          <div class="list-group border-bottom">
            <a href="#abacalendario" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item active aba">
              <span class="fa fa-calendar"></span> <span class="desc">Programação de treinamento</span>
            </a>

            <a href="#addcurso" aria-controls="addcurso" role="tab" data-toggle="tab" class="list-group-item aba">
              <span class="fa fa-inbox"></span> <span class="desc">Cadastro de programação</span> <span class="badge badge-success"></span>
            </a>

            <a href="#consulta" aria-controls="consulta" role="tab" data-toggle="tab" class="list-group-item aba">
              <span class="fa fa-search"></span> <span class="desc">Consulta de programação</span> <span class="badge badge-success"></span>
            </a>

            <a href="#grafico" aria-controls="grafico" role="tab" data-toggle="tab" class="list-group-item aba">
              <span class="fa fa-search"></span> <span class="desc">Gráficos</span> <span class="badge badge-success"></span>
            </a>

          </div>                        
        </div>
      </div>
    </div>
    <!-- END CONTENT FRAME LEFT -->

    <div class="col-md-9">

<!-- 
    <ul class="nav nav-tabs" role="tablist" style="" >
      <li ><a href="#lembrete" aria-controls="lembrete" role="tab" data-toggle="tab">Meus lembretes</a></li>
      <li ><a href="#addlembrete" aria-controls="addlembrete" role="tab" data-toggle="tab">Novo lembrete</a></li>
      <li class="active"><a href="#abacalendario" aria-controls="abacalendario" role="tab" data-toggle="tab">Calendario</a></li>
      <li ><a href="#minhasmensagens" aria-controls="minhasmensagens" role="tab" data-toggle="tab">Minhas mensagens</a></li>
    </ul>
  -->
  <div class="tab-content">
    <?php //echo $sql; ?>

    <div role="tabpanel" class="tab-pane active" id="abacalendario">

      <div class="widget widget-default">
        <div class="col-md-12">
          <div class="calendar">                                
            <div id="calendario"></div>                            
          </div>
        </div>
      </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="addcurso">
     <form id="formtreinamento">
      <div class="widget widget-default">
        <div class="col-md-8 ">

          <div class="form-group">
            <label class="col-md-3 control-label font-sub">Curso</label>
            <div class="col-md-6">
             <select name="curso" id="curso" required="" style="max-width: 100%;">
               <option value="">-- Escolha o curso --</option>
               <?php foreach ($cursos as $key => $value) { ?>
               <option value="<?php echo $value->idcurso; ?>"><?php echo $value->nomecurso; ?></option>
               <?php } ?>
             </select>
           </div>
         </div>

         <div class="clearfix"></div>

         <div class="form-group">
          <label class="col-md-3 control-label font-sub">Data de inicio</label>
          <div class="col-md-4" style="margin-right: 10px;">
            <div class='input-group date' >
              <input type="text" class="data fleft" name="data_aviso" id="data_aviso" placeholder="Data" data-date-start-date="+1d" style="max-width: 90px;" required="" />          
              <span class="input-group-addon fleft">
                <span class="fa fa-calendar" id='data1'></span>
              </span>
            </div> 
          </div>

        </div>

        <div class="clearfix"></div>

        <div class="form-group">
          <label class="col-md-3 control-label font-sub">Data de término</label>
          <div class="col-md-4" style="margin-right: 10px;">
            <div class='input-group date' >
              <input type="text" class="data fleft" name="data_termino" id="data_termino" placeholder="Data" style="max-width: 90px;" disabled="" required="" />              
              <span class="input-group-addon fleft">
                <span class="fa fa-calendar" id='data2'></span>
              </span>
            </div> 
          </div>

        </div>

        <div class="clearfix"></div>

        <div class="form-group">
          <label class="col-md-3 control-label font-sub">Qtd de aulas</label>
          <div class="col-md-2">
            <input type="number" class="form-control" name="aulas" min="0" />
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group">

         <label class="col-md-3 control-label font-sub">Tipo de duração</label>
         <div class="col-md-4">
           <select class="form-control" name="tipoduracao" id="tipoduracao" required="">
             <option value="">-- Escolha o tipo --</option>
             <?php foreach ($duracao as $key => $value) { ?>
             <option value="<?php echo $value->id_duracao; ?>"><?php echo $value->duracao_descricao; ?></option>
             <?php } ?>
           </select>
         </div>

         <label class="col-md-2 control-label font-sub">Duração</label>
         <div class="col-md-2">
          <input type="number" class="form-control" name="duracao" id="duracao" min="0" />
        </div>


      </div>

      <div class="clearfix"></div>

      <div class="form-group">
        <label class="col-md-3 control-label font-sub">Carga Horária</label>
        <div class="col-md-3">
          <input type="number" class="form-control" name="cargahoraria" id="cargahoraria" min="0" />
        </div>
        <label class="fleft control-label font-sub">(Horas)</label>
      </div>

      <div class="clearfix"></div>

      <div class="form-group">
        <label class="col-md-3 control-label font-sub">Qtd de Vagas</label>
        <div class="col-md-4">
          <input type="number" class="form-control" name="vagas" id="vagas" min="1" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="form-group">
        <label class="col-md-3 control-label font-sub">Tipo de Realização</label>
        <div class="col-md-6">
         <select name="realizacao" id="realizacao" required="">
           <option value="">-- Escolha o tipo --</option>
           <?php foreach ($realizacao as $key => $value) { ?>
           <option value="<?php echo $value->id_tiporealizacao; ?>"><?php echo $value->descricaorealizacao; ?></option>
           <?php } ?>
         </select>
       </div>
     </div>

     <div class="clearfix"></div>

     <div class="form-group">
      <label class="col-md-3 control-label font-sub">Valor de custo</label>
      <div class="col-md-2">
        <input type="text" class="form-control campomoeda" name="custo" id="custo" />
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="form-group">
      <label class="col-md-3 control-label font-sub">Realizado</label>
      <div class="col-md-6">
       <select name="status" id="status" class="form-control" required="">
         <option value="0">Não</option>
         <option value="1">Sim</option>
       </select>
     </div>
   </div>

   <div class="clearfix"></div>

   <div class="form-group">
    <label class="col-md-3 control-label font-sub">Observação</label>
    <div class="col-md-6">
      <textarea class="form-control" name="obs" id="obs" style="max-width: 100%"></textarea>
    </div>
  </div>

  <div class="clearfix"></div>

  <input type="submit" value="Salvar" id="salvar" class="btn btn-info" />
  <img id="load" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
  <div id="selecionados"></div>
</form>
</div><!--md6-->
</div>
</div><!-- add curso -->

<div role="tabpanel" class="tab-pane " id="consulta">

  <div class="widget widget-default">
    <div class="col-md-12">
      <strong>Programações</strong>
      <table id="tabela" class="table table-striped table-hover table-condensed table-responsive">
        <thead>
          <tr>
            <th>Curso</th>
            <th>Data de início</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($programacoes as $key => $value) {

            $recor = ($value->calendario_status==1)?"Sim":"Não";
            $data = "Não Preenchido";
            if (!empty($value->data_inicio)) {

                $data = date('d/m/Y', strtotime($value->data_inicio));// $this->Log->alteradata1($datalembrete);

              }
              ?>
              <tr id="lembrete<?php echo $value->id_calendario; ?>" data-titulo="Alterar Programação de Curso" data-id="<?php echo $value->id_calendario; ?>" class="lembrete" >
                <td><?php echo $value->nomecurso; ?></td>
                <td><?php echo $data; ?></td>
                <td><?php echo $recor; ?></td>
                <td>
                  <span data-id="<?php echo $value->id_calendario; ?>" data-box="#mb-exclembrete" class="fa fa-times  mb-control exclemb" style="cursor: pointer;margin-right: 20px;"></span> 
                  <span data-id="<?php echo $value->id_calendario; ?>" class="fa fa-eye lembrete" style="cursor: pointer;"></span>
                </td>
              </tr>
              <?php } ?>
            </tbody>

          </table>
        </div>
      </div>

  </div><!--aba consultA-->

  <div role="tabpanel" class="tab-pane active" id="grafico">

    <div class="widget widget-default">
      <div class="col-md-12">

      <div id="grfprog"></div>

      </div>
    </div>

  </div>

</div><!--tab content -->
</div><!--fleft-7 abas-->


</div>
</div>


<script type='text/javascript' src='<?php echo base_url('js/plugins/icheck/icheck.min.js') ?>'></script>        
<script type='text/javascript' src='<?php echo base_url('js/plugins/fullcalendar/fullcalendar.min.js') ?>'></script>
<script type='text/javascript' src='<?php echo base_url('js/plugins/fullcalendar/lang/pt-br.js') ?>'></script>               
<script type="text/javascript">

  $(document).ready(function(){

    $(".campomoeda").maskMoney({thousands:'.',decimal:','});

    $(document).on("click", ".excmsg", function(){

      var id = $(this).attr("id");
      $("#it"+id).slideUp("slow");

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."ajax/excluirmensagens"; ?>',
        dataType : 'json',
        data: {
          id: id
        },           
        success: function(msg){
            //console.log(msg);
            if(msg.status === 'erro'){

              $(".alert").addClass("alert-danger")
              .html("Houve um erro. Contate o suporte.")
              .slideDown("slow");
              $(".alert").delay( 3500 ).hide(500);

            }else {

              $("#it"+id).slideUp("fast");

            }

          } 
        });
    });

    
    $(".lembrete").click(function(){
      var id = $(this).data("id");
      var titulo = $(this).data("titulo");
      $("#titulomodal").text(titulo);
      $( "#dadosedit" ).html("");
      $('#myModal').modal('show');

      $.ajax({             
        type: "POST",
        url: '<?php echo base_url('gestor/modalprogramacao') ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          id: id
        },              
        success: function(msg) 
        {    

          $( "#dadosedit" ).html(msg);

        } 
      });

    });

    $("#vermais").click(function(){

      var fim = parseInt( $(this).data("fim") ) ;
      $("#msgload").show();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."ajax/maismensagens"; ?>',
        dataType : 'json',
        data: {
          fim: fim
        },           
        success: function(msg){
          //console.log(msg.mensagens);
          if(msg.status === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#vermais").data("fim", msg.fim);
            $("#vermais").before(msg.mensagens);

          }

        } 
      })
      .done(function( data ) {
        $("#msgload").hide();
      }); 

    });

    $('#calendario').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      weekNumbers: true,
      navLinks: true,
      events: '<?php echo base_url("gestor/ajaxcalendario"); ?>',
      selectable: true,
      eventRender: function (event, element) {
        element.popover({
          html: true,
          title: event.name,
          placement: 'top',
          trigger: 'hover',
          content: event.description
        });
      }
    });

    $('#tabela').DataTable({
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


    $(".autocomplete").click(function(){
      $(this).find("input[type=text]").focus();
    });

    $(".icheckbox,.iradio").iCheck({
      checkboxClass: 'icheckbox_minimal-grey',
      radioClass: 'iradio_minimal-grey'

    });

    $('.data').datepicker({
      format: 'dd/mm/yyyy'
    });

    $('.hora').timepicker({
      showMeridian: false
    });

    $(".autocompletar").keyup(function(){

      var busca = $.trim( $(this).val() );
      var campo = $(this).data("campo");
      var div = $(this).data("div");
      var classe = $(this).data("classe");
      if(busca !=""){

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url()."ajax/autocompleteLembrete"; ?>',
          dataType : 'html',
          data: {
            busca: busca,
            classe: classe,
            campo: campo
          },           
          success: function(msg){
          //console.log(msg);
          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#"+div).html(msg);

          }

        } 
      }); 
      }else{
        $("#div_dep, #div_colab").html("");
      }//if busca
    });

    $(document).on("click",".exc", function(){
      var id = $(this).attr("rm");

      $("#dep"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#depart"+id).remove();
      });
      

      $("#colabor"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#colabs"+id).remove();
      });


    });

    //click no item do autocompletar departamento
    $(document).on("click",".itemdep", function(){
      var nome = $(this).data("nome");
      var id = $(this).attr("id");    

      $("#busca_dep").val("");

      $("#busca_dep").before("<div class='btn btn-default fleft' id='dep"+id+"'>"+nome+" <i rm='"+id+"' class='fa fa-times exc'> </i></div>");
      $("<input type='hidden' name='depts[]' id='depart"+id+"' value='"+id+"' >").appendTo("#selecionados");

      $("#div_dep").html(""); 

    });

    //click no item do autocompletar colaborador
    $(document).on("click",".itemcolab", function(){
      var nome = $(this).data("nome");
      var id = $(this).attr("id");    

      $("#busca_colab").val("");

      $("#busca_colab").before("<div class='btn btn-default fleft' id='colabor"+id+"'>"+nome+" <i rm='"+id+"' class='fa fa-times exc'> </i></div>");
      $("<input type='hidden' name='colabs[]' id='colabs"+id+"' value='"+id+"' >").appendTo("#selecionados");

      $("#div_colab").html(""); 

    });

    $(document).on("click",".itemcolabmsg", function(){
      var nome = $(this).data("nome");
      var id = $(this).attr("id");    

      $("#msgcolab").val("");

      $("#msgcolab").before("<div class='btn btn-default fleft' id='colabor"+id+"'>"+nome+" <i rm='"+id+"' class='fa fa-times exc'> </i></div>");
      $("<input type='hidden' name='colabs[]' id='colabs"+id+"' value='"+id+"' >").appendTo("#msgselecionados");

      $("#div_colabmsg").html(""); 

    });

    $("#formtreinamento").on("submit", function(e){

      $("#load").show();
      $("#salvar").prop("disabled", true);
      e.preventDefault();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("ajax/salvarTreinamento"); ?>',
        dataType : 'html',
        data: $( this ).serialize(),

        success: function(msg){

         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){

         window.location.href = '<?php echo base_url("gestor/calendario"); ?>';

       }

     } 
   });

    });

    $("#formmensagem").on("submit", function(e){

      $("#loadmsg").show();
      e.preventDefault();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."ajax/salvarMensagem"; ?>',
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

         window.location.href = '<?php echo base_url()."perfil/lembretes"; ?>';

       }

     } 
   });

    });

    $("a").click(function(){

      $(".aba").removeClass("active");

      if( $(this).hasClass("list-group-item") ){        

        $(this).addClass("active");

      }
    });

    $(".del").click(function(){

      var id = $(this).attr("id");
        //$("#it"+id).slideUp("slow");

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url()."ajax/excluirmensagens"; ?>',
          dataType : 'json',
          data: {
            id: id,
            acao: "del"
          },           
          success: function(msg){
            console.log(msg);
            if(msg.status === 'erro'){

              $(".alert").addClass("alert-danger")
              .html("Houve um erro. Contate o suporte.")
              .slideDown("slow");
              $(".alert").delay( 3500 ).hide(500);

            }else {

              $("#it"+id).slideUp("fast");

            }

          } 
        });
      });

    $(".list-group-item, #addlem, #addm").click(function(){
      var texto = $(this).find(".desc").text();
      $("#itematual").html(" > "+texto);
      
    });

    $("#tipoduracao").change(function(){

      if ($("#tipoduracao :selected").text()=="Horas") {

        $("#duracao").val("").prop("disabled", true);
      }else{
        $("#duracao").prop("disabled", false);
      }
    });


    $("#data_aviso").blur(function(){
      if( $(this).val().length == 10){
        var data = $(this).val();
        $("#data_termino").prop("disabled", false);
        $('#data_termino').datepicker('setStartDate', data);
      }
    });


  });

Morris.Bar({
        element: 'grfprog',
        data: [
            { y: 'Out', a: 10, b: 13, c: 8 },
            { y: 'Set', a: 7,  b: 09, c: 5 },
            { y: 'Ago', a: 15, b: 20, c: 3 },
            { y: 'Jul', a: 05, b: 12, c: 1 }
        ],
        xkey: 'y',
        ykeys: ['a','b','c'],
        labels: ['Faltas', 'Atrasos','Atestados'],
        barColors: ['#33414E', '#1caf9a','#FF8C00'],
        gridTextSize: '10px',
        hideHover: true,
        resize: true,
        gridLineColor: '#E5E5E5'
    });

</script>

