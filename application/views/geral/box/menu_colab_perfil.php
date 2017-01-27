<?php 
$pess="";
$prof="" ;
$acd="" ; 
$intr="" ;
 $cntr="" ;
 $feed="" ;
$pub="" ;
$familiar ="";
switch($menu_colab_perfil){
	case "pessoal": $pess="active" ; break;
	case "profissional": $prof="active" ; break;
	case "academico": $acd="active" ; break;
	case "familiar": $familiar ="active";break;
	case "publico": $pub="active" ; break;
	
}



?>

<div id="page-nav">
		
		<ul class="nav nav-tabs">
		<?php if($menu_colab_perfil != 'publico'){ ?>
            <li class="<?php echo $pess; ?>"><a href="<?php echo base_url().'perfil/pessoal' ?>">Dados Pessoais</a></li>
            <li class="<?php echo $familiar; ?>"><a href="<?php echo base_url().'perfil/familiar' ?>">Ficha Familiar</a></li>
            <li class="<?php echo $prof; ?>"><a href="<?php echo base_url().'perfil/profissional' ?>">Perfil Profissional</a></li>
            <li class="<?php echo $acd; ?>"><a href="<?php echo base_url().'perfil/academico' ?>">Perfil Acadêmico</a></li>
			<!--<li class="<?php echo $intr; ?>"><a href="<?php echo base_url().'perfil/interessepessoal' ?>">Interesses Pessoais</a></li>-->
			
        <?php } ?>

		</ul>
				
	</div>