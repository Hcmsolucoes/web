<div id="page-content-wrapper" class="rm-transition">    

<?php  $this->load->view('/geral/box/menu_colab_perfil',$menu_colab_perfil); ?>
    
	<div id="page-content">
	  <div class="col-md-12">
		 <div class="content-box">
			<h3 class="content-box-header bg-primary">Dependentes
			 <!--<div class="header-buttons-separator">
                    <a href="#" id="editdados" class="icon-separator"><i class="glyph-icon icon-plus"></i>
                    </a>
                 </div>-->
             </h3>


          <div class="content-box-wrapper">

          		<div class="list-group">
       <?php foreach ($dependentes as $key => $value) {  

$sexo = ($value->TipSex=="M")? "Masculino" : "Feminino" ;
$nascido = ($value->TipSex=="M")? "nascido" : "nascida" ;
$datanasc = new DateTime( $value->nascimento ); // data de nascimento
$idade = $datanasc->diff( new DateTime() ); // data definida
$foto = ($value->depfoto=="")? "http://www.eletropecaskalunga.com.br/img/album/4c2c1e3d0f5caf0a53b53822b7c7c103.jpg" : $value->depfoto ;
       	?>       
  					<a href="#" class="list-group-item">
  					<div class="txleft" >
  					  <img class=" imgcirculo_p" style="margin: 25px 10px 0px 0px" src="<?php echo $foto; ?>">
  					</div>

  					<div class="txleft font-sub" >
    					<h3 class="bold"><?php echo $value->dep_nome; ?></h3>
    					<span class=""><?php echo $value->descricao." - "; ?></span>
              <span class="">sexo <?php echo $sexo.","; ?></span>
    					<span class=""><?php echo $value->estadocivil.","; ?></span>
    					<span class=""><?php echo $nascido." em ". $this->Log->alteradata1($value->nascimento).$idade->format( ' (%Y anos), ' ); ?></span>

    					<div class="clearfix"></div>

    					<span class=""><?php echo $value->escolaridade; ?></span>

    					<div class="clearfix"></div>
    					
    					<span class="">Cálculos inclusos: </span>
    	<?php if ($value->depirf=="S") { ?><span class=" colorprimary">IRF, </span><?php } ?>

    	<?php if ($value->depsal=="S") { ?><span class=" colorprimary">Salário </span><?php } ?>
    					<div class="clearfix"></div>

    					<span class="">Deficiência: <?php echo $value->deficiencia; ?></span>
    				 </div><div class="clearfix"></div>

  					 </a>
		<?php }  ?>
				 </div>


           </div>


		 </div>
		</div>
	 </div>





 </div>