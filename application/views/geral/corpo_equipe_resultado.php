
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

  $opts = "";
  foreach ($tipodecalculo as $value) {
    $data = $value->tipo_mesref;
    $data = explode("-", $data);    
    list($ano, $mes, $dia ) = $data;  
    $opts .= "<option value='".$value->tipo_idtipodecalculo."'>".$mes.'/'.$ano."</option>";
  }

?>
<div class="row">
<div class="fleft-3" id="basic_perfil">
   <div class="fleft">
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
                <!--<p><small>Telefone</small><br/>(+55) 5555-4465</p>-->
                <p><small>Email</small><br/><?php echo $email; ?></p>
                <!--<p><small>Endere�o</small><br/><?php echo $endereco1 ; ?></p>
                <p><?php echo $endereco2 ; ?></p> 
                <p><small>CEP</small><br/><?php echo $cep ; ?></p>-->                                
            </div>
        </div>                                
     </div>
   </div>
<?php if (!empty($parametros)) {
                    if($parametros->ic_gestorponto == 1){ ?>
   <div class="fleft">
     <div class="panel panel-default">
       <div class="panel-body">
                <p>Use a pesquisa para localizar o espelho do ponto</p>
                <form id="formespelho" class="form-horizontal" method="post" action="<?php echo base_url('perfil/soap') ?>">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search" id="lupa"></span>
                                </div>
                                    <select id="calcespelho" name="calcespelho" class="form-control cinza">
                                      <option>Selecione a compet�ncia</option>
                                          <?php echo $opts; ?>
                                    </select>
                                <div class="input-group-btn">
                                 <input type="submit" class="btn btn-primary" id="espelhopesquisar" value="Pesquisar" />
                                </div>
                            </div>
                            <img id="loadespelho" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Pesquisando...">
                            <span class="btn btn-default" id="esconder" style="display: none;">Mostrar/Esconder espelho do ponto</span>

                        </div>
                    </div>
                </form>                                    
            </div>
     </div>
   </div>
   <?php } } ?>
   
</div>

<div id="espelhoresult" class="fleft-7"></div>
<!--
<div class="col-md-4 btn-default list-group-item" style="height: 130px;">
  <img src="<?php echo $value->fun_foto; ?>" class="imgcirculo_m fleft" style="margin: 0px 5px 0px 0px;" >
  <span class="font-sub bold corsec"><?php echo $value->fun_nome; ?></span><br>
  <span class="bold">Matricula: </span><span class="font-sub "><?php echo $value->fun_matricula; ?></span><br> 
  <span class="bold ">Admiss�o: </span><span class="font-sub "><?php echo $admissao; ?></span><br>
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
  <span class="bold ">Admiss�o: </span><span class="font-sub "><?php echo $admissao; ?></span><br>
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


$( "#formespelho" ).on("submit", function(e) {
        e.preventDefault();

       $("#loadespelho").fadeIn("slow");

        $("#espelhopesquisar").prop("disabled", true);
       
        $.ajax({           
            type: "POST",
            url: '<?php echo base_url("perfil/soap"); ?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data: $( this ).serialize(),            
            success: function(msg) 
            {
                $("#espelhopesquisar").prop("disabled", false);
                $("#espelhoresult").html(msg);
                $("#loadespelho").fadeOut("slow");
                $("#esconder").fadeIn("slow");
            } 
        });
           

 });

$("#esconder").click(function(){
  $("#espelhoresult").toggle("slow");
});
</script>