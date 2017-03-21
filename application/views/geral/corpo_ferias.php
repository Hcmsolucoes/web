<div class="page-title">                    
<h2><span class="fa fa-plane"></span> Programação de férias</h2>
</div>

<div class="col-md-12">

<div class="widget widget-default">

<select name="periodos" id="periodos">
	<option value="">Escolha o período</option>
	<?php foreach ($periodos as $key => $value) { ?>

	<option value="<?php echo $value->Per_idperiodos; ?>"><?php echo $this->Log->alteradata1($value->Per_dataini). " a " . $this->Log->alteradata1($value->Per_dataFim); ?> - <?php echo "Direito " . $value->Per_QtdDir. " dias"; ?> </option>
	
	<?php } ?>
</select>


</div>
	



</div>
