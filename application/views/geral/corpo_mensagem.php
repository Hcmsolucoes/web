<?php 
$iduser = $this->session->userdata('id_funcionario'); 

$msgexc=0;
foreach ($msg_excluidas as $key => $value) { 

  if ( ($value->fk_remetente_mensagem==$iduser && $value->ic_vizualizado==2) || 
    ($value->fk_destinatario_mensagem==$iduser && $value->ic_vizualizado==3) ) {
    $msgexc++;
  }
}

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
                    <a id="exclembrete" href="#" data-id="" class="btn btn-info btn-lg mb-control-close ">Sim</a>
                    <button id="nao" class="btn btn-default btn-lg mb-control-close">Não</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-title">                    
<h2><span class="fa fa-file-text"></span> Mensagens</h2><div style="float: left; font-weight: bold; margin: 8px 0px 0px 10px;" id="itematual"></div>
  
</div>                                                                                




<div class="row">
  <div class="fleft-10">
    <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

<div class="col-md-3" >

<div class="fleft-10" style="margin-bottom: 10px;"> 
    <a href="#addmsg" id="btnaddmsg" aria-controls="addmsg" role="tab" data-toggle="tab" class="btn btn-danger btn-block btn-lg">
    <span class="fa fa-edit"></span> <span class="desc">Nova Mensagem</span> 
    </a>
  </div>

  
<div class="content-frame-left ">
 
  <div class="fleft-10" style="margin-bottom: 10px;">

  
    <div class="list-group border-bottom">
  
      <a href="#enviadas" aria-controls="minhasmensagens" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-share"></span> <span class="desc">Mensagens Enviadas</span><span class="badge badge-warning"><?php echo count($msg_enviadas) ; ?></span></a>

      <a href="#minhasmensagens" aria-controls="minhasmensagens" role="tab" data-toggle="tab" class="list-group-item aba">
        <span class="fa fa-star"></span> <span class="desc">Mensagens Recebidas</span><span class="badge badge-warning"><?php echo count($msg_recebidas); ?></span>
      </a>
     
      <a href="#excluidas" aria-controls="excluidas" role="tab" data-toggle="tab"  class="list-group-item aba"><span class="fa fa-trash-o"></span> <span class="desc">Mensagens Excluídas</span> <span class="badge badge-default"><?php echo $msgexc; ?></span>
      </a>

    </div>                        
  </div>
</div>
</div>

<div class="col-md-9">

    <div class="tab-content">

    <div role="tabpanel" class="tab-pane" id="addmsg">

        <div class="widget widget-default">
          <div class="col-md-12">

              <span class="btn btn-default" id="selpessoas">Selecionar pessoas</span>
              <div class="clearfix"></div>
              <div class="fleft-4" style="margin: 10px 0px 0px 0px;">
              <textarea name="mensagem" id="mensagem" style="width: 100%;"></textarea>
              <span class="btn btn-info fright" id="enviar" >Enviar</span>
              </div>
          </div>
          </div>

          </div>


