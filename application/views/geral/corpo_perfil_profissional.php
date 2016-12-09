<div id="page-content-wrapper" class="rm-transition">    
  
		
<?php  $this->load->view('/geral/box/menu_colab_perfil',$menu_colab_perfil); ?>



  <div class="">    


    <div id="page-content"> 
        <div class="col-md-12">
	<div class="content-box">
                    <h3 class="content-box-header bg-primary">
                        Resumo do Perfil Profissional
			<div class="header-buttons-separator">
                    <a href="#" id="editresumo" class="icon-separator">
                        <i class="glyph-icon icon-edit"></i>
                    </a>
                </div>
                    </h3>
                    <div class="content-box-wrapper">
                       
					   <?php foreach ($perfil_profissional as $value) { ?>
                      <span class="texto"><?php echo $value -> perfil_resumo; ?></span>
                <?php  } ?>
						   
                    </div>
</div>
</div>

<!--		 
             <div class="box">
                 
                 <div class="padding">
                     <div id="resumover" >
                         <div class="row" >
                                <div class="col-sm-8" ><span class="tit">Resumo do Perfil Profissional</span></div>
                                <div class="col-sm-4 text-right"><a href="<?php echo base_url().'perfil_edit/pessoal_info' ?>" class=" btn btn-sm btn-default " id="editresumo"><span class="glyphicon glyphicon-pencil"></span> Editar</a></div>
                         </div>
                         <div class="divisao_pontim"></div>
                     
                           <?php foreach ($perfil_profissional as $value) { ?>
                            <span class="texto"><?php echo $value -> perfil_resumo; ?></span>
                           <?php  } ?>
                     </div>
                     <div id="resumoedit">
                         
                     </div>             
                     
                 </div>
             </div>-->
             <!--
             <div class="box">
                 <div class="padding">
                     <p class="tit">Minhas Competências</p>
                     <div class="divisao_pontim"></div>
                     <div id="columnchart_material" style="width:100%; height:400px"></div>

                 </div>
             </div>
             -->
         </div>
    </div>
</div> 



<script type="text/javascript">
    
$( "#editresumo" ).click(function(e) {
    e.preventDefault();     
     $.ajax({             
                type: "POST",
                 url: '<?php echo base_url().'perfil_edit/pessoal_profissional' ?>',
           dataType : 'html',
           secureuri:false,
           cache: false,
                data:{
                    },              
                success: function(msg) 
                      {   
                        $( "#dadosedit" ).html(msg); 
                        $( "#myModal" ).modal("show");                                
                      } 
                });
});
    
    
/* Gráficos */
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Anual', 'Sales', 'Expenses', 'Profit'],
          ['Proventos', 1500, 400, 200],
          ['Descontos', 1170, 460, 250],
          ['Vantagens', 660, 2100, 300]          
        ]);

        var options = {
          chart: {
            title: 'Resumo da remuneração anual',
            subtitle: 'Clique nas colunas para ver os detalhes',
          },
          hAxis: { textPosition: 'none' },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'}
          
          //colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
     
        window.addEventListener('resize', function(){
         chart.draw(data, options);
        
        });

      }




    


      
    </script>



