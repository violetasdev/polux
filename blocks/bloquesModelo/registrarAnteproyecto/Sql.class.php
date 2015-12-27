<?php

namespace bloquesModelo\registrarAnteproyecto;

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
			//VALUES (" . $variable ['modalidadGrado'] . ", ";
			
			case 'registrarAntp' :
				$fechaNueva = date('Y-m-d');
				$descripcion = "descripción";
				
				$cadenaSql = 'INSERT INTO trabajosdegrado.ant_tantp';
				$cadenaSql .= '(';
				$cadenaSql .= 'antp_moda,';
				$cadenaSql .= 'antp_pcur,';
				$cadenaSql .= 'antp_titu,';
				$cadenaSql .= 'antp_fradi,';
				$cadenaSql .= 'antp_descri,';
				$cadenaSql .= 'antp_obser,';
				$cadenaSql .= 'antp_eantp,';
				$cadenaSql .= 'antp_dir_int';
				$cadenaSql .= ') ';
				$cadenaSql .= 'VALUES ';
				$cadenaSql .= '(';
				
				$cadenaSql .= $_REQUEST ['modalidadGrado'] . ', ';
				// proyecto curricular
				$cadenaSql .= 20 . ', ';
				$cadenaSql .= '\'' . $_REQUEST ['titulo'] . '\', ';
				$cadenaSql .= '\'' . $fechaNueva . '\', ';
				$cadenaSql .= '\'' . $descripcion . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['observaciones'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['estado'] . '\', ';
				$cadenaSql .= '\'' . $_REQUEST ['seleccionarDirectorInterno'] . '\' ';
				$cadenaSql .= ') ';
				var_dump($cadenaSql);
				break;
			
			
			case 'registrarEstudiantes' :
				$cadenaSql = " INSERT INTO trabajosdegrado.ant_testantp ( ";
				$cadenaSql .= "estantp_estd, estantp_antp) ";
				$cadenaSql .= " VALUES (" . $variable ['autores'] . ", ";
				// proyecto curricular
				$cadenaSql .= " 20, ";
				$cadenaSql .= " '" . $variable ['fecha'] . "', ";
				// descripcion
				$cadenaSql .= " 'descripción', ";
				$cadenaSql .= " '" . $variable ['observaciones'] . "', ";
				$cadenaSql .= $variable ['estado'] . ", ";
				$cadenaSql .= $variable ['seleccionarDirectorInterno'] . ")";
				
				var_dump ( $cadenaSql );
				break;
			
			case "registroDocumento" :
				$cadenaSql = " INSERT INTO trabajosdegrado.ant_tdantp ( ";
				$cadenaSql .= "dantp_vers, dantp_observ, dantp_falm, dantp_usua, dantp_antp,";
				$cadenaSql .= "dantp_url, dantp_hash, dantp_bytes, dantp_nombre, dantp_extension)";
				
				// asignar la version
				$cadenaSql .= " VALUES (1,";
				$cadenaSql .= " '" . $variable ['observaciones'] . "', ";
				$cadenaSql .= " '" . $variable ['fecha'] . "', ";
				// asignar estudiante
				$cadenaSql .= " '" . 767 . "', ";
				
				// anteproyecto
				$cadenaSql .= '(SELECT ';
				$cadenaSql .= 'antp_antp ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= 'trabajosdegrado.ant_tantp ';
				$cadenaSql .= 'WHERE ';
				$cadenaSql .= 'antp_antp=\'' . $_REQUEST ['numeroDocIdentidad'] . '\'), ';
				
				$cadenaSql .= " '" . $variable ['destino'] . "', ";
				$cadenaSql .= " '" . Hash . "', ";
				$cadenaSql .= " '" . $variable ['size'] . "', ";
				$cadenaSql .= " '" . $variable ['nombre'] . "', ";
				$cadenaSql .= " '" . $variable ['type'] . "' ";
				$cadenaSql .= ")";
				$cadenaSql .= " RETURNING dantp_dantp;";
				var_dump ( $cadenaSql );
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
			
			case 'buscarTematicas' :
				
				$cadenaSql = 'SELECT ';
				$cadenaSql .= 'acono_acono as CODIGO, ';
				$cadenaSql .= 'acono_nom as NOMBRE ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= 'trabajosdegrado.ge_tacono';
				break;
			
			case 'buscarDocentes' :
				
				$cadenaSql = "SELECT ";
				$cadenaSql .= "prof_pern as ID, ";
				$cadenaSql .= "prof_prof as CODIGO ";
				$cadenaSql .= "FROM ";
				$cadenaSql .= "trabajosdegrado.ge_tprof ";
				$cadenaSql .= "WHERE ";
				$cadenaSql .= "prof_tpvinc='Planta'";
				// var_dump($cadenaSql);
				break;
			
			case 'buscarModalidades' :
				
				$cadenaSql = 'SELECT ';
				$cadenaSql .= 'moda_moda as ID, ';
				$cadenaSql .= 'moda_nombre as NOMBRE ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= 'trabajosdegrado.ge_tmoda';
				break;
			
			case 'buscarEstados' :
				
				$cadenaSql = 'SELECT ';
				$cadenaSql .= 'eantp_eantp, ';
				$cadenaSql .= 'eantp_descri ';
				$cadenaSql .= 'FROM ';
				$cadenaSql .= 'trabajosdegrado.ant_teantp';
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
		}
		
		return $cadenaSql;
	}
}
?>
