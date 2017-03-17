<?php

$idparam = "";
$ckind="";
$cklocal="";
$ckf0 = "";
$ckf1 = "";
$ckf2 = "";
$aprh ="";
$apdir ="";

if (!empty($parametros)) {
   

($parametros->Param_chefia==1) ? $cklocal="checked" : $ckind="checked";

switch ($parametros->Param_feed) {
        case '0':$ckf0="checked"; break;
        case '1':$ckf1="checked"; break;
        case '2':$ckf2="checked"; break;        
    }

}


?>

<div class="row">
    <div class="col-md-12">
        <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>
        
<ul class="nav nav-tabs" role="tablist" style="padding: 0px;" >
  <li class="active"><a href="#gerais" aria-controls="gerais" role="tab" data-toggle="tab">Par�metros Gerais</a></li>
  <li ><a href="#funciona" aria-controls="funciona" role="tab" data-toggle="tab">Controle Funcionalidades</a></li>
  <li ><a href="#relat" aria-controls="relat" role="tab" data-toggle="tab">Relat�rios</a></li>
  <li ><a href="#aprov" aria-controls="aprov" role="tab" data-toggle="tab">Aprovadores</a></li>
</ul>        

   
<div class="tab-content">
        
<div role="tabpanel" class="tab-pane active" id="gerais">
  <div class="row" >
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-2">
                <span class="bold">Rotina Chefia: </span>
            </div>
            <div class="col-md-2">
                <input type="radio" name="Param_chefia"  class="rdchefia" value="0" <?php echo $ckind; ?> />
                <span>Chefia Individual</span>
            </div>
            <div class="col-md-2">
                <input type="radio" name="Param_chefia"  class="rdchefia" value="1" <?php echo $cklocal; ?> />
                <span>Chefia por local</span>
            </div>
        </div><!--Painel da chefia -->

      
        <div class="panel panel-default" style="padding: 7px 0px;margin-bottom: 1px">
            <div class="col-md-2">
                <span class="bold">Feedbacks: </span>
            </div>
            <div class="col-md-2">
                <input type="radio"  name="Param_feed" value="0" class="rdchefia" <?php echo $ckf0; ?> />
                <span>Somente gestores</span>
            </div>
            <div class="col-md-2">
                <input type="radio"  name="Param_feed" value="1" class="rdchefia" <?php echo $ckf1; ?> />
                <span>Colaboradores Local</span>
            </div>
            <div class="col-md-2">
                <input type="radio" name="Param_feed" value="2" class="rdchefia" <?php echo $ckf2; ?> />
                <span>Todos</span>
            </div>
        </div><!--Painel de Feedbacks -->


        <!--<div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Aprovador Solicita��es RH: </span>
            </div>
            <div class="col-md-2">
            <select name="fun_id_aprovadorRH" id="rh" class="rdchefia">
                <option value="">Selecione</option>
                <?php foreach ($gestores as $key => $value) { 
                $selected = ($parametros->fun_id_aprovadorRH == $value->fun_idfuncionario)?"selected" : "" ; ?>
                <option value="<?php echo $value->fun_idfuncionario; ?>" <?php echo $selected; ?> ><?php echo $value->fun_nome; ?></option>
            <?php } ?>
            </select>
            </div>
        </div>Painel Aprovador RH -->      
      

        <!--<div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Aprovador Solicita��es Dire��o: </span>
            </div>
            <div class="col-md-2">
                <select name="fun_id_aprovador_Direcao" id="direcao" class="rdchefia" >
                <option value="">Selecione</option>
                <?php foreach ($gestores as $key => $value) { 
                $selected = ($parametros->fun_id_aprovador_Direcao == $value->fun_idfuncionario)?"selected" : "" ; ?>
                    <option value="<?php echo $value->fun_idfuncionario; ?>" <?php echo $selected; ?> ><?php echo $value->fun_nome; ?></option>
                <?php } ?>
                </select>
            </div>
        </div>Painel Aprovador Diretor -->
      
      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Colaborador Solicitar F�rias: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="solicitarferias" type="checkbox" class="check" <?php 
                    if (!empty($parametros)) {
                    echo ($parametros->solicitarferias == 1)?"checked" : "" ; 
                    } ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Colaborador Solicitar F�rias -->

       
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Gestor Solicitar F�rias Equipe:</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="feriasequipe" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->feriasequipe == 1)?"checked" : "" ; 
                    }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--F�rias Equipe Gestor -->     
      
      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px;">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">F�rias Necessita Aprova��o RH: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_ferias" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_ferias == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Aprova��o RH -->           

      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Disponibilizar Op��o Abonar F�rias: </span>
            </div>
            
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="abonar_ferias" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->abonar_ferias == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Abonar F�rias -->

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Colaborador visualiza cart�o de ponto: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_visualizarponto" type="checkbox" class="check" <?php 
                    if (!empty($parametros)) {
                    echo ($parametros->ic_visualizarponto == 1)?"checked" : "" ; 
                    } ?> />
                    <span></span>
                </label>
            </div>
        </div> 

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Gestor emite cart�o de ponto: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_gestorponto" type="checkbox" class="check" <?php 
                    if (!empty($parametros)) {
                    echo ($parametros->ic_gestorponto == 1)?"checked" : "" ; 
                    } ?> />
                    <span></span>
                </label>
            </div>
        </div>
      
      
      
  </div>
