<?php

namespace bloquesModelo\crearDocente;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/connection/Sql.class.php");

/**
 * IMPORTANTE: Se recomienda que no se borren registros.
 * Utilizar mecanismos para - independiente del motor de bases de datos,
 * poder realizar rollbacks gestionados por el aplicativo.
 */
class Sql extends \Sql {
	var $miConfigurador;
	function getCadenaSql($tipo, $variable = '') {
		
		/**
		 * 1.
		 * Revisar las variables para evitar SQL Injection
		 */
		$prefijo = $this->miConfigurador->getVariableConfiguracion ( "prefijo" );
		$idSesion = $this->miConfigurador->getVariableConfiguracion ( "id_sesion" );
		
		switch ($tipo) {
			
			/**
			 * Clausulas específicas
			 */
			case 'registrarPersona' :
				$cadenaSql = 'INSERT INTO trabajosdegrado.ge_tpern';
				$cadenaSql .= '(';
				$cadenaSql .= 'pern_nomb,';
				$cadenaSql .= 'pern_papell,';
				$cadenaSql .= 'pern_sapell,';
				$cadenaSql .= 'pern_tdoc,';
				$cadenaSql .= 'pern_doc,';
				$cadenaSql .= 'pern_mail';
				$cadenaSql .= ') ';
				$cadenaSql .= 'VALUES ';
				$cadenaSql .= '(';
				$cadenaSql .= '\'' . $_REQUEST ['nombreDocente'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['primerApellido'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['segundoApellido'] . '\', ';
				$cadenaSql .= $_REQUEST ['seleccionarTipoDocumento'] . ', ';
				$cadenaSql .= $_REQUEST ['numeroDocIdentidad'] . ', ';
				$cadenaSql .= '\'' . $_REQUEST ['emailDocente'] . '\' ';
				$cadenaSql .= ') ';
				break;
			
			case 'registrarDocente' :
				$cadenaSql = 'INSERT INTO trabajosdegrado.ge_tprof';
				$cadenaSql .= '(';
				$cadenaSql .= 'prof_prof,';
				$cadenaSql .= 'prof_pern,';
				$cadenaSql .= 'prof_pcur,';
				$cadenaSql .= 'prof_tpvinc';
				$cadenaSql .= ') ';
				$cadenaSql .= 'VALUES ';
				$cadenaSql .= '(';
				$cadenaSql .= $_REQUEST ['codigoDocente'] . ', ';
				
				$cadenaSql .= '(SELECT ';
				$cadenaSql .= 'pern_pern ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= 'trabajosdegrado.ge_tpern ';
				$cadenaSql .= 'WHERE ';
				$cadenaSql .= 'pern_doc=\'' . $_REQUEST ['numeroDocIdentidad'] . '\'), ';
				$cadenaSql .= $_REQUEST ['seleccionarProgramaCurricular'] . ', ';
				$cadenaSql .= '\'' . $_REQUEST ['tipoVinculacion'] . '\' ';
				
				$cadenaSql .= ')';
				break;
			
			case 'actualizarRegistro' :
				$cadenaSql = 'INSERT INTO ';
				$cadenaSql .= $prefijo . 'pagina ';
				$cadenaSql .= '( ';
				$cadenaSql .= 'nombre,';
				$cadenaSql .= 'descripcion,';
				$cadenaSql .= 'modulo,';
				$cadenaSql .= 'nivel,';
				$cadenaSql .= 'parametro';
				$cadenaSql .= ') ';
				$cadenaSql .= 'VALUES ';
				$cadenaSql .= '( ';
				$cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
				$cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
				$cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
				$cadenaSql .= ') ';
				break;
			
			case 'buscarRegistro' :
				
				$cadenaSql = 'SELECT ';
				$cadenaSql .= 'id_pagina as PAGINA, ';
				$cadenaSql .= 'nombre as NOMBRE, ';
				$cadenaSql .= 'descripcion as DESCRIPCION,';
				$cadenaSql .= 'modulo as MODULO,';
				$cadenaSql .= 'nivel as NIVEL,';
				$cadenaSql .= 'parametro as PARAMETRO ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= $prefijo . 'pagina ';
				$cadenaSql .= 'WHERE ';
				$cadenaSql .= 'nombre=\'' . $_REQUEST ['nombrePagina'] . '\' ';
				break;
			
			case 'borrarRegistro' :
				$cadenaSql = 'INSERT INTO ';
				$cadenaSql .= $prefijo . 'pagina ';
				$cadenaSql .= '( ';
				$cadenaSql .= 'nombre,';
				$cadenaSql .= 'descripcion,';
				$cadenaSql .= 'modulo,';
				$cadenaSql .= 'nivel,';
				$cadenaSql .= 'parametro';
				$cadenaSql .= ') ';
				$cadenaSql .= 'VALUES ';
				$cadenaSql .= '( ';
				$cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
				$cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
				$cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
				$cadenaSql .= ') ';
				break;
			
			case 'buscarUsuario' :
				
				$cadenaSql = 'SELECT ';
				$cadenaSql .= 'id_usuario as CC, ';
				$cadenaSql .= 'nombre as NOMBRE, ';
				$cadenaSql .= 'telefono as TELEFONO, ';
				$cadenaSql .= 'email as EMAIL, ';
				$cadenaSql .= 'genero as GENERO, ';
				$cadenaSql .= 'fecha_registro as FECHA ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= 'udlearn.usuario ';
				$cadenaSql .= 'WHERE ';
				$cadenaSql .= 'id_usuario=\'' . $_REQUEST ['user'] . '\' ';
				$cadenaSql .= 'and clave=\'' . $_REQUEST ['pass'] . '\' ';
				// echo $cadenaSql;
				break;
			
			case 'buscarProgramasCurriculares' :
				
				$cadenaSql = 'SELECT ';
				$cadenaSql .= 'pcur_pcur as CODIGO, ';
				$cadenaSql .= 'pcur_nom as NOMBRE ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= 'trabajosdegrado.ge_tpcur';
				break;
			
			case 'buscarTipoDocumento' :
				
				$cadenaSql = 'SELECT ';
				$cadenaSql .= 'tdoc_tdoc as CODIGO, ';
				$cadenaSql .= 'tdoc_doc as TIPO ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= 'trabajosdegrado.ge_ttdoc';
				break;
		}
		
		return $cadenaSql;
	}
}
?>
