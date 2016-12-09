<div id="page-content-wrapper" class="rm-transition">    

<?php  $this->load->view('/geral/box/menu_colab_perfil',$menu_colab_perfil); ?>
    
<div id="page-content"> 
		 <div class="col-md-12">
	<div class="content-box">
                    <h3 class="content-box-header bg-primary">
                        Formação acadêmica
			<div class="header-buttons-separator">
                    <a href="#" id="editdados" class="icon-separator">
                        <i class="glyph-icon icon-edit"></i>
                    </a>
                </div>
                    </h3>
                    <div class="content-box-wrapper">
                        
						<div class="list-group ">
					<?php foreach ($formacao_academica as $value) {?>
              <a class="list-group-item" id="aca<?php echo $value->for_idformacao?>">
                <h5 class="bold"><?php echo $value->for_graduacao_curso?></h5>
                <h5 class="ng-binding ng-scope"><?php echo $value->for_educacao_nivel?></h5>
                <div class="font-sub txleft">
                  <span><?php echo $value->for_nome_facu?></span>
                  <br>                               
                  <span>Área de conhecimento: <?php echo $value->for_areaconhecimento?></span>
                  <br>
                  <span><?php $hoje = date("Y-m-d"); $data2 = date( $value->for_datafim );
                              if( $hoje < $data2 ){ ?>
                                Iniciado em <?php echo $this->Log->alteradata1($value->for_datainicio)?> com previsão de conclusão em <?php echo $this->Log->alteradata1($value->for_datafim)?>            
                                            <?php }else{ ?>
                                                Iniciado em <?php echo $this->Log->alteradata1($value->for_datainicio)?> finalizado em <?php echo $this->Log->alteradata1($value->for_datafim)?>
                                            <?php } ?>
                   </span>                                                    
                            
	
								</div>
								<div class="txright" style="position: relative;bottom: 20px;">
                                    <button type="button" class="btn btn-default btn-sm exc" id="<?php echo $value->for_idformacao?>"><span class="glyph-icon icon-remove"></span></button>
                                  </div>                                           
                            </a>

<div class="clearfix"></div>
                            
                            <?php } ?>
							</div>
						
						
						
						
						
                    </div>
</div>
</div>

<script type="text/javascript">
    
    $( "#btcancela" ).click(function(e) {
         e.preventDefault();
        $( "#myModal" ).modal("hide");       
          
     });

    $( "#editdados" ).click(function(e) {
      e.preventDefault();     
      $.ajax({             
                type: "POST",
                 url: '<?php echo base_url().'perfil_edit/academico_edit' ?>',
           dataType : 'html',
           secureuri:false,
           cache: false,
                data:{
                    },              
                success: function(msg) 
                      {    
                        
                        $( "#dadosedit" ).html(msg);
                        $('#myModal').modal('show');
                                                                             
                      } 
                });
     });


    $( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        
        $.ajax({             
                type: "POST",
                 url: '<?php echo base_url().'perfil_edit/pessoal_profissional_edit' ?>',
           dataType : 'html',
           secureuri: false,
                data: $( this ).serialize(),              
                success: function(msg) 
                      {         
                          console.log(msg);
                          location.reload(); 
                          
                      } 
                });
      });
    
    $( ".exc" ).click(function(e) {

        if(!confirm("Deseja excluir a formação acadêmica?")){
            return false;
        }

         e.preventDefault();
         id = $(this).attr('id');
         $('#aca'+id).slideUp("slow");
        
         $.ajax({             
                type: "POST",
                 url: '<?php echo base_url().'perfil_edit/academico_remove' ?>',
           dataType : 'html',
           secureuri: false,
                data: {id : id },             
                success: function() {  

                 $('#aca'+id).remove();

                 } 
                });         
    });


</script>

<!--		 
            <div class="box">                 
                <div class="padding">
                    <span class="tit">Formação acadêmica</span>
                    <div class="divisao_pontim"></div>               
                    <div class="ng-scope">
                        <div class="ng-scope">
                            <?php foreach ($formacao_academica as $value) {?>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h3 class="ng-binding"><?php echo $value->for_graduacao_curso?></h3>
                                    <h5 class="ng-binding ng-scope"><?php echo $value->for_educacao_nivel?></h5>
                                    <div class="row ng-scope">
                                        <div class="col-xs-12 ng-binding"><?php echo $value->for_nome_facu?></div>                                                    
                                    </div>
                                    <div class="row ng-scope">
                                        <div class="col-xs-12 ng-binding"><i>Área de conhecimento: </i><?php echo $value->for_areaconhecimento?></div>                                                    
                                    </div>
                                    <div class="row ng-scope">
                                        <div class="col-xs-12 ng-binding">
                                            <?php $hoje = date("Y-m-d"); $data2 = date( $value->for_datafim );
                                            if( $hoje < $data2 ){ ?>
                                                Iniciado em <?php echo $this->Log->alteradata1($value->for_datainicio)?> com previsão de conclusão em <?php echo $this->Log->alteradata1($value->for_datafim)?>                                                        
                                            <?php }else{ ?>
                                                Iniciado em <?php echo $this->Log->alteradata1($value->for_datainicio)?> finalizado em <?php echo $this->Log->alteradata1($value->for_datafim)?>
                                            <?php } ?>                                                    
                                        </div>                                                    
                                    </div>                                                
                                </div>                                            
                            </div>
                            <hr class="ng-scope">
                            <?php } ?>
                        </div>
                    </div> 
                </div>                
            </div>-->
    
        
    </div>
</div> 



