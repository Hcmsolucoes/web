<?php 
$valorpremio = "não há prêmios";
$datacompetencia=null;

foreach ($pontoaponto as $value) {
    $valorpremio = $value -> pon_totalpremio;
    $lancamento = $this->Log->alteradata1($value -> para_compintegracao);
    $datacompetencia = $this->Log->alteradata1($value -> para_datacompentencia);
}

foreach ($funcionario as $value) {
        $nome = $value->fun_nome;
		$cargo = $value->fun_cargo;
		$matricula = $value -> fun_matricula;
		//$foto = $value -> fun_foto;
    $ultexame = ($value->fun_ultimoexame!="")?$this->Log->alteradata1($value->fun_ultimoexame):"Não há exame";
    $proexame = ($value->fun_proximoexame!="")?$this->Log->alteradata1($value->fun_proximoexame):"Não há exame";
    }
    foreach ($contratos as $value) {
        $departamento = $value->contr_departamento;
		$dataadmin = $value->contr_data_admissao;
    }
$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$mes = $meses[date("m")]; 
$mes_ano = $mes."/".date("Y")
?>
<div id="loading" align="center">
  <img style="top: 50%;position: absolute;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
</div>
<!-- PAGE CONTENT WRAPPER -->

  <div id="nivermodal" class="modal fade" tabindex="-1" role="document" >
   <div class="modal-dialog">
    <div class="modal-content" style="max-height:595px; overflow:scroll;">

     <div class="modal-body" id="">

      <?php foreach ($aniversariantes as $key => $value) { 
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $anifoto = (empty($value->fun_foto) )? "http://hcmsolucoes.com.br/people/img/".$avatar.".jpg" : $value->fun_foto;
        
        ?>

      <div class="btn-default col-md-7 " id="ani<?php echo $value->fun_idfuncionario; ?>" style="padding: 5px 5px;margin: 7px 0% 0px 27%;">            

        <a href="#" data-toggle="collapse" data-target="#aniver<?php echo $value->fun_idfuncionario; ?>">
          <div class="fleft">
            <img src="<?php echo $anifoto; ?>" alt="" class="imgcirculo_xp " style="position: absolute;top: 0px;left: -17px; padding: 1px;">
          </div>
          <div class="fleft" style="margin: 0px 0px 0px 30px;">
            <h5 class="font-bold"><?php echo $value->fun_nome; ?></h5>
            <h5 class="font-sub"><?php //echo $this->Log->alteradata1($value->fun_datanascimento); ?> dê parabéns</h5>
          </div>
        </a>

        <div class="clearfix"></div>

        <div class="collapse" id="aniver<?php echo $value->fun_idfuncionario; ?>">
         <textarea class="form-control textarea-xs" id="msg<?php echo $value->fun_idfuncionario; ?>"></textarea>
         <input type="button" data-niver="<?php echo $value->fun_idfuncionario; ?>" class="btn btn-primary btniver" value="Enviar"  />
       </div>
     </div>


     <?php }?>
   </div>

 </div>