</div> 

<div role="tabpanel" class="tab-pane" id="funciona">
    <div class="row" >        
  
        
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3">
                <span class="bold">Funcionalidade</span>
            </div>
            <div class="col-md-2">
                <span class="bold">Dispon�vel</span>
            </div>
            <div class="col-md-2">
                <span class="bold">Aprova��o RH</span>
            </div>
        </div><!--Painel da chefia -->

        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Dados Pessoais</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_dadospessoais" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_dadospessoais == 1)?"checked" : "" ; 
                        }
                        ?> class="check"  />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_dadopessoais" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_dadopessoais == 1)?"checked" : "" ; 
                        }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Dados Pessoais -->            
        

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Documentos</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_documentos" class="check" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_documentos == 1)?"checked" : "" ; 
                        }
                        ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_documentos" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_documentos == 1)?"checked" : "" ; 
                        }?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Documentos -->            
        

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Endere�os</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_endereco" class="check" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_endereco == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_endereco" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_endereco == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Endere�os -->            
        
        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Contatos Pessoais</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_contatos" class="check" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_contatos == 1)?"checked" : "" ; 
                        }?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_contatos" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_contatos == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Contatos Pessoais -->            
        
        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Ficha Familiar</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_fichafamiliar" class="check" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_fichafamiliar == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_familiar" <?php if (!empty($parametros)) {
                        echo ($parametros->aprovar_familiar == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Ficha Familiar -->          
    
        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Contatos Telef�nicos</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_telefones" class="check" type="checkbox" <?php if (!empty($parametros)) {
                        echo ($parametros->ic_telefones == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Contatos Telef�nicos -->             
        
            
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Perfil Profissional</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_perfilprofissional" class="check" type="checkbox" <?php if (!empty($parametros)) {
                        echo ($parametros->ic_perfilprofissional == 1)?"checked" : "" ;
                        } ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Experi�ncia Profissional -->               
        
            
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Forma��o Acad�mica</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_academico" class="check" type="checkbox" <?php if (!empty($parametros)) {
                        echo ($parametros->ic_academico == 1)?"checked" : "" ;}
                         ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Forma��o Acad�mica -->                
            
    </div>
</div>

<div role="tabpanel" class="tab-pane" id="relat">
    <div class="row" >
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">URL Webservice</label>
            </div>
            <div class="col-md-5">
            <div class="input-group">                
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->endwsdl;} ?>" id="endwsdl" name="endwsdl" placeholder="Digite a URL...">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="endwsdl" type="button">ok</button>
                </span>
            </div>
            </div>
                
        </div><!--url-->

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px;">
                <label class="control-label">Usu�rio</label>
            </div>
            <div class="col-md-2">
            <div class="input-group"> 
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->userwsdl;} ?>" id="userwsdl" name="userwsdl" placeholder="Login do webservice">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="userwsdl" type="button">ok</button>
                </span>
                </div>
            </div>
                
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px;">
                <label class="control-label">Senha</label>
            </div>
            <div class="col-md-2">
            <div class="input-group"> 
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->senhawsdl;} ?>" id="senhawsdl" name="senhawsdl" placeholder="Senha do webservice">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="senhawsdl" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Nome do Ponto</label>
            </div>
            <div class="col-md-2">
            <div class="input-group"> 
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->relponto;} ?>" id="relponto" name="relponto" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="relponto" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Entrada do Ponto</label>
            </div>
            <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->entradaponto;} ?>" id="entradaponto" name="entradaponto" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="entradaponto" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Nome do Holerite</label>
            </div>
            <div class="col-md-2">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->relholeri;} ?>" id="relholeri" name="relholeri" placeholder="" >
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="relholeri" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Entrada do Holerite</label>
            </div>
            <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->entradaholerite;} ?>" id="entradaholerite" name="entradaholerite" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="entradaholerite" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Nome do Informe</label>
            </div>
            <div class="col-md-2">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->relinforme;} ?>" id="relinforme" name="relinforme" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="relinforme" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Entrada do Informe</label>
            </div>
            <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->entradainformes;} ?>" id="entradainformes" name="entradainformes" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="entradainformes" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>

        

    </div><!--row-->
