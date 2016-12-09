<?php

$idparam = "";
$ckind="";
$cklocal="";
$ckf0 = "";
$ckf1 = "";
$ckf2 = "";
$aprh ="";
$apdir ="";
($parametros->Param_chefia==1) ? $cklocal="checked" : $ckind="checked";



foreach ($parametros as $key => $value) {
	//$idparam = $value->param_id;
	//($parametros->Param_chefia==1) ? $cklocal="checked" : $ckind="checked";
	//$aprh = $value->fun_id_aprovadorRH;
	//$apdir = $value->fun_id_aprovador_Direcao;
	
}
switch ($parametros->Param_feed) {
        case '0':$ckf0="checked"; break;
        case '1':$ckf1="checked"; break;
        case '2':$ckf2="checked"; break;        
    }
?>

<div class="page-title">                    
    <h2><span class="fa fa-cogs"></span> Parâmetros</h2>
</div> 


<div class="row">
    <div class="col-md-12">
        <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

        
<ul class="nav nav-tabs" role="tablist" style="padding: 0px;" >
  <li class="active"><a href="#gerais" aria-controls="gerais" role="tab" data-toggle="tab">Parâmetros Gerais</a></li>
  <li ><a href="#funciona" aria-controls="funciona" role="tab" data-toggle="tab">Controle Funcionalidades</a></li>
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


        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Aprovador Solicitações RH: </span>
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
        </div><!--Painel Aprovador RH -->      
      

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Aprovador Solicitações Direção: </span>
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
        </div><!--Painel Aprovador Diretor -->
      
      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Colaborador Solicitar Férias: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="solicitarferias" type="checkbox" class="check" <?php echo ($parametros->solicitarferias == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Colaborador Solicitar Férias -->

       
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Gestor Solicitar Férias Equipe:</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="feriasequipe" class="check" <?php echo ($parametros->feriasequipe == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Férias Equipe Gestor -->     
      
      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px;">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Férias Necessita Aprovação RH: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_ferias" class="check" <?php echo ($parametros->aprovar_ferias == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Aprovação RH -->           

      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Disponibilizar Opção Abonar Férias: </span>
            </div>
            
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="abonar_ferias" class="check" <?php echo ($parametros->abonar_ferias == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Abonar Férias -->    
      
      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">

            <div class="col-md-2">
               <div class="form-group">
                 <label class="col-md-2 control-label">URL Webservice</label>
                   <div class="col-md-10">
                     <input type="text" class="form-control" value="Digite a URL...">
                   </div>
                  
                
                
                
               </div>
                
                
                
            
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
                <span class="bold">Disponível</span>
            </div>
            <div class="col-md-2">
                <span class="bold">Aprovação RH</span>
            </div>
        </div><!--Painel da chefia -->

        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Dados Pessoais</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_dadospessoais" type="checkbox" <?php echo ($parametros->ic_dadospessoais == 1)?"checked" : "" ; ?> class="check"  />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_dadopessoais" class="check" <?php echo ($parametros->aprovar_dadopessoais == 1)?"checked" : "" ; ?> />
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
                    <input name="ic_documentos" class="check" type="checkbox" <?php echo ($parametros->ic_documentos == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_documentos" class="check" <?php echo ($parametros->aprovar_documentos == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Documentos -->            
        

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Endereços</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_endereco" class="check" type="checkbox" <?php echo ($parametros->ic_endereco == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_endereco" <?php echo ($parametros->aprovar_endereco == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Endereços -->            
        
        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Contatos Pessoais</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_contatos" class="check" type="checkbox" <?php echo ($parametros->ic_contatos == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_contatos" <?php echo ($parametros->aprovar_contatos == 1)?"checked" : "" ; ?> />
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
                    <input name="ic_fichafamiliar" class="check" type="checkbox" <?php echo ($parametros->ic_fichafamiliar == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_familiar" <?php echo ($parametros->aprovar_familiar == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Ficha Familiar -->          
    
        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Contatos Telefônicos</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_telefones" class="check" type="checkbox" <?php echo ($parametros->ic_telefones == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Contatos Telefônicos -->             
        
            
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Perfil Profissional</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_perfilprofissional" class="check" type="checkbox" <?php echo ($parametros->ic_perfilprofissional == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Experiência Profissional -->               
        
            
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Formação Acadêmica</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_academico" class="check" type="checkbox" <?php echo ($parametros->ic_academico == 1)?"checked" : "" ; ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Formação Acadêmica -->                
            
    </div>
</div>
    
    
    
        

</div>

</div>
</div><!--Div da ROW -->
<input type="hidden" name="paramid" id="paramid" value="<?php echo $parametros->param_id; ?>" >

<script type="text/javascript">
	$(".rdchefia").change(function(){

        var valor = $(this).val();
        var paramid = $("#paramid").val();
        var campo = $(this).attr("name");

        $.ajax({        
      type: "POST",
      url: '<?php echo base_url()."admin/salvarparam";?>',
      dataType : 'json',
      data:{
        valor: valor,
        paramid: paramid,
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

        $.ajax({             
            type: "POST",
            url: '<?php echo base_url()."admin/salvarparam";?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
                campo : campo,
                valor : valor,
                paramid: paramid
            },              
            success: function(msg) 
            {    
        //console.log(msg);
        check.prop("disabled", false);

    } 
});

    });

</script>