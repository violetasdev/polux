$("#registrarAnteproyecto").validationEngine({
	promptPosition : "centerRight",
	scroll: false,
	autoHidePrompt: true,
	autoHideDelay: 2000
});

$("#tablaReporte").dataTable({
	"class": "dataTable display",
	"sPaginationType": "full_numbers"
	
});

$('#<?php echo $this->campoSeguro('fecha'); ?>').datepicker();

$('#<?php echo $this->campoSeguro('seleccionarDirectorInterno')?>').width(280);
$('#<?php echo $this->campoSeguro('seleccionarDirectorInterno')?>').select2();

$('#<?php echo $this->campoSeguro('seleccionarTematica')?>').width(180);
$('#<?php echo $this->campoSeguro('seleccionarTematica')?>').select2();

$('#<?php echo $this->campoSeguro('modalidadGrado')?>').width(280);
$('#<?php echo $this->campoSeguro('modalidadGrado')?>').select2();

$('#<?php echo $this->campoSeguro('estado')?>').width(280);
$('#<?php echo $this->campoSeguro('estado')?>').select2();