</div>
</div>



  <!-- START WIDGETS -->                    
  <div class="row">
    <div class="col-md-3">

      <!-- START WIDGET SLIDER -->
      <div class="widget widget-default widget-carousel">
        <div class="owl-carousel" id="owl-example">
          <div>                                    
            <div class="widget-title">Líquido Folha</div>                                                                        
            <div class="widget-subtitle"><?php echo $this->Log->alteradata1($mesativoref) ?> - Cálculo Mensal</div>
            <div class="widget-int">R$ <?php echo number_format($totalliquido, 2,",","." ) ?></div>
          </div>
          <div>                                    
            <div class="widget-title">(+) Proventos</div>
            <div class="widget-subtitle"><?php echo $this->Log->alteradata1($mesativoref) ?> - Cálculo Mensal</div>
            <div class="widget-int">R$ <?php echo number_format($totalproventos, 2,",","." ) ?></div>
          </div>
          <div>                                    
            <div class="widget-title">(-) Descontos</div>
            <div class="widget-subtitle"><?php echo $this->Log->alteradata1($mesativoref); ?> - Cálculo Mensal</div>
            <div class="widget-int">R$ <?php echo number_format($totaldesconto, 2,",","." ) ?></div>
          </div>
        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
      <!-- END WIDGET SLIDER -->

    </div>


    <!-- START WIDGETS -->                    
    <div class="col-md-3">
      <?php $modal=''; if (count($aniversariantes)>0) {
        $modal='data-toggle="modal" data-target="#nivermodal"';
      } ?>
      <!-- START WIDGET MESSAGES -->
      <div class="widget widget-default widget-item-icon" onclick="#';">
        <div class="widget-item-left">
          <span class="fa fa-gift"></span>
        </div>                             
        <div class="widget-data">
          <div class="widget-int num-count"><?php echo count($aniversariantes) ?></div>
          <div class="widget-title">Aniversariantes</div>
          <div class="widget-subtitle"><?php echo $mes_ano; ?></div>
          <div class="widget-subtitle"><a href="#" id="nivers" <?php echo $modal; ?>>clique e veja a lista</a></div>
        </div>      
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>
      </div>                                                                                
    </div>
    <!-- END WIDGET MESSAGES -->

    <div class="col-md-3">
      <!-- START WIDGET REGISTRED -->
      <div class="widget widget-default widget-item-icon" onclick="location.href='<?php echo  base_url()."perfil/feedbacks"; ?>';">
        <div class="widget-item-left">
          <span class="fa fa-comments"></span>
        </div>
        <div class="widget-data">
          <div class="widget-int num-count"><?php echo $quantultimos; ?></div>
          <div class="widget-title">Feedbacks</div>
          <div class="widget-subtitle">Recebidos, <a href="<?php echo  base_url()."perfil/feedbacks"; ?>">clique para ver</a> </div>
        </div>
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
      <!-- END WIDGET REGISTRED -->
    </div>
      
    <div class="col-md-3">

      <!-- START WIDGET CLOCK -->
      <div class="widget widget-info widget-padding-sm">
        <div class="widget-big-int plugin-clock">00:00</div>                            
        <div class="widget-subtitle plugin-date">Loading...</div>
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                            
        <div class="widget-buttons widget-c3">
          <div class="col">
            <a href="#"><span class="fa fa-clock-o"></span></a>
          </div>
          <div class="col">
            <a href="#"><span class="fa fa-bell"></span></a>
          </div>
          <div class="col">
            <a id="calendario" href="#"><span class="fa fa-calendar"></span></a>
          </div>
        </div>                            
      </div>                        
      <!-- END WIDGET CLOCK -->

    </div>
  </div>
  <!-- END WIDGETS -->                    

  <div class="row">
    <div class="col-md-4">

      <!-- START USERS ACTIVITY BLOCK -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Absenteísmo</h3>
            <span>4 últimos meses</span>
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
            <h3>Pendências</h3>
            <span>Total de Pendências</span>
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

    <div class="col-md-4">

      <!-- START SALES & EVENTS BLOCK -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Evolução Salarial</h3>
            <span>Históricos salariais</span>
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
          <div class="chart-holder" id="dashboard-line-1" style="height: 200px;"></div>
        </div>
      </div>
      <!-- END SALES & EVENTS BLOCK -->
    </div>
    </div>

    <!-- START WIDGETS -->                    
    <div class="row">
        
      <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="#';">
          <div class="widget-item-left">
            <span class="fa fa-medkit"></span>
          </div>                             
          <div class="widget-data">
            <div class="widget-subtitle">Último Exame</div>
            <div class="widget-title"><?php echo $ultexame  ?></div>
            <div class="widget-subtitle">Próximo Exame</div>
            <div class="widget-title"><?php echo $proexame  ?></div>
          </div>      
          <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
          </div>
        </div>                            
      </div>

        
      <div class="col-md-3">
        <div class="widget widget-default widget-carousel">
            <div class="owl-carousel" id="owl-example">
                <div>                                    
                    <div class="widget-title">Vale Transporte</div>                                                                        
                    <div class="widget-subtitle">Data Crédito: 05/11/2016</div>
                    <div class="widget-int">R$ 155,25</div>
                </div>
                <div>                                    
                    <div class="widget-title">Vale Refeição</div>
                    <div class="widget-subtitle">Data Crédito: 05/11/2016</div>
                    <div class="widget-int">R$ 320,80</div>
                </div>
                <div>                                    
                    <div class="widget-title">Vale Alimentação</div>
                    <div class="widget-subtitle">Data Crédito: 05/11/2016</div>
                    <div class="widget-int">R$ 170,00</div>
                </div>
            </div>                            
            <div class="widget-controls">                                
              <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
            </div>                             
        </div>         
      </div>
        
        
    <div class="col-md-3">
      <!-- START WIDGET REGISTRED -->
      <div class="widget widget-default widget-item-icon" onclick="location.href='#';">
        <div class="widget-item-left">
          <span class="fa fa-plane"></span>
        </div>
        <div class="widget-data">
          <div class="widget-int num-count">01</div>
          <div class="widget-title">Férias</div>
          <div class="widget-subtitle">Vencidas, <a href="#">clique para ver</a> </div>
        </div>
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
      <!-- END WIDGET REGISTRED -->
    </div>        
        
        
      <div class="col-md-3">

