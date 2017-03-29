 <?php


foreach ($escolaridade as $key => $value) {  

  if (!isset($arr[$value->escolaridade_descricao])) {

    $arr[$value->escolaridade_descricao]["qtd"]=1;

  }else{

    $arr[$value->escolaridade_descricao]["qtd"]++;

  }
  $arr[$value->escolaridade_descricao]["ids"][]=$value->fun_idfuncionario;

}
$esc = "";
foreach ($arr as $key => $value) {

  $ids="";
  foreach ($value['ids'] as $k => $v) {
   $ids .= $v.",";
  } 

 $esc .= "{label: '".$key."', value: ".$value["qtd"].", ids: '".rtrim($ids,",")."' },";

}


$arr_situacao = array();
foreach ($situacao as $key => $value) {  

  if (!isset($arr_situacao[$value->contr_situacao])) {

    $arr_situacao[$value->contr_situacao]["qtd"]=1;

  }else{

    $arr_situacao[$value->contr_situacao]["qtd"]++;

  }
  $arr_situacao[$value->contr_situacao]["ids"][]=$value->fun_idfuncionario;

}




 ?>

 <div id="vencimentosmodal" class="modal fade" tabindex="-1" role="document" >
   <div class="modal-dialog">
    <div class="modal-content" style="max-height:595px; overflow:scroll;">
        <div class="modal-header" style="text-align: center;">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="">Contratos a vencer em at� 90 dias</h4>
    </div>
     <div class="modal-body" id="">
        <div class="panel-body list-group list-group-contacts">
      <?php foreach ($vencimentos as $key => $value) { 
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
        ?>

      <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$value->fun_idfuncionario); ?>" class="list-group-item">
    
        <img src="<?php echo $foto; ?>" class="imgcirculo_m pull-left fleft" style="width: auto;" />
        <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
        <p><b>Vencimento: </b><?php echo $this->Log->alteradata1($value->vnccontr); ?></p>
        <p><b>Cargo: </b><?php echo $value->fun_cargo; ?></p>
        <p><b>Departamento: </b><?php echo $value->contr_cargo; ?></p>
   </a>

     <?php }?>
     </div>
     </div>
     <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
    </div>
   </div>

 </div>
</div><!--vencimentos-->


<div id="admitidosmodal" class="modal fade" tabindex="-1" role="document" >
   <div class="modal-dialog">
    <div class="modal-content" style="max-height:595px; overflow:scroll;">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="">Admitidos no m�s</h4>
    </div>
     <div class="modal-body" id="">
        <div class="panel-body list-group list-group-contacts">
      <?php foreach ($admitidos as $key => $value) { 
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
        ?>
      <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$value->fun_idfuncionario); ?>" class="list-group-item">
    
      <img src="<?php echo $foto; ?>" class="pull-left" />
        <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
        <p>Data de Admiss�o <?php echo $this->Log->alteradata1($value->contr_data_admissao); ?></p>

   </a>
     <?php }?>
     </div>
     </div>
     <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
    </div>
   </div>

 </div>
</div>

<div id="demitidosmodal" class="modal fade" tabindex="-1" role="document" >
   <div class="modal-dialog">
    <div class="modal-content" style="max-height:595px; overflow:scroll;">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="">Demitidos no m�s</h4>
    </div>
     <div class="modal-body" id="">
        <div class="panel-body list-group list-group-contacts">
      <?php foreach ($demitidos as $key => $value) { 
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
        ?>

      <a href="#" class="list-group-item">
        <img src="<?php echo $foto; ?>" class="pull-left" />
        <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
        <p>Data de Demiss�o <?php echo $this->Log->alteradata1($value->datdem); ?></p>
      </a>

     <?php }?>
     </div>
     </div>

     <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
    </div>

   </div>

 </div>
</div><!--demitidos modal -->

<!--<div id="equipemodal" class="modal fade" tabindex="-1" role="document" >
   <div class="modal-dialog">
    <div class="modal-content" style="max-height:595px; overflow:scroll;">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="">Minha Equipe</h4>
    </div>
     <div class="modal-body" id="">
        <div class="panel-body list-group list-group-contacts">
      <?php foreach ($equipe as $key => $value) { 
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
      ?>

      <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$value->fun_idfuncionario); ?>" class='list-group-item'>
        <img src="<?php echo $foto; ?>" class="pull-left" />
        <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
        <p><b>Cargo:</b> <?php echo $value->contr_cargo; ?></p>
      </a>     

     <?php }?>
     </div>
     </div>

     <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
    </div>

   </div>

 </div>