<div role="tabpanel" class="tab-pane" id="enviadas">

        <div class="widget widget-default">

          <h2>Mensagens enviadas</h2>
          <div class="col-md-12">
            <div class="messages messages-img">
              <?php 
              
              $primsg = "";
              foreach ($msg_enviadas as $key => $value) { 
                $in = ($value->fk_remetente_mensagem==$iduser)? "in" : "" ;
                list($data, $hora) = explode(" ", $value->datahora_mensagem);
                $data = $this->Log->alteradata1( $data );
                $primsg = $value->id_mensagem;
                
                ?>
            <div class="item <?php //echo $in; ?>" id="it<?php echo $value->id_mensagem; ?>">
              <div class="image">
                <img src="<?php echo $funcionario[0]->fun_foto; ?>">
              </div>
                           
              <div class="text">
              
                <div class="heading">
                  <a href="#">Para: <?php echo $value->fun_nome; ?></a>
                  
                  <span class="date"><?php echo $data." ".substr($hora, 0, 5); ?></span>

                  <div class="clearfix"></div>

                  <span class="btn btn-default fright excmsg" id="<?php echo $value->id_mensagem; ?>"> Excluir 
                    <span class="fa fa-times " ></span>
                  </span>

                </div>
                <span><?php echo $value->texto_mensagem; ?></span>
              </div>
            </div>
            <?php } 
            $this->session->set_userdata('primsg', $primsg);
            ?>
            <span class="label label-default" id="vermais" data-fim="<?php echo $primsg; ?>" style="cursor: pointer;">Ver mais...</span>
            <img id="msgload" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
      
            </div>
          </div>
        </div>
      </div><!-- tab enviadas-->

       <div role="tabpanel" class="tab-pane" id="minhasmensagens">

        <div class="widget widget-default">
        <h2>Mensagens recebidas</h2>
          <div class="col-md-12">
            <div class="messages messages-img">
              <?php 
              
              $primsg = "";
              foreach ($msg_recebidas as $key => $value) { 
                $in = ($value->fk_remetente_mensagem==$iduser)? "in" : "" ;
                list($data, $hora) = explode(" ", $value->datahora_mensagem);
                $data = $this->Log->alteradata1( $data );
                $primsg = $value->id_mensagem;
                
                ?>
            <div class="item <?php echo $in; ?>" id="it<?php echo $value->id_mensagem; ?>">
              <div class="image">
                <img src="<?php echo $value->fun_foto; ?>">
              </div>
                           
              <div class="text">
              
                <div class="heading">
                  <a href="#"><?php echo $value->fun_nome; ?></a>

                  <span class="date"><?php echo $data." ".substr($hora, 0, 5); ?></span>

                  <div class="clearfix"></div>

                  <span class="btn btn-default excmsg fright" id="<?php echo $value->id_mensagem; ?>" >
                    Excluir <span class="fa fa-times" ></span>
                  </span>

                </div>
                <span><?php echo $value->texto_mensagem; ?></span>
              </div>
            </div>
            <?php }
            $this->session->set_userdata('primsg', $primsg);
             ?>
            <span class="label label-default" id="vermais" data-fim="<?php echo $primsg; ?>" style="cursor: pointer;">Ver mais...</span>
            <img id="msgload" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
      
            </div>
          </div>
        </div>
      </div><!--tab recebidas-->


      <div role="tabpanel" class="tab-pane" id="excluidas">

        <div class="widget widget-default">
        <h2>Mensagens excluidas</h2>
          <div class="col-md-12">
            <div class="messages messages-img">
              <?php 
              
              $primsg = "";
                            
              foreach ($msg_excluidas as $key => $value) {

                if ( ($value->fk_remetente_mensagem==$iduser && $value->ic_vizualizado==2) || 
                  ($value->fk_destinatario_mensagem==$iduser && $value->ic_vizualizado==3) ) {

                $in = ($value->fk_remetente_mensagem==$iduser)? "in" : "" ;
                //echo $value->datahora_mensagem;
                //list($data, $hora) = explode(" ", $value->datahora_mensagem);
                $data = date('d/m/Y', strtotime($value->datahora_mensagem)); //$this->Log->alteradata1( $data );
                $primsg = $value->id_mensagem;
                
                ?>
            <div class="item <?php //echo $in; ?>" id="it<?php echo $value->id_mensagem; ?>">
              <div class="image">
                <img src="<?php echo $value->fun_foto; ?>">
              </div>
                           
              <div class="text">
              
                <div class="heading">
                  <a href="#"><?php 
                  //$env = ($value->fk_remetente_mensagem==$iduser)? "De:" : "Para:";
                  echo "Para " .$value->fun_nome; ?></a>
                  <span class="date"><?php echo $data." ".substr($value->datahora_mensagem, 12, 5); ?></span>

                  <div class="clearfix"></div>

                  <span class="btn btn-default del fright"  id="<?php echo $value->id_mensagem; ?>">Excluir 
                  <span class="fa fa-times "></span>
                  </span>

                </div>
                
                

                <span><?php echo $value->texto_mensagem; ?></span>
              </div>
            </div>
            <?php } }
            $this->session->set_userdata('primsg', $primsg);
            ?>
            <span class="label label-default" id="vermais" data-fim="<?php echo $primsg; ?>" style="cursor: pointer;">Ver mais...</span>
            <img id="msgload" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
      
            </div>
          </div>
        </div>
      </div><!-- tab excluidas-->



</div> 

</div>
</div>
<input type="hidden" value="0" id="abrir" name="">
</div>

<script type="text/javascript">
  $("#selpessoas").click(function(){

    $('#myModal').modal("show");

    if ($("#abrir").val()==0) {
      $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' >");

      $.ajax({
        type: "POST",
        url: '<?php echo base_url("perfil/buscaColabEmpresa");?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          
        },                  
        success: function(msg){

          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else{

            $("#titulomodal").text("Selecionar Funcionários");
            $("#dadosedit").html(msg);
            $("#abrir").val(1);
          }

        } 
      });
    }//fim do if


   });

  $("#enviar").click(function(){

    var colabs = [];
    var mensagem = $("#mensagem").val();
    var i=0;
    $("input[name='colabs[]']").each(function(index){
      
      if ( $(this).is(":checked") ) {

        colabs[i] = $(this).val();
         i++;
      }

    });    

    $.ajax({
        type: "POST",
        url: '<?php echo base_url("ajax/salvarMensagem");?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          colabs: colabs,
          mensagem: mensagem
        },                  
        success: function(msg){

          //console.log(msg); return;

          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else{

            $(".alert").addClass("alert-success")
            .html("Mensagem enviado com sucesso")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);
          
          }

        } 
      });
  });

  $(document).on("click", ".excmsg", function(){

        var id = $(this).attr("id");
        $("#it"+id).slideUp("slow");

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url("ajax/excluirmensagens"); ?>',
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

  $(".del").click(function(){

      var id = $(this).attr("id");

      $.ajax({          
          type: "POST",
          url: '<?php echo base_url("ajax/excluirmensagens"); ?>',
          dataType : 'json',
          data: {
            id: id,
            acao: "del"
          },           
          success: function(msg){
           
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

</script>