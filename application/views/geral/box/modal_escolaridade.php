

<h3 style="margin-bottom: 10px;" class="acenter"><?php echo $titulo; ?></h3>

<?php 

foreach ($pessoas as $key => $value) {
	//echo $value->fun_nome;

	$avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
    $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
  ?>
   <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$value->fun_idfuncionario); ?>">
   	
   	<div class="fleft-1 acenter">
            <img src="<?php echo $foto; ?>" alt="" class="imgcirculo_m">
            <span class="font-sub"><?php echo $value->fun_nome; ?></span>
          </div>

   </a> 



<?php } ?>