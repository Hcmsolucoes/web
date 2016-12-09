<?php 
//echo $sql;
//$lembrete = $lembretes[0];

$nome = explode(" ", $lembrete->fun_nome);
$data = "";
$validade = "";
if ( !empty($lembrete->dt_inicio_lembrete) ) {

  list($data, $hora) = explode(" ", $lembrete->dt_inicio_lembrete);
  $data = $this->Log->alteradata1( $data );
  
}
switch ($lembrete->id_periodo_lembrete) {
  case '1': $periodo = "Diariamente"; break;
  case '2': $periodo = "Semanalmente"; break;
  case '3': $periodo = "Mensalmente"; break;
  case '4': $periodo = "Anualmente"; break;  
  default:$periodo = "Diariamente";break;
}

 if($lembrete->ic_validade_lembrete==1){

   $validade = "até tempo indeterminado";

 }else if($lembrete->ic_recorrente_lembrete==1 && $lembrete->ic_validade_lembrete==0){
    
    list($datafinal, $hora) = explode(" ", $lembrete->dt_inicio_lembrete);
    $datafinal = $this->Log->alteradata1( $datafinal );
    $validade = "até ".$datafinal;

 }
?>

<h3 align="center"><?php echo $lembrete->titulo_lembrete; ?></h3>

<div class="fleft">
  <span>Avisar dia <?php echo $data. " ".$validade; ?></span>
<br>
<span><?php echo $periodo; ?></span>
<br>
  <span>Criador por <?php echo $nome[0]; ?></span>
</div>
<div class="separador"></div>

<div class="fleft"><?php echo $lembrete->descricao_lembrete; ?></div>

<div class="separador"></div>

<h4 class="fleft">Destinatários</h3>

<div class="separador"></div>

<div class="fleft">
<?php 

  if ($lembrete->ic_tipo_destinatario==1) {

    //foreach ($lembretes as $key => $value) { ?>

    <span class=""><?php //echo $value->fun_nome; ?></span>
    <br>
   
    <?php // } ?>
   
   <?php } ?>

</div>