</div> <!-- fim tab relatorios-->  

<div role="tabpanel" class="tab-pane" id="aprov">
  <div class="row" >
    <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <span class="bold">Solicita��o: </span>
            </div>
           <div class="col-md-2">
            <select name="tipo_solicitacao" id="tipo_solicitacao" class="">
                <option value="">Selecione</option>
                <?php foreach ($tipo_solicitacoes as $key => $value) { ?>
                
                <option value="<?php echo $value->id_tipo_solicitacao; ?>"><?php echo $value->descricao_solicitacao; ?></option>

                <?php } ?>
            </select>
            </div>
            <div class="fleft-2">
                <div class="autocomplete" >
                  <input type="text" id="busca_colab" data-campo="colab" data-classe="itemcolab" data-div="lista" class="autocompletar form-control" placeholder="" style="background: transparent;border: none;width: 35px;"/>
                  <div id="lista"></div>
              </div>
              <div id="selecionados"></div>
          </div>
          <div class="fleft-1">
          <button id="salvar_solicitacao" class="btn btn-primary">Salvar</button>
          </div>

<div class="clearfix" style="margin-bottom: 10px;"></div>

<div class="fleft-1">
    <span class="bold" style="padding: 7px;">Aprovadores: </span>
</div>
<div class="fleft-4" id="aprovadores"></div><img id="loadap" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading..." style="display: none;" >
</div><!--Painel desligamento -->


     <!--<div class="panel panel-default" style="padding: 7px 0px ;margin-bottom: 1px">
            <div class="fleft-2" style="padding: 7px;">
                <span class="bold">Aumento de Quadro</span>
            </div>
            
            <div class="fleft-2">
                <div class="autocomplete" >
                  <input type="text" id="busca_colab" data-campo="colab" data-classe="itemcolab" data-div="lista_aum" class="autocompletar form-control" placeholder="" style="background: transparent;"/>
                  <div id="lista_aum"></div>
              </div>
              <div id="selecionados"></div>
          </div>
            <div class="fleft-1">
              <button class="btn btn-default">Salvar</button>
            </div>
     </div>Painel Quadro -->
     <!--<div class="panel panel-default" style="padding: 7px 0px ;margin-bottom: 1px">
            <div class="fleft-2" style="padding: 7px;">
                <span class="bold">Altera��o Salarial</span>
            </div>
            
            <div class="fleft-2">
                <div class="autocomplete" >
                  <input type="text" id="busca_colab" data-campo="colab" data-classe="itemcolab" data-div="lista_alt" class="autocompletar form-control" placeholder="" style="background: transparent;"/>
                  <div id="lista_alt"></div>
              </div>
              <div id="selecionados"></div>
          </div>
          <div class="fleft-1">
              <button class="btn btn-default">Salvar</button>
            </div>
     </div>Painel salarial -->
     <!--<div class="panel panel-default" style="padding: 7px 0px ;margin-bottom: 1px">
            <div class="fleft-2" style="padding: 7px;">
                <span class="bold">Mudan�a de cargo</span>
            </div>
            
            <div class="fleft-2">
                <div class="autocomplete" >
                  <input type="text" id="busca_colab" data-campo="colab" data-classe="itemcolab" data-div="lista_mud" class="autocompletar form-control" placeholder="" style="background: transparent;"/>
                  <div id="lista_mud"></div>
              </div>
              <div id="selecionados"></div>
          </div>
          <div class="fleft-1">
              <button class="btn btn-default">Salvar</button>
            </div>
     </div>Painel cargo -->
     <!--<div class="panel panel-default" style="padding: 7px 0px ;margin-bottom: 1px">
            <div class="fleft-2" style="padding: 7px;">
                <span class="bold">F�rias</span>
            </div>
            
            <div class="fleft-2">
                <div class="autocomplete" >
                  <input type="text" id="busca_colab" data-campo="colab" data-classe="itemcolab" data-div="lista_fer" class="autocompletar form-control" placeholder="" style="background: transparent;"/>
                  <div id="lista_fer"></div>
              </div>
              <div id="selecionados"></div>
          </div>
          <div class="fleft-1">
              <button class="btn btn-default">Salvar</button>
            </div>
     </div>Painel F�rias -->
     <!--<div class="panel panel-default" style="padding: 7px 0px ;margin-bottom: 1px">
            <div class="fleft-2" style="padding: 7px;">
                <span class="bold">Treinamento</span>
            </div>
            
            <div class="fleft-2">
                <div class="autocomplete" >
                  <input type="text" id="busca_colab" data-campo="colab" data-classe="itemcolab" data-div="lista_tre" class="autocompletar form-control" placeholder="" style="background: transparent;"/>
                  <div id="lista_tre"></div>
              </div>
              <div id="selecionados"></div>
          </div>
          <div class="fleft-1">
              <button class="btn btn-default">Salvar</button>
            </div>
     </div>Painel Treinamento -->
  </div>
