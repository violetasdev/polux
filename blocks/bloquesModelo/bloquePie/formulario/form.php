<?php

namespace bloquesModelo\bloquePie\formulario;

$rutaPrincipal = $this->miConfigurador->getVariableConfiguracion ( 'host' ) . $this->miConfigurador->getVariableConfiguracion ( 'site' );
$indice = $rutaPrincipal . "/index.php?";
$directorio = $rutaPrincipal . '/' . $this->miConfigurador->getVariableConfiguracion ( 'bloques' ) . "/menu_principal/imagen/";

$urlBloque = $this->miConfigurador->getVariableConfiguracion ( 'rutaUrlBloque' );

?>
<!--Division flotante para el panel-->
<div id="divPanelCentral ">
	<div class="cuerpoPanelCentral animated fadeInDown retraso-1">
		Todos los derechos reservados</br> UD-Learn &#169; 2015
	</div>
</div>
<!--Fin Division flotante para el Panel-->
