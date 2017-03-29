<?php // ver se tem o modulo ponto a ponto
$modulos = explode(",", $this->session->userdata('modulos'));
$modpont = false;
foreach ($modulos as $value) {
	if($value == 1){
		$modpont = true; 
	}
}
$iduser = $this->session->userdata('id_funcionario');  
?>	

 <!-- menu dashboard -->
<li class="<?php echo ($menupriativo=="painel")? "active":"" ?>" >
	<a href="<?php echo base_url('home') ?>">
        <span class="fa fa-desktop"></span><span class="xn-text">Dashboard</span>
    </a>               
</li>    

<!-- menu meu perfil -->
<li class="<?php echo ($menupriativo=="perfil")? "active":"" ?>">
	<a href="<?php echo base_url('perfil/pessoal') ?>">
        <span class="fa fa-user"></span> <span class="xn-text">Meu Perfil</span>
    </a>                  
</li> 


<!--  menu Mensagens e Lembretes -->
<li class="<?php echo ($menupriativo=="lembretes")? "active":"" ?>">
	<a href="<?php echo base_url('perfil/lembretes') ?>">
        <span class="fa fa-calendar"></span> <span class="xn-text">Calend�rio</span>
    </a>                  
</li>

<li class="<?php echo ($menupriativo=="mensagem")? "active":"" ?>">
    <a href="<?php echo base_url('perfil/mensagem') ?>">
        <span class="fa fa-comments"></span> <span class="xn-text">Mensagens</span>
    </a>                  
</li>

<!-- menu ponto a ponto -->
<?php if($modpont){?>
<li class="xn-openable <?php echo ($menupriativo=="ponto")? "active":"" ?>">
    <a href="#"><span class="fa fa-truck"></span> <span class="xn-text">Ponto a Ponto</span></a> 
	<ul>
        <li><a href="<?php echo base_url('pontoaponto/verpremios')?>">
            <span class="fa fa-money"></span>
            <span class="xn-text">Consultar Pr�mios</span></a>
        </li>
    </ul>                      
</li> 
<?php } ?>  

<!-- menu gest�o do dia a dia -->
<li class="xn-openable <?php echo ($menupriativo=="gestao")? "active":"" ?>">
    <a href="#"><span class="fa fa-briefcase"></span> <span class="xn-text">Gest�o do dia a dia</span></a>
	<ul><?php if (!empty($parametros)) { 
                if($parametros->solicitarferias == 1){ ?>                              
        <li><a href="<?php echo base_url('home/programacao_ferias')?>">
            <span class="fa fa-plane"></span>
            <span class="xn-text">Programa��o de F�rias</span></a>
        </li>
		<?php } } ?>
		<li><a href="#">
            <span class="fa fa-retweet"></span>
            <span class="xn-text">Tarefas</span></a>
        </li>
    </ul>
</li> 

<!-- menu feedback -->
<li class="<?php echo ($menupriativo=="feedback")? "active":"" ?>">
    <a href="<?php echo base_url('perfil/feedbacks') ?>">
        <span class="fa fa-comments-o"></span><span class="xn-text">Feedbacks</span>
    </a>  
</li> 

<!-- menu perfil p�blico -->
<li class="<?php echo ($menupriativo=="publico")? "active":"" ?>">
    <a href="<?php echo base_url('perfil/pessoal_publico/'.$iduser); ?>">
        <span class="fa fa-male"></span><span class="xn-text">Perfil P�blico</span>
    </a>                       
</li>