</div>--><!--Equipe modal -->

 <!-- START WIDGETS -->                    
  <div class="row"> 
  
      <!-- Turn Over -->
      <div class="col-md-3">
      <div class="widget widget-default widget-carousel">
        <div class="owl" id="owl-example">
        <img id='loadturn' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' style="left: 40%;position: relative;">
        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div>
    <!-- Fim do TurnOver -->
      
    <div class="col-md-3" data-toggle="modal" data-target="#vencimentosmodal">
      <!-- START WIDGET REGISTRED -->
      <div class="widget widget-default widget-item-icon" style="cursor: pointer;">
            <div class="widget-item-left">
                <span class="fa fa-file-text"></span>
            </div>
        <div class="widget-data">
            <div class="widget-int num-count"><?php echo count($vencimentos); ?></div>
            <div class=""><h3>Contrato Trabalho</h3></div>
            <div class="widget-subtitle">Vencimento pr�ximos 90 dias</div>
        </div>
        <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
    </div>  
      
     
    <!-- Inicio Admitidos no m�s -->

    <?php 
      $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Mar�o", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$mes = $meses[date("n")]; 
$mes_ano = $mes."/".date("Y");

    ?>
    <div class="col-md-2">                        
        <a id="admitidos" href="#" data-toggle="modal" data-target="#admitidosmodal" class="tile tile-info tile-valign">
            <?php echo count($admitidos); ?>
            <div class="informer informer-default">Admitidos no m�s</div>
            <div class="informer informer-default dir-br"><?php echo $mes_ano; ?> <span class="fa fa-users"></span></div>
        </a>                            
    </div>
    <!-- Fim do Admitidos no m�s -->  

      
    <!-- Inicio Demitidos no m�s -->  
    <div class="col-md-2">                        
        <a href="#" data-toggle="modal" data-target="#demitidosmodal" class="tile tile-default">
            <?php echo count($demitidos); ?>
            <p>Demitidos no m�s</p>
            <div class="informer informer-primary"><?php echo $mes_ano; ?></div>
            <div class="informer informer-danger dir-tr"><span class="fa fa-caret-down"></span></div>
        </a>                        
    </div>
    <!-- Fim do Demitidos no m�s -->  
      
    <div class="col-md-2">                        
        <a href="<?php echo base_url("gestor/equipe"); ?>" data-toggle="" data-target="" class="tile tile-default">
        <?php echo count($equipe); ?>
            <p>Colaboradores</p>
            <div class="informer informer-primary">Minha Equipe</div>
            <div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
        </a>                        
    </div>      
      
      
</div>

 <div class="row">
     
     
       <div class="col-md-4">

            <!-- START SALES & EVENTS BLOCK -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Horas Trabalhadas x Horas Extras</h3>
                        <span>Comparativo de Minha Equipe</span>
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>                                        
                        </li>                                        
                    </ul>
                </div>
                <div class="panel-body padding-0">
                    <div class="chart-holder" id="morris-line-example" style="height: 200px;"></div>
                </div>
            </div>
            <!-- END SALES & EVENTS BLOCK -->

        </div>


      <div class="col-md-4">
      <!-- START USERS ACTIVITY BLOCK -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Absente�smo da Minha Equipe</h3>
            <span>4 �ltimos meses</span>
          </div>                                    
          <ul class="panel-controls" style="margin-top: 2px;">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
              <ul class="dropdown-menu">
                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
              </ul>                                        
            </li>                                        
          </ul>                                    
        </div>                                
        <div class="panel-body padding-0">
          <div class="chart-holder" id="dashboard-bar-1" style="height: 200px;"></div>
        </div>                                    
      </div>
      <!-- END USERS ACTIVITY BLOCK -->
    </div>

     
    <div class="col-md-4">

      <!-- START VISITORS BLOCK -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Escolaridade Colaboradores</h3>
            <span>N�vel de Escolaridade Minha Equipe</span>
          </div>
          <ul class="panel-controls" style="margin-top: 2px;">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
              <ul class="dropdown-menu">
                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
              </ul>                                        
            </li>                                        
          </ul>
        </div>
        <div class="panel-body padding-0">
          <div class="chart-holder" id="dashboard-donut-1" style="height: 200px;"></div>
        </div>
      </div>
      <!-- END VISITORS BLOCK -->

    </div>  
     
</div>


