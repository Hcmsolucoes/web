<?php 
    
    $avatar = ( $solicitacao->fun_sexo==1 )?"avatar1":"avatar2";
    $foto = (empty($solicitacao->fun_foto) )? base_url("img/".$avatar.".jpg") : $solicitacao->fun_foto;
    $situacao = ($solicitacao->fun_status=="A")? "Ativo" : "Inativo";

    $datahora_efetiva = date('Y-m-d H:m:s' , strtotime($solicitacao->data_efetiva) );
list($data2, $hora2) = explode(" ", $datahora_efetiva);
$data2 = $this->Log->alteradata1( $data2 );

?>

<div style="padding: 0px 10px">

<h4>Status da solicitação:&nbsp;<span class="bold"><?php echo $solicitacao->descricao_status_solicitacao; ?></span></h4>
<form name="form_desligamento" id="form_desligamento" action="<?php echo base_url('gestor/salvarDesligamento'); ?>" method="post">

<div class="fleft-3">
<span class="bold">Solicitante: </span><span><?php echo $funcionario->fun_nome; ?></span>
<div class="fleft-7" style="margin: 20px 50px 0px 0px;">

  <label for="dt_desligamento" class="control-label">Data do desligamento</label>
   <div class='input-group' >
    <input class="form-control txleft campodata" type="text" name="dt_desligamento" id="dt_desligamento" placeholder="Data do desligamento" required="" value="<?php echo $data2; ?>">
    <span class="input-group-addon">
      <span class="fa fa-calendar"></span>
    </span>
  </div>

  </div>
  <!--<span class="bold">Colaborador: </span><span><?php echo $solicitacao->fun_nome; ?></span>-->
  
</div>
<div class="fleft-4">
<img class="fleft" src="<?php echo $foto; ?>" style="margin: 0px 10px 0px 0px;border: 3px solid #ccc;max-width: 90px;border-radius: 20%;">
    
    <span class="fleft font-sub bold"><?php echo $solicitacao->fun_nome; ?></span>
    <br>
    <span class="fleft bold">Matricula:</span>&nbsp;<span><?php echo $solicitacao->fun_matricula; ?></span>
    <br />
    <span class="fleft bold">Admissão:</span>&nbsp;<span><?php echo $this->Log->alteradata1($solicitacao->contr_data_admissao); ?></span>
    <br />
    <span class="fleft bold">Cargo:</span>&nbsp;<span><?php echo $solicitacao->contr_cargo; ?></span>
    <br />
    <span class="fleft bold">Departamento:</span>&nbsp;<span><?php echo $solicitacao->contr_departamento; ?></span>
    <br />
    <span class="fleft bold">Salario Atual:</span>&nbsp;R$<span><?php echo number_format($solicitacao->sal_valor, 2, ".", ","); ?></span>
    <br />
    <span class="fleft bold">Situação Atual:</span>&nbsp;<span><?php echo $situacao; ?></span>
</div>

<div class="clearfix"></div>

<img id="load_acao" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">

<div class="fleft" style="margin-top: 20px;">     
 <label for="motivo" class="control-label">Motivo do desligamento</label>
 <div class="clearfix" ></div>
 <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%"><?php echo $solicitacao->motivo_solicitacao; ?></textarea>
 
 <img id="load_desligamento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
</div>
<input type="hidden" id="solicitacao" name="solicitacao" value="<?php echo $solicitacao->solicitacao_id; ?>">

<div class="clearfix"></div>

<div class="fleft-7" style="">

  <?php if ($solicitacao->solicitacao_status==1) {  ?>
  <span id="encaminhar" class="btn btn-info acao" style="" data-campo="solicitacao_status" data-valor="2">Encaminhar</span>

  <input type="submit" style="" name="alterar_desligamento" value="Salvar" class="btn btn-primary">
  <?php } ?>

<?php if ($solicitacao->solicitacao_status<=2) {  ?>
  <!--<input type="submit" style="" name="alterar_desligamento" value="Salvar" class="btn btn-primary">-->
  
<?php } ?>

<?php if ($solicitacao->solicitacao_status==2) {  ?>
  <!--<span id="cancel" class="btn btn-default acao" style="" data-campo="solicitacao_status" data-valor="1">Cancelar</span>-->
  <?php } ?>

  <span class="btn btn-danger" style="" data-dismiss="modal">Sair</span>
               <!--<span id="aprovar" class="btn btn-default acao" style="width: 100%;margin-bottom: 7px;" data-campo="solicitacao_status" data-valor="3">Aprovar</span>

               <span id="rejeitar" class="btn btn-default acao" style="width: 100%;" data-campo="solicitacao_status" data-valor="4">Rejeitar</span>-->
</div>
</form>

</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('.campodata').datepicker({
            format: 'dd/mm/yyyy'
        });
	});
</script>

