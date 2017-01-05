
<?php 
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
  $tipocal = 'Pagaemnto de Diss�dio';
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
?>

<div class="widget widget-default">
 <div  class="" >
   <a <?php if($colapse){?> data-toggle="collapse" <?php } ?> class="abrefech" data-parent="#accordion" href="#dvcomple<?php echo $value->tipo_idtipodecalculo ?>">
     <div class="col-xs-11 col-sm-11 tit2" style=" font-size: 18px">
       <?php $data = $value->tipo_mesref;    $data = explode("-", $data);    list($ano, $mes, $dia ) = $data;  
       echo $mes.'/'.$ano.' - '.$tipocal;?>
     </div>
     <?php if( $colapse ){ ?>
     <div class="col-xs-1 col-sm-1 text-right dvmais" style=" font-size: 20px">+</div>
     <?php } ?>
   </a>
 </div>
 
 
 <div id="dvcomple<?php echo $value->tipo_idtipodecalculo ?>" class="panel-collapse ">
  <div  class="" >
    <div class="col-sm-6 cinza">Tipo de pagamento: <strong>Dep�sito banc�rio</strong></div>
    <div class="col-sm-6 cinza">Data de pagamento: <strong><?php echo $this->Log->alteradata1($value->tipo_datapag)?></strong></div>                             
  </div>


  
  <div class="tab-content">
    <div id="rubricas<?php echo $value->tipo_idtipodecalculo ?>" class="tab-pane fade active in">                                          
      <div style=" min-width: 200px;	overflow: auto; ">
        <table class="table table-striped table-condensed" style="text-align: left;margin-top: 20px">
          <thead>
            <tr>
              <th style=" width: 20px"> </th>
              <th>Descri��o</th>
              <th>Refer�ncia</th>
              <th>Descontos</th>
              <th>Proventos</th>
            </tr>
          </thead>
          <tbody>
           <?php $this->db->where('even_idtipodecalculo',$value->tipo_idtipodecalculo);
           $this->db->order_by("even_valor", "desc");
           $eventos = $this->db->get('eventoscalculo')->result();
           
           $totaldesconto = 0;
           $totalproventos = 0;
           $totalliquido = 0;
           foreach ($eventos as $dados) { 
             $valorevento = $dados->even_valor;
             $valorevento = str_replace(',' , '.', $valorevento);
             
             if($dados->even_tipoevento == '-'){
               $totaldesconto = $totaldesconto + $valorevento;
             }
             if($dados->even_tipoevento != '-'){
               if($dados->even_tipoevento != '#'){
                $totalproventos = $totalproventos + $valorevento;
              }
            }                                                     
            $totalliquido = 0;                                                         
            ?>
            <tr>
              <td>
                <?php switch ($dados->even_tipoevento) {
                  case '+':echo '<span class="glyph-icon icon-plus" style="color: #40b764"></span>';break;
                  case '-':echo '<span class="glyph-icon icon-minus" style="color: #e91b23"></span>';break;
                  case '#':echo '<span class="glyph-icon icon-info" style="color: #00a4e0"></span>';break;
                }?>
              </td> 
              <td><?php echo $dados->even_descrievento ?></td>
              <td><?php echo number_format($dados->even_referencia, 2, ",", "."); ?></td>
              <td style="color:#e91b23"><?php if($dados->even_tipoevento == '-'){echo 'R$ '.number_format($dados->even_valor, 2, ",", ".").'';}?></td>
              <td style=" <?php if($dados->even_tipoevento == '#'){echo 'color:#00a4e0';}else{echo 'color:#3fb663';}?>">
                <?php if($dados->even_tipoevento != '-'){echo 'R$ '.number_format($dados->even_valor, 2, ",", ".");}?>
              </td>
            </tr>
            <?php }?>
            <tr>
              <td></td>
              <td><strong><i>Total</i></strong></td>
              <td></td>
              <td style="color:#e91b23"><strong><i>R$ <?php echo number_format($totaldesconto, 2, ",", "."); ?></i></strong></td>
              <td style="color:#3fb663"><strong><i>R$ <?php echo number_format($totalproventos, 2, ",", "."); ?></i></strong></td>
            </tr>
            <tr>
              <td></td>
              <td><strong><i>Valor l�quido a receber:</i></strong></td>
              <td></td>
              <td></td>
              <td style="color:#3fb663"><strong><i>R$ <?php echo number_format(($totalproventos - $totaldesconto), 2, ",", "."); ?></i></strong></td>
            </tr>
          </tbody>
        </table>
      </div>
      
      
      <div  class="row" >
        <div class="col-sm-4 cinza" style=" margin-top: 20px">
          Dependentes IRRF: <strong><?php echo $value->tipo_impostorenda ?></strong> <br/>
          Base C�lculo IRRF: <strong><?php echo number_format($value->tipo_basecalculoirrf, 2, ",", ".") ?></strong>
        </div>
        <div class="col-sm-4 cinza" style=" margin-top: 20px">
          Dependentes Sal�rio Fam�lia: <strong><?php echo $value->tipo_ndependente_salariofami ?></strong> <br/>
          Base C�lculo FGTS: <strong><?php echo number_format($value->tipo_basefgts, 2, ",", ".") ?></strong>
        </div>  
        <div class="col-sm-4 cinza" style=" margin-top: 20px">
          Sal�rio base: <strong><?php echo number_format($value->tipo_salariobase, 2, ",", "."); ?></strong> <br/>
          Base C�lculo INSS: <strong><?php echo number_format($value->tipo_baseinss, 2, ",", ".") ?></strong>
        </div>  
      </div>


    </div>
    

  </div>
</div>


</div><?php } ?>