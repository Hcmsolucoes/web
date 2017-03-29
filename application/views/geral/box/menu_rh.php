<?php // ver se tem o modulo ponto a ponto


?>

<!-- menu dashboard -->
<li class="<?php echo ($menupriativo=="painel")? "active":"" ?>" >
  <a href="<?php echo base_url('rh') ?>">
    <span class="fa fa-desktop"></span><span class="xn-text">Dashboard</span>
  </a>               
</li>

<!-- menu ponto a ponto -->
<li class="xn-openable <?php echo ($menupriativo=="ponto")? "active":"" ?>">
  <a href="#"><span class="fa fa-database"></span>
      <span class="xn-text">Gest�o de Dados</span>
  </a>
    <ul>
        <li><a href="<?php echo base_url('rh/') ?>">
            <span class="fa fa-upload"></span>
            <span class="xn-text">Importar Dados</span></a>
        </li>
        <li><a href="<?php echo base_url('rh/') ?>">
            <span class="fa fa-download"></span>
            <span class="xn-text">Exportar Dados</span></a>
        </li>
    </ul>
</li>
  

<li class="xn-openable <?php echo ($menupriativo=="tabela")? "active":"" ?>">
  <a href="<?php echo base_url('rh/') ?>">
    <span class="fa fa-table"></span>
    <span class="xn-text">Cadastro de Tabelas</span></a>

     <ul>
        <li><a href="<?php echo base_url('rh/eventos') ?>">
            <span class="fa fa-money"></span>
            <span class="xn-text">Eventos</span></a>
        </li>
        <li><a href="<?php echo base_url('rh/cursos') ?>">
            <span class="fa fa-book"></span>
            <span class="xn-text">Cursos</span></a>
        </li>
    </ul>
  </li>

<li class="<?php echo ($menupriativo=="solicitacoes")? "active":"" ?>">
<a href="<?php echo base_url('rh/'); ?>">
  <span class="fa fa-retweet"></span>
  <span class="xn-text">Solicita��es</span></a>
</li>

<li class="<?php echo ($menupriativo=="minhaequipe")? "active":"" ?>">
<a href="<?php echo base_url('rh/'); ?>">
  <span class="fa fa-thumbs-o-up"></span>
  <span class="xn-text">Aprova��es</span></a>
</li>

<li class="<?php echo ($menupriativo=="lembretes")? "active":"" ?>">
    <a href="<?php echo base_url('rh/mensagens') ?>">
        <span class="fa fa-comments-o"></span> <span class="xn-text">Mensagens</span>
    </a>                  
</li>