<?php 
$modulos = explode(",", $this->session->userdata('modulos'));
$modpont = false;
foreach ($modulos as $value) {
  if($value == 1){
    $modpont = true; 
  }
}

if ($modpont) {
 ?>  
        <!-- START WIDGET MESSAGES -->
        <div class="widget widget-default widget-item-icon" onclick="#';">
          <div class="widget-item-left">
            <span class="fa fa-truck"></span>
          </div> 
          <?php if ( !empty($lancamento) ) { ?>                         
          <div class="widget-data">
            <div class="widget-title"><?php echo $valorpremio ?></div>
            <div class="widget-title">Ponto a Ponto</div>
            <div class="widget-subtitle">Último Prêmio. <br>Data Pagamento: <?php echo $lancamento; ?></div>
          </div> 
          <?php } else{
      echo "<h3 class='bold acenter' style='margin-top: 30px;'>Não há prêmios</h3>";
                } ?>
          <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
          </div>
        </div> 

        <?php } ?>                           
        <!-- END WIDGET MESSAGES -->

      </div>
    </div>


  <script type="text/javascript" src="<?php echo base_url('js/settings.js') ?>"></script>

<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var cor = "#1CAF9A";//$(".bg-primary").css("background-color");
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'data');
  data.addColumn('number', 'valor');
  data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
  var options = {
    title: 'Evolução Salarial',
    curveType: 'function',
    pointsVisible: true ,
    series: {
      0: { color: cor }
    }      

  };

  var chart = new google.visualization.LineChart(document.getElementById('dashboard-line-1'));
  $.ajax({            
    type: "post",
    url: '<?php echo base_url()."ajax/evsalarial";?>',
    dataType : 'json',
    secureuri:false,
    cache: false,
    data:{
     limit : 1
   },              
   success: function(msg){

    if(msg === 'erro'){
      alert("Houve um erro");
    }else{

      data.addRows( msg.rows);
      chart.draw(data, options);

    }
  } 
  });

}

