

<link href="<?php echo base_url('assets/ratings/dist/star-rating.css') ?>" rel="stylesheet">
<style type="text/css">
  #perg, #aprfeed, #oculto{
    position: absolute; 
    top: 45px; 
    width: 98%;
  }
  .panel{
    padding: 20px;
  }
  
</style>

<div class="page-title">                    
  <h2><span class="fa fa-comments-o"></span> Feedbacks</h2>
</div>

<div class="row ">

  <div class="col-md-12">

    <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

    <ul class="nav nav-tabs" role="tablist" style="padding: 0px;" >

      <li class="active"><a href="#meufeed" aria-controls="meufeed" role="tab" data-toggle="tab">Meus feedbacks</a></li>
      <?php if(is_object($parametros)){ ?>
      <?php if( ($parametros->Param_feed!=0) || ( ($parametros->Param_feed==0) && ($perfil==2||$perfil==4) )  ){  ?>
      <li ><a href="#enviarfeed" aria-controls="enviarfeed" role="tab" data-toggle="tab">Enviar feedback</a></li>
      <?php } 
      } ?>
      <li ><a href="#aprfeed" aria-controls="aprfeed" role="tab" data-toggle="tab">Aguardando aprovação</a></li>
      <li ><a href="#oculto" aria-controls="oculto" role="tab" data-toggle="tab">Ocultos</a></li>
      <?php if( $perfil==7 ){  ?>
      <li ><a href="#perg" aria-controls="perg" role="tab" data-toggle="tab">Incluir Perguntas</a></li>
      <?php } ?>

    </ul>

    <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="meufeed">
        <div class="row" >
         <div class="panel panel-default" >       
          <!-- START TIMELINE -->
          <div class="timeline">                                
            <!-- START TIMELINE ITEM -->
            <?php 

            $i = 0;

            foreach ($feedbacks as $value) {

              $lado = ( ($i % 2)==0)? "" : "timeline-item-right" ;
              $i++;
              $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
              $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
              ?>
              <div class="timeline-item <?php echo $lado; ?>">
                <div class="timeline-item-info"><?php echo $this->Log->alteradata1($value->feed_data)?></div>
                <div class="timeline-item-icon"><span class="fa fa-comments-o"></span></div>
                <div class="timeline-item-content">

                  <div class="timeline-body">
                   <img src="<?php echo $foto ?>" class="imgcirculo_m " align="left" style="margin: 0px 10px 0px 0px;" />
                   <span class="font_sub bold"><?php echo $value->fun_nome ?></span>
                   <p><?php echo $value->feed_depoimento ?></p>
                   <div class="fleft">
                     <?php foreach ($competencias[$value->feed_idfeedback] as $k => $v) { ?>

                          <?php if (!empty($v->rating_competencia)) { ?>
                          <img src="<?php echo base_url("assets/img")."/".$v->rating_competencia."star.png"; ?>" style="max-width: 60px;" />
                          <?php } ?>
                          <span><?php echo $v->desc_competencia; ?></span>
                          <div class="clearfix"></div>
                    <?php } ?>
                   </div>
                   <div class="fright">
                    <input type="checkbox" class="icheckbox" value="<?php echo $value->feed_idfeedback ?>" /> Não exibir
                  </div>                          
                </div>                                     
              </div>
            </div><!-- END TIMELINE ITEM -->
            <?php } ?>
            <!-- START TIMELINE ITEM -->
            <div class="timeline-item timeline-main">
              <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
            </div><!-- END TIMELINE ITEM -->
          </div><!-- END TIMELINE -->
        </div>
      </div><!-- Feeds-->

    </div><?php if(is_object($parametros)){ 
    if( ($parametros->Param_feed!=0) || ( ($parametros->Param_feed==0) && ($perfil==2||$perfil==4) )  ){  ?>
    <div role="tabpanel" class="tab-pane" id="enviarfeed" style="display: block;" >
      <div class="row" >
        <div class="widget widget-default" id="selecionados">
          <div class="panel-body">
            <p>Use a pesquisa para localizar pessoas na sua empresa</p>
            <form class="form-horizontal" id="formbusca">
              <div class="form-group">

                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="fa fa-search" id="lupa"></span>
                  </div>
                  <input type="text" id="busca" name="busca" class="form-control cinza" placeholder="Marque um colega de trabalho"  />

                </div><div id="res_busca"></div>
              </div>
            </form>                                    
          </div>         
        </div>
      </div>
      

      <div class="row">
        <div class="widget widget-default">
          <form id="formulario">

         <!-- <select id="pergunta" class="pergunta fleft" required="">
            <option value="">Escolha uma competência</option>
            <?php foreach ($perguntas as $key => $value) { ?>
            <option value="<?php echo $value->id_pergunta; ?>"><?php echo $value->desc_pergunta; ?></option>
            <?php } ?>
          </select>-->

          <?php if($perfil==2||$perfil==4){ ?>
          <div class="col-md-5" >
            <input type="text" name="competencia[]" class="fleft" style="width: 45%;" placeholder="Competência envolvida" required="">
            <select id="rating" class="rating fleft" name='ratings[]' >
              <option value="">selecione</option>
              <option value="1">Insuficiente</option>
              <option value="2">Regular</option>
              <option value="3">Bom</option>
              <option value="4">Muito Bom</option>
              <option value="5">Destaque</option>
            </select>
            <div class="clearfix br"></div>

            <span id="addcomp" class="btn btn-info" style="margin: 10px 0px;">Nova competência</span>
            <div class="clearfix"></div>

            <div class="fleft" style="margin: 20px 0px 0px 0px;">
              <input type="submit" class="btn btn-primary" id="envfeed" value="Enviar" />
            </div>
          </div><!--lado esquerdo -->

          <div class="col-md-5" style="border-left: 1px solid #ccc;">
           <div class="form-group">           
            <div class="col-md-10">
              <div class="form-group">
                <label>Mensagem do feedback</label>
                <textarea id="summernote" class="form-control " rows="3" name="mensagem" required=""></textarea>
              </div>
            </div>
          </div>          
        </div><!--lado direito-->
        <?php }else{ ?>
        <div class="col-md-5" >
          <input type="text" name="competencia[]" class="fleft" style="width: 45%;" placeholder="Competência envolvida" required="">

          <div class="clearfix"></div>

          <div class="form-group" style="margin: 10px 0px 0px 0px">           
            <div class="form-group">
              <textarea id="summernote" class="form-control " rows="3" name="mensagem" placeholder="Mensagem do feedback" required=""></textarea>
            </div>
          </div>  
        </div>

        <div class="clearfix"></div>

        <div class="fleft" style="margin: 20px 0px 0px 0px;">
          <input type="submit" class="btn btn-primary" id="envfeed" value="Enviar" />
        </div>
        <?php } ?>

        <img id="load" style="display: none;position: absolute;left: 20%;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">


      </div> </form>       
    </div>
  </div><?php } } ?><!-- envio-->

  <div role="tabpanel" class="tab-pane" id="aprfeed">
    <div class="row" >
      <div class="panel panel-default" style="padding: 20px 0px 0px 0px;">

        <div class="messages messages-img">
          <?php foreach ($aprovacao as $key => $value) { 
            $avatar = ( strcasecmp($value->fun_sexo, "masculino")==0 )?"avatar1":"avatar2";
              $foto = ($value->fun_foto=="")? "http://hcmsolucoes.com.br/people/img/".$avatar.".jpg" : $value->fun_foto;
            ?>
          <div class="item ">
            <div class="image">
              <img src="<?php echo $foto ?>" class="imgcirculo fleft" >
            </div>
            <div class="text">
              <div class="heading">
                <a href="#"><?php echo $value->fun_nome ?></a>
                <span class="date"><?php echo $this->Log->alteradata1($value->feed_data)?></span>
              </div>
              <span><?php echo $value->feed_depoimento ?></span>
              <br>
              <span class="btn btn-default st" id="<?php echo $value->feed_idfeedback ?>" data-st="1" /> Aprovar</span>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <span class="btn btn-danger st" id="<?php echo $value->feed_idfeedback ?>" data-st="3" /> Reprovar</span>

            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div><!-- aprovação-->

  <div role="tabpanel" class="tab-pane" id="oculto">
    <div class="row" >
      <div class="panel panel-default" style="padding: 20px 0px 0px 0px;">
        <div class="messages messages-img">
          <?php foreach ($ocultos as $key => $value) { 
          $avatar = ( strcasecmp($value->fun_sexo, "masculino")==0 )?"avatar1":"avatar2";
              $foto = ($value->fun_foto=="")? "http://hcmsolucoes.com.br/people/img/".$avatar.".jpg" : $value->fun_foto;
           ?>
          <div class="item ">
            <div class="image">
              <img src="<?php echo $value->fun_foto ?>" class="imgcirculo borda fleft" >
            </div>
            <div class="text">
              <div class="heading">
                <a href="#"><?php echo $value->fun_nome ?></a>
                <span class="date"><?php echo $this->Log->alteradata1($value->feed_data)?></span>
              </div>
              <span><?php echo $value->feed_depoimento ?></span>
              <br>
              <span class="btn btn-default st" id="<?php echo $value->feed_idfeedback ?>" data-st="1" /> Exibir na linha do tempo</span>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>      
  </div><!-- ocultos-->
  <?php if( $perfil==7 ){  ?>
  <div role="tabpanel" class="tab-pane" id="perg">
    <div class="row " >
      <div class="panel panel-default" >
        <div class="col-md-5">
          <div class="input-group">
            <label>Incluir uma nova pergunta</label>
            <input id="desc" type="text" class="form-control" placeholder="Pergunta para o feedback" aria-describedby="basic-addon2">
            <span class="input-group-btn">
              <button id="salvar" class="btn btn-primary" type="button">Salvar</button>
            </span>
          </div>
        </div>
        <div class="separador"></div>

        <div class="col-md-5">
          <div class="fleft">
            <label>Perguntas cadastradas</label><br>
            <select class="fleft" >
              <option>--Selecione--</option>
            </select>
            <!--<span class="fleft">
              <button class="btn btn-primary" type="button">Desativar</button>
            </span>-->
          </div>
        </div>
      </div>
    </div>
  </div><?php } ?><!-- perguntas-->


</div>


</div>
</div>
<script src="<?php echo base_url('assets/ratings/demo/js/jquery.slim.min') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/ratings/demo/js/scale.fix.js') ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('assets/ratings/dist/star-rating.js') ?>" ></script>


<script type="text/javascript">


  $( '.rating' ).starrating({
    clickFn: function( selected ) {
      console.log( 'eu cliquei ' + selected +" estrelinhas");
      $("#pergunta").val(selected).change();
    },
    initialText: "",
  });
  
  $('.icheckbox').on('ifToggled', function(event){

    var idfeed = $(this).val();

    if($(this).is(":checked")){
      var oculto = 2;
    }else{
      var oculto = 1;
    }
    
    $.ajax({          
      type: "POST",
      url: '<?php echo base_url()."ajax/atualizarFeed";?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        idfeed: idfeed,
        status: oculto
      },              
      success: function(msg){
        console.log(msg);
        if(msg === 'erro'){
          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);
        }else{

        }

      } 
    });

  });

  $('.st').on('click', function(event){

    var idfeed = $(this).attr("id");
    var st = $(this).data("st");
    $(this).attr("disabled", true);

    $.ajax({          
      type: "POST",
      url: '<?php echo base_url()."ajax/atualizarFeed";?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        idfeed: idfeed,
        status: st
      },              
      success: function(msg){
        console.log(msg);
        if(msg === 'erro'){
          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");

        }else if(msg==1){

          $(".alert").addClass("alert-success")
          .html("Feedback alterado com sucesso")
          .slideDown("slow");

        }
        $(".alert").delay( 3500 ).hide(500);

      } 
    });

  });

  $("#salvar").click(function(){

    var desc = $("#desc").val();

    $.ajax({          
      type: "POST",
      url: '<?php echo base_url()."ajax/salvarPergunta";?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        desc: desc,
        operacao: 1
      },              
      success: function(msg){

        if(msg === 'erro'){
          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");

        }else if(msg>0){

          $(".alert").addClass("alert-success")
          .html("Pergunta cadastrada com sucesso")
          .slideDown("slow");

        }
        $(".alert").delay( 3500 ).hide(500, function(){
         window.location.reload();
       });
      } 
    }); 
  });

  $("#busca").keyup(function(){

    var busca = $.trim( $(this).val() );

    if(busca !=""){

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."ajax/buscaPessoa"; ?>',
        dataType : 'html',
        data: {
          busca: busca
        },           
        success: function(msg){
         
          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#res_busca").html(msg);

          }

        } 
      }); 
    }else{
      $("#res_busca").html("");
      }//if busca
    });

  $(document).on("click",".exc", function(){
    var id = $(this).attr("rm");
    $("#foto"+id).fadeOut("slow");
    $("#colab"+id).remove();
  });

  $("#formulario").submit(function(e){
    e.preventDefault();
    
    if( $("[name='colabs[]']").length == 0 ){
      $(".alert").addClass("alert-danger")
      .html("Você precisa marcar colegas de trabalho")
      .slideDown("slow");
      $(".alert").delay( 3500 ).hide(500);
      return false;
    }

    $("#load").show();
    var competencias = $("[name='competencia[]']").map(function(){
      return $(this).val();
    }).get();
    var colaboradores = $("[name='colabs[]']").map(function(){
      return $(this).val();
    }).get();
    var ratings = $("[name='ratings[]']").map(function(){
      return $(this).val();
    }).get();
    var mensagem = $("#summernote").val();
    

    $.ajax({          
      type: "POST",
      url: '<?php echo base_url()."ajax/enviarFeedback";?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        competencia: competencias,
        ratings: ratings,
        colaboradores: colaboradores,
        mensagem: mensagem
      },              
      success: function(msg){
        console.log(msg);
        if(msg === 'erro'){
          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");

        }else if(msg>0){

         $("[name='competencia[]'], #summernote").val("");
         $(".alert").removeClass("alert-danger")
         .addClass("alert-success")
         .html("Feedback enviado com sucesso")
         .slideDown("slow");

       }
       $(".alert").delay( 3500 ).hide(500, function(){
         window.location.reload();
       });
       $("#load").hide();
     } 
   });

  });

  $("#addcomp").click(function(){
    var n = $('.rating').length + 1;
    var novo = "<input type='text' name='competencia[]' class='fleft' style='width: 45%;' placeholder='Competência envolvida'>"+
    "<select id='rating"+n+"' class='rating fleft' name='ratings[]' >"+
    "<option value=''>selecione</option>"+
    "<option value='1'>Insuficiente</option>"+
    "<option value='2'>Regular</option>"+
    "<option value='3'>Bom</option>"+
    "<option value='4'>Muito Bom</option>"+
    "<option value='5'>Destaque</option>"+
    "</select>"+
    "<div class='clearfix br'></div>";
    $(".br:last").after(novo);
    $( '#rating'+n ).starrating({
      clickFn: function( selected ) {
        console.log( 'rating '+n+', cliquei ' + selected +" estrelinhas");
        $('#rating'+n).val(selected).change();
      },
      initialText: "", 
    });

  });


</script>