<div class="row scRow">

    <div class="col-md-3 scCol">
      <div class="widget widget-default widget-item-icon" id="grid1">
            <div class="widget-item-left">
                <span class="fa fa-users"></span>
            </div>
        <div class="widget-data">
            <div class="widget-int num-count"><?php echo number_format($taxasaida, 1, ",", "") . "%"; ?></div>
            <div class=""><h3>Taxa de Sa�das</h3></div>
            <div class="widget-subtitle">Rec�m Admitidos (1� ano)</div>
        </div>
        <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
    </div>      
    
    
    <!-- Indicadores de Situa��o -->
      <div class="col-md-3">
      <div class="widget widget-default widget-carousel">

      <span class="bold corsec acenter fleft" style="width: 100%;">Situa��o Atual da Equipe</span>

        <div class="owl-carousel" id="">     

        <?php foreach ($arr_situacao as $key => $value) { 

          $colabs="";
          foreach ($value['ids'] as $k => $v) {
            $colabs .= $v.",";
          }

        ?>        
          <div data-titulo="<?php echo $key; ?>" data-ids="<?php echo rtrim($colabs, ","); ?>" class="sit" style="cursor: pointer;">                                    
            <div class="widget-title"><?php echo $key; ?></div>                                            
            <div class="widget-int"><?php echo $value["qtd"]; ?></div>
          </div>

        <?php } ?>

        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div>
    <!-- Fim do Indicadores de Situa��o -->
	
	
	<!-- banco de horas da Equipe -->
    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                <div class="widget-item-left">
                   <span class="fa fa-clock-o"></span>
                </div>
           <div class="widget-data">
				<div class="widget-title">220h:15m</div>
                <div class="widget-title">Banco Horas</div>
                <div class="widget-subtitle">Saldo Atual da Equipe</div>
				<div class="widget-subtitle">Data Fechamento: 30/07/2017</div>
           </div>
           <div class="widget-controls">                                
				<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
           </div>                            
        </div>                            
    </div>		
	
	
	

    <div class="col-md-3" id="examesmodal">
      <div class="widget widget-default widget-carousel">

      <div class="" style="position: absolute;">
        <img src="<?php echo base_url("img/icons/iconaso.png"); ?>" style="width: 55%;" >
      </div>
        <div class="owl-carousel" id="">     

          <div data-titulo="ASO - A vencer" data-tipo="1" class="aso" style="cursor: pointer;">                                    
            <h2 class="bold acenter"><?php echo $aso1->vencimento; ?></h2>
            <div class="widget-subtitle">Vence � 15 dias</div>
          </div>

          <div data-titulo="ASO - Vencidos" data-tipo="2" class="aso">
            <h2 class="bold acenter" ><?php echo $aso2->vencidos; ?></h2>
            <div class="widget-subtitle">Vencidos</div>
          </div>

        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div>



        
</div>


<div class="row scRow">

    <!-- Inicio media de idade -->  
    <?php $soma=0;
    foreach ($idade as $key => $value) {

      $date = new DateTime( $value->fun_datanascimento );
      $interval = $date->diff( new DateTime() );
      $soma += $interval->format( '%Y' );     

    }
    $c = (count($idade)==0)? 1 : count($idade);
     $media = $soma / $c;

    ?>
    <div class="col-md-2 scCol">                        
        <a href="#" class="tile tile-info tile-valign" id="grid2">
           <span style="line-height: 30px;float: center;margin: 19px 0px;">
             <?php echo number_format($media, 1, ",", ""); ?>
           </span> 
            <div class="informer informer-default">M�dia de idade (anos)</div>
            <div class="informer informer-default dir-br">Minha Equipe <span class="fa fa-users"></span></div>
        </a>                            
    </div>
    <!-- Fim do media de idade -->  

	
    <!-- Inicio media de Tempo Servi�o -->  
    <?php $soma=0;
    foreach ($tempo_trabalhado as $key => $value) {

      $date = new DateTime( $value->contr_data_admissao );
      $interval = $date->diff( new DateTime() );
      $soma += $interval->format( '%Y' );
    }
    $d = (count($tempo_trabalhado)==0)? 1 : count($tempo_trabalhado);
     $media = $soma / $d;
    ?>
	
    <div class="col-md-2 scCol">                        
        <a href="#" class="tile tile-success tile-valign" id="grid3">
        <span style="line-height: 30px;float: center; margin: 19px 0px;"><?php echo number_format($media, 1, ",", ""); ?></span>
            <div class="informer informer-default">Tempo m�dio de Empresa</div>
			<div class="informer informer-default dir-br">Minha Equipe <span class="fa fa-users"></span></div>
        </a>                                                    
    </div>

	
	    
	<div class="col-md-3">
	  <div class="widget widget-default widget-item-icon" onclick="#';">
		<div class="widget-item-left">
			<span class="fa fa-user"></span>
        </div>
        <div class="widget-data">
             <div class="widget-title">Membros Cipa</div>
			 <div class="widget-int num-count">05</div>
             <div class="widget-subtitle">Elei��o: 01/01/2017</div>
			 <div class="widget-subtitle">Estabilidade: 01/01/2019</div>
        </div>
        <div class="widget-controls">                                
			<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
    </div>	  
                            
      <div class="col-md-3">
      <div class="widget widget-default widget-item-icon" onclick="#';">
	  <div class="widget-item-left">
      <span class="glyphicon glyphicon-fire"></span>
        </div>
          <div class="widget-data">
             <div class="widget-title">Brigadistas</div>
			 <div class="widget-int num-count">08</div>
             <div class="widget-subtitle">Engagamento: 01/01/2017</div>
			 <div class="widget-subtitle">EPI's Brigada: 03</div>
          </div>
        <div class="widget-controls">                                
			<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
        </div>                            
       </div>                            
      </div>	 	
	
	
    <div class="col-md-2">                        
		<a href="#" class="tile tile-default">
			32<p>EPIs Distribu�dos</p>
			<div class="informer informer-primary">Minha Equipe</div>
			<div class="informer informer-success dir-tr"><span class="fa fa-users"></span></div>
		</a>
	</div>		


