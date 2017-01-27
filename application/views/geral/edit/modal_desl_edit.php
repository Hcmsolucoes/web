<h3><span class="fa fa-times"></span> Desligamento</h3>
<form name="form_desligamento" id="form_desligamento" action="<?php echo base_url('gestor/salvarDesligamento'); ?>" method="post">

<div class="fleft-3">
<span class="bold">Solicitante: </span><span><?php echo $funcionario->fun_nome; ?></span>
<span class="bold">Colaborador: </span><span><?php echo $solicitacao->fun_nome; ?></span>   
</div>

<?php 

$datahora_efetiva = date('Y-m-d H:m:s' , strtotime($solicitacao->data_efetiva) );
list($data2, $hora2) = explode(" ", $datahora_efetiva);
$data2 = $this->Log->alteradata1( $data2 );

?>
 <div class="fleft-2" style="margin: 0px 50px 0px 0px;">
   <label for="dt_desligamento" class="control-label">Data do desligamento</label>
   <div class='input-group' >
    <input class="form-control txleft campodata" type="text" name="dt_desligamento" id="dt_desligamento" placeholder="Data do desligamento" required="" value="<?php echo $data2; ?>">
    <span class="input-group-addon">
      <span class="fa fa-calendar"></span>
    </span>
  </div>
</div>


<div class="fleft" style="width: 120px;">



	<?php if ($solicitacao->solicitacao_status==1) {  ?>
	<span id="encaminhar" class="btn btn-default acao" style="width: 100%;margin-bottom: 7px;" data-campo="solicitacao_status" data-valor="2">Encaminhar</span>
	<?php } ?>

<?php if ($solicitacao->solicitacao_status<=2) {  ?>
	<input type="submit" style="width: 100%;margin-bottom: 7px;" name="alterar_desligamento" value="Salvar" class="btn btn-primary">
	
<?php } ?>

<?php if ($solicitacao->solicitacao_status==2) {  ?>
	<span id="cancel" class="btn btn-default acao" style="width: 100%;margin-bottom: 7px;" data-campo="solicitacao_status" data-valor="1">Cancelar</span>
	<?php } ?>

	<span class="btn btn-danger" style="width: 100%;margin-bottom: 7px;" data-dismiss="modal">Sair</span>
               <!--<span id="aprovar" class="btn btn-default acao" style="width: 100%;margin-bottom: 7px;" data-campo="solicitacao_status" data-valor="3">Aprovar</span>

               <span id="rejeitar" class="btn btn-default acao" style="width: 100%;" data-campo="solicitacao_status" data-valor="4">Rejeitar</span>-->
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
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('.campodata').datepicker({
            format: 'dd/mm/yyyy'
        });
	});
</script>

