<?php
    $opts = "";
    foreach ($tipodecalculo as $value) {
	$data = $value->tipo_mesref;
    $data = explode("-", $data);    
    list($ano, $mes, $dia ) = $data;  
    $opts .= "<option value='".$value->tipo_idtipodecalculo."'>".$mes.'/'.$ano."</option>";
    }


 ?>

<div class="content-frame-top">                        
<div class="page-title">                    
    <h2><span class="fa fa-bar-chart-o"></span> Espelho do Ponto</h2>
</div>                                      
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Use a pesquisa para localizar seu espelho do ponto</p>
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search" id="lupa"></span>
                                </div>
                                    <select id="calcespelho" name="calcespelho" class="form-control cinza">
                                      <option>Selecione a competência</option>
                                          <?php echo $opts; ?>
                                    </select>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" id="espelhopesquisar">Pesquisar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>                                    
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="espelhoresult"></div>
    </div>
</div>
<!--
<div class="row" style=" font-size: 13px; margin-bottom: 20px">
    <div class="col-md-12">
        <div class="widget widget-default">
      

        </div>
      <div class="clearfix"></div>
      <div id="resulcomp"></div>
    </div>
    
</div>-->