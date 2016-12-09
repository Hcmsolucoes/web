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
	<a href="<?php echo base_url().'home' ?>">
        <span class="fa fa-desktop"></span><span class="xn-text">Dashboard</span>
    </a>               
</li>    

<!-- menu meu perfil -->
<li class="<?php echo ($menupriativo=="perfil")? "active":"" ?>">
	<a href="<?php echo base_url().'perfil/pessoal' ?>">
        <span class="fa fa-user"></span> <span class="xn-text">Meu Perfil</span>
    </a>                  
</li> 


<!--  menu Mensagens e Lembretes -->
<li class="<?php echo ($menupriativo=="lembretes")? "active":"" ?>">
	<a href="<?php echo base_url().'perfil/lembretes' ?>">
        <span class="fa fa-bell-o"></span> <span class="xn-text">Mensagens e Lembretes</span>
    </a>                  
</li> 

<!--  menu holerith -->
<!--<li class="<?php echo ($menupriativo=="demonstrativo")? "active":"" ?>">
    <a href="<?php echo base_url().'perfil/contrato_demonstrativo' ?>">
        <span class="fa fa-money"></span> <span class="xn-text">Holerith</span>
    </a>
</li>-->

<!-- menu ponto a ponto -->
<?php if($modpont){?>
<li class="xn-openable <?php echo ($menupriativo=="ponto")? "active":"" ?>">
    <a href="#"><span class="fa fa-truck"></span> <span class="xn-text">Ponto a Ponto</span></a> 
	<ul>
        <li><a href="<?php echo base_url().'pontoaponto/verpremios'?>" title="consultar premios">
            <span class="fa fa-money"></span>
            <span class="xn-text">Consultar Prêmios</span></a>
        </li>
    </ul>                      
</li> 
<?php } ?>  

<!-- menu gestão do dia a dia -->
<li class="xn-openable <?php echo ($menupriativo=="painel")? "":"" ?>">
    <a href="#"><span class="fa fa-briefcase"></span> <span class="xn-text">Gestão do dia a dia</span></a>
	<ul>                                    
        <li><a href="#" title="Programação de Férias">
            <span class="fa fa-plane"></span>
            <span class="xn-text">Programação de Férias</span></a>
        </li>
		<!-- 
        <li><a href="<?php echo base_url().'perfil/lembretes'; ?>" title="Mensagens e Lembretes">
            <span class="fa fa-bell-o"></span>
            <span class="xn-text">Mensagens e Lembretes</span></a>
        </li>
        -->    
		<li><a href="#" title="Solicitações de Benefícios">
            <span class="fa fa-retweet"></span>
            <span class="xn-text">Solicitação Benefícios</span></a>
        </li>
    </ul>
</li> 

<!-- menu feedback -->
<li class="<?php echo ($menupriativo=="feedback")? "active":"" ?>">
    <a href="<?php echo base_url().'perfil/feedbacks' ?>">
        <span class="fa fa-comments-o"></span><span class="xn-text">Feedbacks</span>
    </a>  
</li> 

<!-- menu perfil público -->
<li class="<?php echo ($menupriativo=="publico")? "active":"" ?>">
    <a href="<?php echo base_url().'perfil/pessoal_publico/'.$iduser; ?>">
        <span class="fa fa-male"></span><span class="xn-text">Perfil Público</span>
    </a>                       
</li>
