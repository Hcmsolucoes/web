<div class="fleft-6"><?php 
	$avatar = ( $colaborador->fun_sexo==1 )?"avatar1":"avatar2";
    $foto = (empty($colaborador->fun_foto) )? base_url("img/".$avatar.".jpg") : $colaborador->fun_foto;
    $situacao = ($colaborador->fun_status=="A")? "Ativo" : "Inativo";
?>

    <img class="fleft" src="<?php echo $foto; ?>" style="margin: 0px 10px 0px 0px;border: 3px solid #ccc;max-width: 90px;border-radius: 20%;">
    
    <span class="fleft font-sub bold"><?php echo $colaborador->fun_nome; ?></span>
    <br>
    <span class="fleft bold">Matricula:</span>&nbsp;<span><?php echo $colaborador->fun_matricula; ?></span>
    <br />
    <span class="fleft bold">Admiss�o:</span>&nbsp;<span><?php echo $this->Log->alteradata1($colaborador->contr_data_admissao); ?></span>
    <br />
    <span class="fleft bold">Cargo:</span>&nbsp;<span><?php echo $colaborador->contr_cargo; ?></span>
    <br />
    <span class="fleft bold">Departamento:</span>&nbsp;<span><?php echo $colaborador->contr_departamento; ?></span>
    <br />
    <span class="fleft bold">Salario Atual:</span>&nbsp;R$<span><?php echo number_format($colaborador->sal_valor, 2, ".", ","); ?></span>
    <br />
    <span class="fleft bold">Situa��o Atual:</span>&nbsp;<span><?php echo $situacao; ?></span>
    <input type="hidden" name="" id="<?php echo $opt; ?>" value="<?php echo $colaborador->sal_valor; ?>" >
    </div>


