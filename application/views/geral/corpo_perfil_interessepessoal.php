<div id="page-content-wrapper" class="rm-transition">    

<?php  $this->load->view('/geral/box/menu_colab_perfil',$menu_colab_perfil); ?>

<div id="page-content"> 
<div class="col-md-5">
	<div class="content-box">
                    <h3 class="content-box-header bg-primary">
                     Interesses pessoais
			<div class="header-buttons-separator">
                    <a href="#" id="editdados" class="icon-separator">
                        <i class="glyph-icon icon-edit"></i>
                    </a>
                </div>
                    </h3>
                    <div class="content-box-wrapper">
                        <div class="list-group ">
						<?php foreach ($interessepessoal as $value) {?>
                            
                                <a  class="list-group-item">
                                    <h3 class="ng-binding"><?php echo $value->inter_area?></h3>
                                    <div class="font-sub">
                                        <span class="">
										<?php echo $value->inter_areadetalhe?>
									</span>                                                    
                                    </div>                                                                               
                                </a>                                            
                            
                            <?php } ?>
						</div>						
						
                    </div>
</div>
</div>


<!--	 
            <div class="box">                 
                <div class="padding">
                    <span class="tit">Interesses pessoais</span>
                    <div class="divisao_pontim"></div>               
                    <div class="ng-scope">
                        <div class="ng-scope">
                            <?php foreach ($interessepessoal as $value) {?>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h3 class="ng-binding"><?php echo $value->inter_area?></h4>
                                    <div class="row ng-scope">
                                        <div class="col-xs-12 ng-binding"><?php echo $value->inter_areadetalhe?></div>                                                    
                                    </div>                                                                               
                                </div>                                            
                            </div>
                            <hr class="ng-scope">
                            <?php } ?>
                        </div>
                    </div> 
                </div>                
            </div> -->
</div>
</div>
    