$(document).ready(function(){

  $(".btniver").on("click", function(){
    
      var dest = $(this).data("niver");
      var msg = $("#msg"+dest).val();
      $(this).prop( "disabled", true );
      $.ajax({             
        type: "POST",
        url: '<?php echo base_url().'ajax/addMensagem' ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          texto : msg,
          destinatario : dest
        },              
        success: function(msg) 
        {
          $("#ani"+dest).slideUp("slow");
        } 
      });

    });

    $('.ts-themes a').click(function(){
      var frameworkColor = $(this).data("theme");
      console.log(frameworkColor);
      $('#loading').slideDown({
        complete: function(){
          if ( frameworkColor != '' ) {
            $.ajax({            
              type: "POST",
              url: '<?php echo base_url()."ajax/mudartema";?>',
              dataType : 'html',
              secureuri:false,
              cache: false,
              data:{
                cor : frameworkColor
              },              
              success: function(msg){
                console.log(msg);
                if(msg === 'erro'){
                  alert("Houve um erro");
                }else{

                  location.reload();

                }
              } 
            });

          }
        }//---if
      });

    });

   if($("#reportrange").length > 0){   
        $("#reportrange").daterangepicker({                    
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM.DD.YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment()            
          },function(start, end) {
              $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
        
        $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }


    Morris.Donut({
        element: 'dashboard-donut-1',
        data: [
            {label: "Documentos", value: 03},
            {label: "Dados Perfil", value: 15},
            {label: "Aprovações", value: 08}
        ],
        colors: ['#33414E', '#1caf9a', '#FEA223'],
        resize: true
    });

    Morris.Bar({
        element: 'dashboard-bar-1',
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
    
    Morris.Area({
      element: 'dashboard-area-1',
      data: [
        { y: '2014-10-10', a: 17,b: 19},
        { y: '2014-10-11', a: 19,b: 21},
        { y: '2014-10-12', a: 22,b: 25},
        { y: '2014-10-13', a: 20,b: 22},
        { y: '2014-10-14', a: 21,b: 24},
        { y: '2014-10-15', a: 34,b: 37},
        { y: '2014-10-16', a: 43,b: 45}
      ],
      xkey: 'y',
      ykeys: ['a','b'],
      labels: ['Sales','Event'],
      resize: true,
      hideHover: true,
      xLabels: 'day',
      gridTextSize: '10px',
      lineColors: ['#1caf9a','#33414E'],
      gridLineColor: '#E5E5E5'
    });

    var jvm_wm = new jvm.WorldMap({container: $('#dashboard-map-seles'),
      map: 'world_mill_en', 
      backgroundColor: '#FFFFFF',                                      
      regionsSelectable: true,
      regionStyle: {selected: {fill: '#B64645'},
      initial: {fill: '#33414E'}},
      markerStyle: {initial: {fill: '#1caf9a',
      stroke: '#1caf9a'}},
      markers: [{latLng: [50.27, 30.31], name: 'Kyiv - 1'},                                              
      {latLng: [52.52, 13.40], name: 'Berlin - 2'},
      {latLng: [48.85, 2.35], name: 'Paris - 1'},                                            
      {latLng: [51.51, -0.13], name: 'London - 3'},                                                                                                      
      {latLng: [40.71, -74.00], name: 'New York - 5'},
      {latLng: [35.38, 139.69], name: 'Tokyo - 12'},
      {latLng: [37.78, -122.41], name: 'San Francisco - 8'},
      {latLng: [28.61, 77.20], name: 'New Delhi - 4'},
      {latLng: [39.91, 116.39], name: 'Beijing - 3'}]
    });

    $(".x-navigation-minimize").on("click",function(){
        setTimeout(function(){
            rdc_resize();
        },200);    
    });

    $("#calendario").click(function(){
      $.ajax({             
    type: "POST",
    url: '<?php echo base_url().'home/calendario' ?>',
    dataType : 'html',
    secureuri:false,
    cache: false,
    data:{
    },              
    success: function(msg) 
    {    

      $( "#dadosedit" ).html(msg);
      $('#myModal').modal('show');

    } 
  });
    });
    
    

 /*   $('.ts-themes a').click(function(){
      //var frameworkColor = $(this).data("theme");
      //console.log("adf");

      var frameworkColor = $(this).data("theme");
      console.log("adf");

      $('#loading').slideDown({
       complete: function(){

         if ( frameworkColor != '' ) {
          $.ajax({            
            type: "POST",
            url: '<?php echo base_url()."ajax/mudartema";?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
              cor : frameworkColor
            },              
            success: function(msg) 
            {
              console.log(msg);
              if(msg === 'erro'){
                alert("Houve um erro");
              }else{

                location.reload();

              }
            } 
          });

        }
        $('#loading').delay(1500).slideUp();
        }
      });


    });*/


});
</script>