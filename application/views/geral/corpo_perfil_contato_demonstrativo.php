<div class="page-title">                    
    <h2><span class="fa fa-money"></span> Demonstrativos de Pagamento</h2>
    <img id="load" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Pesquisando...">
</div> 

    <?php
    $opts = "";
    foreach ($tipodecalculo as $value) { 

     switch ($value->tipo_tipocal) {
      case '11':
      $tipocal = 'C�lculo Mensal';
      break;
      case '12':
      $tipocal = 'Folha Complementar';
      break;
      case '13':
      $tipocal = 'Complementar de Diss�dio';
      break;
      case '14':
      $tipocal = 'Pagamento de Diss�dio';
      break;
      case '15':
      $tipocal = 'Complementar Rescis�o';
      break;
      case '21':
      $tipocal = 'Primeira Semana';
      break;
      case '22':
      $tipocal = 'Semana Intermedi�ria';
      break;
      case '23':
      $tipocal = '�ltima semana';
      break;
      case '31':
      $tipocal = 'Adiantamento 13� Sal�rio';
      break;
      case '32':
      $tipocal = '13� Sal�rio Integral';
      break;
      case '41':
      $tipocal = 'Primeira Quinzena';
      break;
      case '42':
      $tipocal = 'Segunda Quinzena';
      break;
      case '91':
      $tipocal = 'Adiantamento Sal�rial';
      break;
      case '92':
      $tipocal = 'Participa��o dos Lucros';
      break;
      case '93':
      $tipocal = 'Especiais';
      break;
      case '94':
      $tipocal = 'Reclamat�ria Trabalhista';
      break;
    }

    $data = $value->tipo_mesref;
    $data = explode("-", $data);    
    list($ano, $mes, $dia ) = $data;  
    $opts .= "<option value='".$value->tipo_idtipodecalculo."'>".$mes.'/'.$ano.' - '.$tipocal."</option>";
    }?>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Use a pesquisa para localizar seus demonstrativos de pagamentos</p>
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search" id="lupa"></span>
                                </div>
                                    <select id="calcdata" name="calcdata" class="form-control cinza">
                                      <option>Selecione a compet�ncia de pagamento</option>
                                          <?php echo $opts; ?>
                                    </select>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" id="pesquisar">Pesquisar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>                                    
            </div>
        </div>
    </div>
</div>
      
<div class="row">
    <div class="col-md-12">
        <div id="result"></div>
    </div>
</div>
<div class="clearfix"></div>

<script>

    // abrir o menu pefil 
    $('#collapseTwo').collapse();
    $( ".abrefech" ).click(function(e) {
      e.preventDefault();

      if ($(this).find(".dvmais").html() === "+") {
        $(this).find(".dvmais").html("-");
      }
      else {
        $(this).find(".dvmais").html("+");
      }

    });

    $(document).ready(function(){
     
     $( "#pesquisar" ).click (function(e) {
        e.preventDefault();
       $("#load").fadeIn("slow");
       var calc = $("#calcdata").val();
       $("#result").slideUp();
       $("#result").html("");

       $.ajax({            
        type: "POST",
        url: '<?php echo base_url()."perfil/demonstrativoBusca";?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          calcdata : calc
        },              
        success: function(msg) 
        {
         
          if(msg === 'erro'){
            alert("Houve um erro");
          }else{
            $("#result").html(msg);
            $("#result").slideDown();
            $("#load").fadeOut("slow");                       
          }
        } 
      });

     });

     $("#calcdata").change(function(){
      $("#load").fadeIn("slow");
       var calc = $(this).val();
       $("#result").slideUp();
       $("#result").html("");

       $.ajax({            
        type: "POST",
        url: '<?php echo base_url()."perfil/demonstrativoBusca";?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          calcdata : calc
        },              
        success: function(msg) 
        {
         
          if(msg === 'erro'){
            alert("Houve um erro");
          }else{
            $("#result").html(msg);
            $("#result").slideDown();
            $("#load").fadeOut("slow");                       
          }
        } 
      });
     });

   });


 </script>

