
<div class="panel-body list-group list-group-contacts"> 

<?php 
if ($campo=="departamento") {

foreach ($lista as $key => $value) { ?>
                               
    <div class="list-group-item itemdep fleft" data-nome="<?php echo $value->descricao; ?>" id="<?php echo $value->iddpto; ?>" style="line-height: 45px;width: 100%;cursor: pointer;">                                    
        <span class="contacts-title"><?php echo $value->descricao; ?></span>
    </div>
    <div class="clearfix"></div>

<?php } ?>



<?php }elseif ($campo=="colab") {

    foreach ($lista as $key => $value) {

        $prinome = explode(" ", $value->fun_nome);
        $avatar = ( strcasecmp($value->fun_sexo, "masculino")==0 )?"avatar1":"avatar2";
        $foto = ($value->fun_foto=="")? "http://hcmsolucoes.com.br/people/img/".$avatar.".jpg" : $value->fun_foto;

    ?>
                               
    <div class="list-group-item itemcolab fleft" data-nome="<?php echo $prinome[0]; ?>" id="<?php echo $value->fun_idfuncionario; ?>" data-foto="<?php echo $foto; ?>" style="line-height: 45px;width: 100%;cursor: pointer;">                                    
        <img src="<?php echo $value->fun_foto; ?>" class="pull-left" />
        <p class="contacts-title"><?php echo $value->fun_nome; ?></p>
    </div>

<?php } ?>
<?php } ?>

</div>
