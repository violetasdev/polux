<?php

namespace bloquesModelo\registrarAnteproyecto\funcion;

//use bloquesModelo\registrarAnteproyecto\funcion\redireccionar;
include_once ('redireccionar.php');

class Registrar {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miFuncion;
	var $miSql;
	var $conexion;
	
	function __construct($lenguaje, $sql) {
		$this->miConfigurador = \Configurador::singleton ();
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		$this->lenguaje = $lenguaje;
		$this->miSql = $sql;
		//$this->miFuncion = $funcion;
	}
	
	function procesarFormulario() {
		
		$esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/bloquesModelo/";
		$rutaBloque .= $esteBloque ['nombre'];
		
		$host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/bloquesModelo/registrarAnteproyecto/" . $esteBloque ['nombre'];
		
		// Aquí va la lógica de procesamiento
		
		// Al final se ejecuta la redirección la cual pasará el control a otra página
		$conexion = "estructura";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		
		//registro de anteproyecto
		//obtener codigo de antp
		$cadenaSql = $this->miSql->getCadenaSql('registrarAntp', $_REQUEST);
		var_dump ( $cadenaSql );
		$resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, 'insertar');
		var_dump ( $resultado );

		/*
		/////////////////////////////////////////////////////
		$cadenaSql = $this->miSql->getCadenaSql ( 'registrar', $_REQUEST );
		var_dump($cadenaSql);
		$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "insertar" );
		*/
		if ($resultado) {
			redireccion::redireccionar ( 'inserto');
			exit ();
		} else {
			redireccion::redireccionar ( 'noInserto' );
			exit ();
		}
		
		/////////////////////////////////////////////////////////
		/*var_dump($_FILES);
		
		$i = 0;
		foreach ($_FILES as $key => $values) {
		
			$archivo [$i] = $_FILES [$key];
			$i ++;
		}
		
		$archivo = $archivo [0];
		
		if (isset($archivo)) {
			// obtenemos los datos del archivo
			$tamano = $archivo ['size'];
			$tipo = $archivo ['type'];
			$archivo1 = $archivo ['name'];
			$prefijo = substr(md5(uniqid(rand())), 0, 6);
		
			if ($archivo1 != "") {
				// guardamos el archivo a la carpeta files
				$destino1 = $rutaBloque . "/documento/" . $prefijo . "_" . $archivo1;
				if (copy($archivo ['tmp_name'], $destino1)) {
					$status = "Archivo subido: <b>" . $archivo1 . "</b>";
					$destino1 = $host . "/documento/" . $prefijo . "_" . $archivo1;
		
					$arreglo = array(
							'fecha' => $fechaActual,
							'destino' => $destino1,
							'nombre' => $archivo1,
							'estado' => 1
					);
		
					$cadenaSql = $this->miSql->getCadenaSql("registroDocumento", $arreglo);
					$idAprobacion = $esteRecursoDB->ejecutarAcceso($cadenaSql, 'busqueda', $arreglo, "registroDocumento");
		
					var_dump($idAprobacion);
					
					if ($idAprobacion == false) {
						redireccion::redireccionar('noInserto');
					}else{
						redireccion::redireccionar('inserto');
					}
				} else {
					$status = "Error al subir el archivo";
		
					redireccion::redireccionar('noInserto');
					// echo $status;
				}
			} else {
				$status = "Error al subir archivo";
		
				redireccion::redireccionar('noInserto', $_REQUEST ['usuario']);
				// echo $status . "2";
			}
		}*/
		
		
	}
	
	function resetForm() {
		foreach ( $_REQUEST as $clave => $valor ) {
			
			if ($clave != 'pagina' && $clave != 'development' && $clave != 'jquery' && $clave != 'tiempo') {
				unset ( $_REQUEST [$clave] );
			}
		}
	}
}

$miProcesador = new Registrar ( $this->lenguaje, $this->sql );

$resultado = $miProcesador->procesarFormulario ();

