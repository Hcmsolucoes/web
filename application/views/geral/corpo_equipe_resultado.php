
<?php 

$starray[0]="online";
$starray[1]="offline";
$starray[2]="away";

foreach ($dadoschefe as $key => $value) { 
  $admissao = $this->Log->alteradata1($value->contr_data_admissao); 
  $nome = $value->fun_nome; 
  $cargo = $value->fun_cargo;
  $matricula = $value -> fun_matricula;
  $email = $value-> fun_email;
        $endereco1 = $value->end_rua.", ".$value->end_numero. " ".$value->end_complemento ;
        $endereco2 = "Bairro: ". $value->bair_nomebairro." - ".$value->cid_nomecidade. " / ".$value->est_nomeestado  ;
        $cep = $value->end_cep;
  $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
  $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
  $id = $value->fun_idfuncionario;
?>
<div class="row">
   <div class="col-md-3">
     <div class="panel panel-default">
        <div class="panel-body profile">
            <div class="profile-image">
                <img src="<?php echo $foto; ?>" alt=""/>
           
            </div>
            <div class="profile-data">
                <div class="profile-data-name"><?php echo $nome; ?></div>
                <div class="profile-data-title"><?php echo $cargo; ?></div>
            </div>
            <div class="profile-controls">
                <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$id); ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                <a href="#" class="profile-control-right"><span class="fa fa-phone"></span></a>
            </div>
        </div>                                
        <div class="panel-body">                                    
            <div class="contact-info">
                <p><small>Telefone</small><br/>(+55) 5555-4465</p>
                <p><small>Email</small><br/><?php echo $email; ?></p>
                <p><small>Endereço</small><br/><?php echo $endereco1 ; ?></p>
                <p><?php echo $endereco2 ; ?></p> 
                <p><small>CEP</small><br/><?php echo $cep ; ?></p>                                   
            </div>
        </div>                                
     </div>
   </div>

<!--
<div class="col-md-4 btn-default list-group-item" style="height: 130px;">
  <img src="<?php echo $value->fun_foto; ?>" class="imgcirculo_m fleft" style="margin: 0px 5px 0px 0px;" >
  <span class="font-sub bold corsec"><?php echo $value->fun_nome; ?></span><br>
  <span class="bold">Matricula: </span><span class="font-sub "><?php echo $value->fun_matricula; ?></span><br> 
  <span class="bold ">Admissão: </span><span class="font-sub "><?php echo $admissao; ?></span><br>
  <span class="bold ">Cargo: </span><span class="font-sub "><?php echo $value->fun_cargo; ?></span><br> 
  <span class="bold ">Departamento: </span><span class="font-sub "><?php echo $value->contr_departamento; ?></span> 


<div id="voltar" class="fright" style="font-size: 25px; cursor: pointer;">
  <i class="fa fa-arrow-left" aria-hidden="true"></i>
</div>

</div>-->
<?php } ?>

<div class="col-md-8">
<div class="widget widget-default" >

<h3 class="fleft" style="width: 90%;">Liderados por <?php echo $nome; ?>
  <div id="voltar" class="fright" style="font-size: 25px; cursor: pointer;">
  <i class="fa fa-arrow-left" aria-hidden="true"></i>
</div>
</h3>

<div class="separador"></div>

<?php foreach ($subordinados as $key => $value) {
  $admissao = $this->Log->alteradata1($value->contr_data_admissao); ?>
  
<div class="col-md-6 btn-default list-group-item" style="height: 120px;">
  <img src="<?php echo $value->fun_foto; ?>" class="imgcirculo_m fleft" style="margin: 0px 5px 0px 0px;" >
  <span class="font-sub bold "><?php echo $value->fun_nome; ?></span><br>
  <span class="bold ">Matricula: </span><span class="font-sub "><?php echo $value->fun_matricula; ?></span><br> 
  <span class="bold ">Admissão: </span><span class="font-sub "><?php echo $admissao; ?></span><br>
  <span class="bold ">Cargo: </span><span class="font-sub "><?php echo $value->fun_cargo; ?></span><br> 
  <span class="bold ">Departamento: </span><span class="font-sub "><?php echo $value->contr_departamento; ?></span> 
</div>

<?php } ?>
</div>

</div>
</div><div class="clearfix"></div>
<script type="text/javascript">
$("#voltar").on("click", function(){
  
  location.reload();
  
});
</script>