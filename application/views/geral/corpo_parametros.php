

<div class="page-title">                    
    <h2><span class="fa fa-cogs"></span> Par�metros</h2>
    <select class="fright" id="selectempresas">
        <option>Selecione a empresa</option>
    <?php foreach ($empresas as $key => $value) { ?>
        <option value="<?php echo $value->em_idempresa ?>"><?php echo $value->em_nome; ?></option>
    <?php } ?>
    </select>
</div>

<img id="loadempresa" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading..." style="display: none;position: relative;top: 30%;left: 40%;" >

<div id="corpo"></div>

<script type="text/javascript">
    $("#selectempresas").change(function(){

        $("#corpo").fadeOut();
        
        $("#loadempresa").show();
        var empresa = $(this).val();
        
        $.ajax({        
          type: "POST",
          url: '<?php echo base_url()."admin/loadParametros";?>',
          dataType : 'html',
          data:{
            empresa: empresa
        },
        success: function(msg){
            //console.log(msg);
            $("#loadempresa").hide();
            $("#corpo").html("");
            if(msg.id === 'erro'){
                $(".alert").addClass("alert-danger")
                .html("Houve um erro. Contate o administrador do sistema")
                .slideDown("slow");
            }else{

                $("#corpo").html(msg);
                $("#corpo").fadeIn();

            }

         } 
        });
    });
</script>