</div>


<div class="row scRow">


    <div class="col-md-2">                        
        <a href="#" class="tile tile-default">
			09<p>Incidentes</p>
			<div class="informer informer-primary">�ltimos 12 meses (Equipe)</div>
			<div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
        </a> 
    </div>			
	  
    
	<div class="col-md-2">                        
		<a href="#" class="tile tile-default">
			03<p>Acidentes (CAT)</p>
			<div class="informer informer-primary">�ltimos 12 meses (Equipe)</div>
			<div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
        </a> 
    </div>	

	
</div>


<script type="text/javascript">
  Morris.Bar({
    element: 'dashboard-bar-1',
    data: [
    { y: 'Ago', a: 78, b: 95, c: 20 },
    { y: 'Set', a: 65, b: 72, c: 32 },
    { y: 'Out', a: 91, b: 60, c: 20 },
    { y: 'Nov', a: 58, b: 45, c: 12 }
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
    
$(".sit").click(function(){
  var ids = $(this).data("ids");
  var titulo = "Situa��o: " + $(this).data("titulo");
  $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
        $("#titulomodal").text(titulo);
        $("#myModalTamanho").removeClass("modal-lg");
        $('#myModal').modal('show');

        $.ajax({             
          type: "POST",
          url: '<?php echo base_url('ajax/view_escolaridade') ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            ids: ids
          },              
          success: function(msg) 
          {
            $( "#dadosedit" ).html(msg);

          } 
        });

      });

  $(".aso").click(function(){
    
    var titulo = $(this).data("titulo");
    var opcao = $(this).data("tipo");
    $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
    $("#titulomodal").text(titulo);
    $("#myModalTamanho").removeClass("modal-lg");
    $('#myModal').modal('show');

    $.ajax({             
        type: "POST",
        url: '<?php echo base_url('perfil/aso') ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          opcao: opcao,
          dash: "gestor"
        },              
        success: function(msg) 
        {
          //console.log(msg);
          $( "#dadosedit" ).html(msg);
        } 
    });

   });
    
    var morrisCharts = function() {

      Morris.Line({
        element: 'morris-line-example',
        data: [
        { y: '2016-05-01', a: 220, b: 30, c: 10 },
        { y: '2016-06-01', a: 200, b: 32, c: 11 },
        { y: '2016-07-01', a: 180, b: 15, c: 08 },
        { y: '2016-08-01', a: 220, b: 25, c: 40 },
        { y: '2016-09-01', a: 220, b: 18, c: 20 },
        { y: '2016-10-01', a: 180, b: 50, c: 14 },
        { y: '2016-11-01', a: 220, b: 19, c: 10 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b','c'],
        labels: ['Horas Trab.', 'H.Extra 100%','H.Extra 50%'],
        resize: true,
        lineColors: ['#33414E', '#95B75D','#1caf9a']
      });



      Morris.Donut({
        element: 'dashboard-donut-1',
        data: [
        <?php echo $esc; ?>
        ],
        colors: ['#33414E', '#1caf9a', '#FEA223', '#34812E','#1cef8a'],
        resize: true
      }).on('click', function(i, row){

        $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
        $("#titulomodal").text(row.label);
        $("#myModalTamanho").removeClass("modal-lg");

        $('#myModal').modal('show');
        $.ajax({             
          type: "POST",
          url: '<?php echo base_url('ajax/view_escolaridade') ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            ids: row.ids
          },              
          success: function(msg) 
          {
            $( "#dadosedit" ).html(msg);

          } 
        });

      });

  }();    
    
    $(document).ready(function(){

      var carousel = function(){
            
            if($(".owl").length > 0){
                $(".owl").owlCarousel({mouseDrag: false, touchDrag: true, slideSpeed: 300, paginationSpeed: 400, singleItem: true, navigation: false,autoPlay: true});
            }            
       }

      $.ajax({             
          type: "POST",
          url: '<?php echo base_url('gestor/turnover') ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            
          },              
          success: function(msg) 
          {
            
            $( "#owl-example" ).html(msg);
            carousel();
          }

        });


      $(window).resize(function(){
        carousel();
       });

    });

    
    
</script>