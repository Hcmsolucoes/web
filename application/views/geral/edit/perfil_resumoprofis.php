<?php 

$resumo=""; 

foreach ($perfil_profissional as $value) { 
  $resumo = $value -> perfil_resumo; 

}
  ?>

<div class="widget widget-default">
  <h3 class="" style="margin-bottom: 20px;">Resumo do Perfil Profissional</h3>


  <form name="resumo">
  
    <textarea class="form-control" rows="15" id="resumoprof" name="resumoprof"><?php echo $resumo; ?></textarea>
    
    <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Salvar</button>
    <button type="buttom" class="btn btn-danger" id="btcancela"><span class="fa fa-times"></span> Cancelar</button>
  </form>
</div>
<script type="text/javascript">
  
  $( "#btcancela" ).click(function(e) {
   e.preventDefault();
   $( "#myModal" ).modal("hide");		 
   
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
        //console.log(msg);
        location.reload(); 
        
      } 
    });
  });
  
</script>