</div><!-- Fim tab Aprovadores -->
    
        

</div>

</div>
</div><!--Div da ROW -->
<input type="hidden" name="paramid" id="paramid" value="<?php if (!empty($parametros)) {echo $parametros->param_id;} ?>" >

<script type="text/javascript">
	$(".rdchefia").change(function(){

        var valor = $(this).val();
        var paramid = $("#paramid").val();
        var campo = $(this).attr("name");
        var empresa = $("#selectempresas").val();

        $.ajax({        
      type: "POST",
      url: '<?php echo base_url()."admin/salvarparam";?>',
      dataType : 'json',
      data:{
        valor: valor,
        paramid: paramid,
        empresa: empresa,
        campo: campo
      },
      success: function(msg){
        //console.log(msg);
       
        if(msg.id === 'erro'){
           $(".alert").addClass("alert-danger")
              .html("Houve um erro. Contate o administrador do sistema")
              .slideDown("slow");

        }else{

            if(msg.id){
                $("#paramid").val(msg.id);
            }           
            
             $(".alert").addClass("alert-success")
              .html("Chefia alterado com sucesso")
              .slideDown("slow");
              
         }
         //$("#load").fadeOut("slow");
         $(".alert").delay( 3500 ).hide(500);
       } 
     });

    });

    $(".check").change(function(){

        $(this).prop("disabled", true);
        var check = $(this);
        var valor = check.prop("checked")==true ? 1:0 ;
        var campo = check.attr("name");
        var paramid = $("#paramid").val();
        var empresa = $("#selectempresas").val();

        $.ajax({             
            type: "POST",
            url: '<?php echo base_url()."admin/salvarparam";?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
                campo : campo,
                valor : valor,
                empresa: empresa,
                paramid: paramid
            },              
            success: function(msg) 
            {    
        //console.log(msg);
        check.prop("disabled", false);

        } 
        });

    });

    $(".btnrel").click(function(){

        var campo = $(this).attr("botao");
        var valor = $("#"+campo).val();
        var paramid = $("#paramid").val();
        var empresa = $("#selectempresas").val();

        $.ajax({             
            type: "POST",
            url: '<?php echo base_url()."admin/salvarparam";?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
                campo : campo,
                valor : valor,
                empresa: empresa,
                paramid: paramid
            },              
            success: function(msg) 
            {    
                console.log(msg);
                //check.prop("disabled", false);

            } 
        });

    });

    $(".autocomplete").click(function(){
      $(this).find("input[type=text]").focus();
    });

    $(".autocompletar").keyup(function(){

        var empresa = $("#selectempresas").val();
      var busca = $.trim( $(this).val() );
      var campo = $(this).data("campo");
      var div = $(this).data("div");
      var classe = $(this).data("classe");
      if(busca !=""){

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url()."ajax/autocompleteAprovador"; ?>',
          dataType : 'html',
          cache: false,
          data: {
            busca: busca,
            empresa: empresa,
            classe: classe,
            campo: campo
          },           
          success: function(msg){
          //console.log(msg);
          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#"+div).html(msg);

          }

        } 
      }); 
      }else{
        $("#"+div).html("");
      }//if busca
    });

    $(document).on("click",".exc", function(){
      var id = $(this).attr("rm");

      $("#colabor"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#colabs"+id).remove();
        });


     });


    $("#salvar_solicitacao").click(function(){

        var empresa = $("#selectempresas").val();
        var solicitacao = $("#tipo_solicitacao");
        if(solicitacao.val()==""){
            solicitacao.focus();
            solicitacao.css("border-color", "red");
            return;
        }

        var aprovadores = [];
        var x = 0;
        $("input[name='colabs[]']").each(function() {
            aprovadores[x] = $(this).val();
            x++;
            //console.log($(this).val());
        });
        if (aprovadores.length<1) {
            return;
        }

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url()."admin/salvar_aprovadores"; ?>',
          //dataType : 'html',
          cache: false,
          data: {
            empresa: empresa,
            tipo_solicitacao: solicitacao.val(),
            aprovadores: aprovadores
          },           
          success: function(msg){

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

             //window.location.href = '<?php echo base_url()."admin/parametros"; ?>';
             $(".excolab").remove();
             $("#selecionados").html("");
             $("#tipo_solicitacao").change();

          }

        } 
      });
    });

    $("#tipo_solicitacao").change(function(){

        var empresa = $("#selectempresas").val();
        var solicitacao = $(this).val();
        $("#loadap").show();

        $.ajax({        
          type: "POST",
          url: '<?php echo base_url()."admin/recuperar_aprovadores"; ?>',
          //dataType : 'html',
          cache: false,
          data: {
            empresa: empresa,
            tipo_solicitacao: solicitacao
          },           
          success: function(msg){
          
          $("#loadap").hide();

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#aprovadores").html(msg);

          }

        } 
      });

    });

    $(document).on("click",".exc_ap", function(){
      var id = $(this).data("id");
      $("#loadap").show();

      $("#apr"+id).fadeOut("slow", function() {
        $(this).remove();
        $.ajax({        
          type: "POST",
          url: '<?php echo base_url()."admin/excluir_aprovador"; ?>',
          //dataType : 'html',
          cache: false,
          data: {
            id: id
          },           
          success: function(msg){
          
          $("#loadap").hide();

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

            }
            } 
         });
        });
     });
    

</script>