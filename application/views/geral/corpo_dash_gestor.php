 <?php


foreach ($escolaridade as $key => $value) {  

  if (!isset($arr[$value->escolaridade_descricao])) {

    $arr[$value->escolaridade_descricao]=1;

  }else{

    $arr[$value->escolaridade_descricao]++;

  }

}
$esc = "";
foreach ($arr as $key => $value) {

 $esc .= "{label: '".$key."', value: ".$value."},";

}

//var_dump($arr);

 ?>

 <!-- START WIDGETS -->                    
  <div class="row"> 
  
      <!-- Turn Over -->
      <div class="col-md-3">
      <div class="widget widget-default widget-carousel">
        <div class="owl-carousel" id="owl-example">
          <div>                                    
            <div class="widget-title">Turn Over</div>                                                                        
            <div class="widget-subtitle">Outubro/2016</div>
            <div class="widget-int">6,68%</div>
          </div>
          <div>                                    
            <div class="widget-title">Turn Over</div>
            <div class="widget-subtitle">Setembro/2016</div>
            <div class="widget-int">5,21%</div>
          </div>
          <div>                                    
            <div class="widget-title">Turn Over</div>
            <div class="widget-subtitle">Agosto/2016</div>
            <div class="widget-int">5,80%</div>
          </div>
          <div>                                    
            <div class="widget-title">Turn Over</div>
            <div class="widget-subtitle">Julho/2016</div>
            <div class="widget-int">7,70%</div>
          </div>
          <div>                                    
            <div class="widget-title">Turn Over</div>
            <div class="widget-subtitle">Junho/2016</div>
            <div class="widget-int">3,90%</div>
          </div>
          <div>                                    
            <div class="widget-title">Turn Over</div>
            <div class="widget-subtitle">Maio/2016</div>
            <div class="widget-int">15,30%</div>
          </div>
        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div>
    <!-- Fim do TurnOver -->
      
    <div class="col-md-3">
      <!-- START WIDGET REGISTRED -->
      <div class="widget widget-default widget-item-icon">
            <div class="widget-item-left">
                <span class="fa fa-file-text"></span>
            </div>
        <div class="widget-data">
            <div class="widget-int num-count">02</div>
            <div class=""><h3>Contrato Trabalho</h3></div>
            <div class="widget-subtitle">Vencimento próximos 90 dias</div>
        </div>
        <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
    </div>  
      
     
    <!-- Inicio Admitidos no mês -->  
    <div class="col-md-2">                        
        <a href="#" class="tile tile-info tile-valign">
            03
            <div class="informer informer-default">Admitidos no mês</div>
            <div class="informer informer-default dir-br">Novembro/2016 <span class="fa fa-users"></span></div>
        </a>                            
    </div>
    <!-- Fim do Admitidos no mês -->  

      
    <!-- Inicio Demitidos no mês -->  
    <div class="col-md-2">                        
        <a href="#" class="tile tile-default">
            01
            <p>Demitidos no mês</p>
            <div class="informer informer-primary">11/2016</div>
            <div class="informer informer-danger dir-tr"><span class="fa fa-caret-down"></span></div>
        </a>                        
    </div>
    <!-- Fim do Demitidos no mês -->  
      
    <div class="col-md-2">                        
        <a href="#" class="tile tile-default">15
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
            <h3>Absenteísmo da Minha Equipe</h3>
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
            <h3>Escolaridade Colaboradores</h3>
            <span>Nível de Escolaridade Minha Equipe</span>
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
            <div class="widget-int num-count">25%</div>
            <div class=""><h3>Taxa de Saídas</h3></div>
            <div class="widget-subtitle">Recém Admitidos (1º ano)</div>
        </div>
        <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
    </div>      
    
    
    <!-- Indicadores de Situação -->
      <div class="col-md-3">
      <div class="widget widget-default widget-carousel">
        <div class="owl-carousel" id="owl-example">
          <div>                                    
            <div class="widget-title">Trabalhando</div>                                                                        
            <div class="widget-subtitle">Situação Atual da Minha Equipe</div>
            <div class="widget-int">10</div>
          </div>
          <div>                                    
            <div class="widget-title">Licença Maternidade</div>
            <div class="widget-subtitle">Situação Atual da Minha Equipe</div>
            <div class="widget-int">01</div>
          </div>
          <div>                                    
            <div class="widget-title">Auxílio Doença</div>
            <div class="widget-subtitle">Situação Atual da Minha Equipe</div>
            <div class="widget-int">03</div>
          </div>
          <div>                                    
            <div class="widget-title">Acidente Trabalho</div>
            <div class="widget-subtitle">Situação Atual da Minha Equipe</div>
            <div class="widget-int">01</div>
          </div>
          <div>                                    
            <div class="widget-title">Férias</div>
            <div class="widget-subtitle">Situação Atual da Minha Equipe</div>
            <div class="widget-int">04</div>
          </div>
        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div>
    <!-- Fim do Indicadores de Situação -->


    <!-- Inicio Admitidos no mês -->  
    <div class="col-md-2 scCol">                        
        <a href="#" class="tile tile-info tile-valign" id="grid2">
            32
            <div class="informer informer-default">Idade Média</div>
            <div class="informer informer-default dir-br">Minha Equipe <span class="fa fa-users"></span></div>
        </a>                            
    </div>
    <!-- Fim do Admitidos no mês -->  
    
    <div class="col-md-2 scCol">                        
        <a href="#" class="tile tile-success tile-valign" id="grid3">10
            <div class="informer informer-default dir-tr">Minha Equipe <span class="fa fa-users"></span></div>
            <div class="informer informer-default dir-bl">Média Tempo Empresa</div>
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
    });

}();    
    
    
</script>

