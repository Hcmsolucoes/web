<?php // ver se tem o modulo ponto a ponto

$modulos = explode(",", $this->session->userdata('modulos'));

?>

<!-- menu dashboard -->
<li class="<?php echo ($menupriativo=="painel")? "active":"" ?>" >
  <a href="<?php echo base_url().'gestor' ?>">
    <span class="fa fa-desktop"></span><span class="xn-text">Dashboard</span>
  </a>               
</li>    
    
<?php if( in_array("pontoaponto", $modulos) ){?>
<!-- menu ponto a ponto -->
<li class="xn-openable <?php echo ($menupriativo=="ponto")? "active":"" ?>">
  <a href="#"><span class="fa fa-truck"></span>
      <span class="xn-text">Ponto a Ponto</span>
  </a>
    <ul>
        <li><a href="<?php echo base_url().'pontoaponto/parametros' ?>">
            <span class="fa fa-cogs"></span>
            <span class="xn-text">Par�metros</span></a>
        </li>
        <li><a href="<?php echo base_url().'pontoaponto/equipamentos_cad' ?>">
            <span class="fa fa-flag"></span>
            <span class="xn-text">Equipamentos</span></a>
        </li>
        <li><a href="<?php echo base_url().'pontoaponto/lancamentos_feito' ?>">
            <span class="fa fa-check-square-o"></span>
            <span class="xn-text">Lan�amentos</span></a>
        </li>
    </ul>
</li>
<?php } ?>    

<li class="<?php echo ($menupriativo=="minhaequipe")? "active":"" ?>">
<a href="<?php echo base_url().'gestor/equipe'; ?>">
  <span class="fa fa-group"></span>
  <span class="xn-text">Minha Equipe</span></a>
</li>

<li class="<?php echo ($menupriativo=="solicitacoes")? "active":"" ?>">
<a href="<?php echo base_url().'gestor/solicitacoes'; ?>">
  <span class="fa fa-retweet"></span>
  <span class="xn-text">Solicita��es</span></a>
</li>
	
<li class="<?php echo ($menupriativo=="aprovacoes")? "active":"" ?>">
<a href="<?php echo base_url().'gestor/aprovacoes'; ?>">
  <span class="fa fa-thumbs-o-up"></span>
  <span class="xn-text">Aprova��es</span></a>
</li>
	
<!-- menu minha equipe    
<li class="xn-openable "><a href="#"><span class="fa fa-bar-chart-o"></span>
    <span class="xn-text">Gest�o da Equipe</span></a>
  <ul>
    <li><a href="<?php echo base_url().'gestor/equipe'; ?>">
        <span class="fa fa-group"></span>
        <span class="xn-text">Minha Equipe</span></a>
    </li>
    <li><a href="#">
        <span class="fa fa-bar-chart-o"></span>
        <span class="xn-text">Avalia��o Desempenho</span></a>
    </li>
    <li><a href="<?php echo base_url().'gestor/solicitacoes'; ?>">
        <span class="fa fa-retweet"></span>
        <span class="xn-text">Solicita��es</span></a>
    </li>
    <li>
      <a href="#">
        <span class="fa fa-thumbs-o-up"></span>
        <span class="xn-text">Aprova��es</span></a>
    </li>
  </ul>
</li>
--> 
		
		
		