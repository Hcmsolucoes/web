<?php // ver se tem o modulo ponto a ponto
$modulos = explode(",", $this->session->userdata('modulos'));
$modpont = false;
foreach ($modulos as $value) {
  if($value == 1){
   $modpont = true; 
 }
}
?>        

<!-- menu dashboard -->
<li class="<?php echo ($menupriativo=="painel")? "active":"" ?>" >
  <a href="<?php echo base_url().'gestor' ?>" title="Dashboard Gestão">
    <span class="fa fa-desktop"></span><span class="xn-text">Dashboard</span>
  </a>               
</li>    
    
<?php if($modpont){?>
<!-- menu ponto a ponto -->
<li class="xn-openable <?php echo ($menupriativo=="ponto")? "active":"" ?>">
  <a href="#" title = "Ponto a Ponto"><span class="fa fa-truck"></span>
      <span class="xn-text">Ponto a Ponto</span>
  </a>
    <ul>
        <li><a href="<?php echo base_url().'pontoaponto/parametros' ?>" title="Parâmetros do Ponto a Ponto">
            <span class="fa fa-cogs"></span>
            <span class="xn-text">Parâmetros</span></a>
        </li>
        <li><a href="<?php echo base_url().'pontoaponto/equipamentos_cad' ?>" title="Equipamentos do Ponto a Ponto">
            <span class="fa fa-flag"></span>
            <span class="xn-text">Equipamentos</span></a>
        </li>
        <li><a href="<?php echo base_url().'pontoaponto/lancamentos_feito' ?>" title="Efetuar Lançamentos">
            <span class="fa fa-check-square-o"></span>
            <span class="xn-text">Lançamentos</span></a>
        </li>
    </ul>
</li>
<?php } ?>    

<!-- menu minha equipe -->    
<li class="xn-openable "><a href="#" title="Gestão da Equipe"><span class="fa fa-bar-chart-o"></span>
    <span class="xn-text">Gestão da Equipe</span></a>
  <ul>
    <li><a href="<?php echo base_url().'gestor/equipe' ?>" title="Minha Equipe">
        <span class="fa fa-group"></span>
        <span class="xn-text">Minha Equipe</span></a>
    </li>
    <li><a href="#" title="Avaliação Desempenho">
        <span class="fa fa-bar-chart-o"></span>
        <span class="xn-text">Avaliação Desempenho</span></a>
    </li>
    <li><a href="#" title="Solicitações">
        <span class="fa fa-retweet"></span>
        <span class="xn-text">Solicitações</span></a>
    </li>
    <li>
      <a href="#" title="Aprovações">
        <span class="fa fa-thumbs-o-up"></span>
        <span class="xn-text">Aprovações</span></a>
    </li>
  </ul>
</li>