<?php

namespace bloquesModelo\crearDocente\formulario;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class Formulario {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	
	function __construct($lenguaje, $formulario) {
		$this->miConfigurador = \Configurador::singleton ();
		
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		
		$this->lenguaje = $lenguaje;
		
		$this->miFormulario = $formulario;
	}
	function formulario() {
		
		/**
		 * IMPORTANTE: Este formulario está utilizando jquery.
		 * Por tanto en el archivo ready.php se delaran algunas funciones js
		 * que lo complementan.
		 */
		
		// Rescatar los datos de este bloque
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		// ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
		/**
		 * Atributos que deben ser aplicados a todos los controles de este formulario.
		 * Se utiliza un arreglo
		 * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
		 *
		 * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
		 * $atributos= array_merge($atributos,$atributosGlobales);
		 */
		$atributosGlobales ['campoSeguro'] = 'true';
		$_REQUEST ['tiempo'] = time ();
		
		// -------------------------------------------------------------------------------------------------
		
		// ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
		$esteCampo = $esteBloque ['nombre'];
		$atributos ['id'] = $esteCampo;
		$atributos ['nombre'] = $esteCampo;
		
		// Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
		$atributos ['tipoFormulario'] = '';
		
		// Si no se coloca, entonces toma el valor predeterminado 'POST'
		$atributos ['metodo'] = 'POST';
		
		// Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
		$atributos ['action'] = 'index.php';
		$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
		
		// Si no se coloca, entonces toma el valor predeterminado.
		$atributos ['estilo'] = '';
		$atributos ['marco'] = true;
		$tab = 1;
		// ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
		
		// ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
		$atributos ['tipoEtiqueta'] = 'inicio';
		echo $this->miFormulario->formulario ( $atributos );
		
		// ---------------- SECCION: Controles del Formulario -----------------------------------------------
		
		$atributos ['mensaje'] = 'Creacion de Anteproyecto';
		$atributos ['tamanno'] = 'Enorme';
		$atributos ['linea'] = 'true';
		echo $this->miFormulario->campoMensaje ( $atributos );
		

		// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
		$esteCampo = 'titulo';
		$atributos ['id'] = $esteCampo;
		$atributos ['nombre'] = $esteCampo;
		$atributos ['tipo'] = 'text';
		$atributos ['estilo'] = 'jqueryui';
		$atributos ['marco'] = true;
		$atributos ['columnas'] = 1;
		$atributos ['dobleLinea'] = false;
		$atributos ['obligatorio'] = true;
		$atributos ['etiquetaObligatorio'] = true;
		$atributos ['tabIndex'] = $tab;
		$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['validar'] = 'required';
		
		if (isset ( $_REQUEST [$esteCampo] )) {
			$atributos ['valor'] = $_REQUEST [$esteCampo];
		} else {
			$atributos ['valor'] = '';
		}
		$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
		$atributos ['deshabilitado'] = false;
		$atributos ['tamanno'] = 25;
		$atributos ['maximoTamanno'] = '';
		$tab ++;
		
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoCuadroTexto ( $atributos );
		// --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
		

		// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
		$esteCampo = 'autores';
		$atributos ['id'] = $esteCampo;
		$atributos ['nombre'] = $esteCampo;
		$atributos ['tipo'] = 'text';
		$atributos ['estilo'] = 'jqueryui';
		$atributos ['marco'] = true;
		$atributos ['columnas'] = 1;
		$atributos ['dobleLinea'] = false;
		$atributos ['obligatorio'] = true;
		$atributos ['etiquetaObligatorio'] = true;
		$atributos ['tabIndex'] = $tab;
		$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['validar'] = 'required';
		
		if (isset ( $_REQUEST [$esteCampo] )) {
			$atributos ['valor'] = $_REQUEST [$esteCampo];
		} else {
			$atributos ['valor'] = '';
		}
		$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
		$atributos ['deshabilitado'] = false;
		$atributos ['tamanno'] = 25;
		$atributos ['maximoTamanno'] = '';
		$tab ++;
		
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoCuadroTexto ( $atributos );
		// --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
		
		
		// ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
        
        $esteCampo = 'directorInterno';
        $atributos ['columnas'] = 1;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;
        $atributos ['seleccion'] = - 1;
        $atributos ['evento'] = '';
        $atributos ['deshabilitado'] = false;
        $atributos ['tab'] = $tab;
        $atributos ['tamanno'] = 1;
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['validar'] = 'required';
        $atributos ['limitar'] = true;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
        $atributos ['anchoEtiqueta'] = 150;
        
        // Valores a mostrar en el control
        $matrizItems = array (
	         array (
	         	"Profe1",
	         	'Profe1'
	         ),
	         array (
	         	"Profe2",
	         	'Profe2'
	         )
         );
        
        $atributos ['matrizItems'] = $matrizItems;
        
        // Utilizar lo siguiente cuando no se pase un arreglo:
        // $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
        // $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
        $tab ++;
        echo $this->miFormulario->campoCuadroLista ( $atributos );
        unset ( $atributos );
        
        // --------------- FIN CONTROL : Cuadro Lista --------------------------------------------------
        
        // ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
        
        $esteCampo = 'tematicasInteres';
        $atributos ['columnas'] = 1;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;
        $atributos ['seleccion'] = - 1;
        $atributos ['evento'] = '';
        $atributos ['deshabilitado'] = false;
        $atributos ['tab'] = $tab;
        $atributos ['tamanno'] = 1;
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['validar'] = 'required';
        $atributos ['limitar'] = true;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
        $atributos ['anchoEtiqueta'] = 150;
        
        // Valores a mostrar en el control
        $matrizItems = array (
        		array (
        				"Tematica1",
        				'Tematica1'
        		),
        		array (
        				"Tematica2",
        				'Tematica2'
        		)
        );
        
        $atributos ['matrizItems'] = $matrizItems;
        
        // Utilizar lo siguiente cuando no se pase un arreglo:
        // $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
        // $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
        $tab ++;
        echo $this->miFormulario->campoCuadroLista ( $atributos );
        unset ( $atributos );
        
        // --------------- FIN CONTROL : Cuadro Lista --------------------------------------------------
        
        // -----------------CONTROL: Botón ----------------------------------------------------------------
        $esteCampo = 'botonAgregar';
        $atributos ["id"] = $esteCampo;
        $atributos ["tabIndex"] = $tab;
        $atributos ["tipo"] = 'boton';
        // submit: no se coloca si se desea un tipo button genérico
        $atributos ['submit'] = true;
        $atributos ["estiloMarco"] = '';
        $atributos ["estiloBoton"] = '';
        // verificar: true para verificar el formulario antes de pasarlo al servidor.
        $atributos ["verificar"] = '';
        $atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
        $atributos ["valor"] = $this->lenguaje->getCadena ( $esteCampo );
        $atributos ['nombreFormulario'] = $esteBloque ['nombre'];
        $tab ++;
        
        // Aplica atributos globales al control
        $atributos = array_merge ( $atributos, $atributosGlobales );
        echo $this->miFormulario->campoBoton ( $atributos );
        // -----------------FIN CONTROL: Botón -----------------------------------------------------------
        
        // ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
        
        $esteCampo = 'modalidadGrado';
        $atributos ['columnas'] = 1;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;
        $atributos ['seleccion'] = - 1;
        $atributos ['evento'] = '';
        $atributos ['deshabilitado'] = false;
        $atributos ['tab'] = $tab;
        $atributos ['tamanno'] = 1;
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['validar'] = 'required';
        $atributos ['limitar'] = true;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
        $atributos ['anchoEtiqueta'] = 150;
        
        // Valores a mostrar en el control
        $matrizItems = array (
        		array (
        				"Modalidad1",
        				'Modalidad1'
        		),
        		array (
        				"Modalidad2",
        				'Modalidad2'
        		)
        );
        
        $atributos ['matrizItems'] = $matrizItems;
        
        // Utilizar lo siguiente cuando no se pase un arreglo:
        // $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
        // $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
        $tab ++;
        echo $this->miFormulario->campoCuadroLista ( $atributos );
        unset ( $atributos );
        
        // --------------- FIN CONTROL : Cuadro Lista --------------------------------------------------
        
        // ---------------- CONTROL: Cuadro Lista --------------------------------------------------------
        
        $esteCampo = 'estado';
        $atributos ['columnas'] = 1;
        $atributos ['nombre'] = $esteCampo;
        $atributos ['id'] = $esteCampo;
        $atributos ['seleccion'] = - 1;
        $atributos ['evento'] = '';
        $atributos ['deshabilitado'] = false;
        $atributos ['tab'] = $tab;
        $atributos ['tamanno'] = 1;
        $atributos ['estilo'] = 'jqueryui';
        $atributos ['validar'] = 'required';
        $atributos ['limitar'] = true;
        $atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
        $atributos ['anchoEtiqueta'] = 150;
        
        // Valores a mostrar en el control
        $matrizItems = array (
        		array (
        				"RADICADO",
        				'Estado inicial del anteproyecto'
        		),
        		array (
        				"ASIGNANDO REVISORES",
        				'Estado que representa que el anteproyecto se encuentra en asignaci�n de revisores'
        		),
        		array (
        				"REVISORES ASIGNADOS",
        				'Estado que representa que el anteproyecto ya cuenta con revisores asignados'
        		),
        		array (
        				"EN REVISION",
        				'Estado que representa que en el anteproyecto se encuentr en fase de revisi�n'
        		),
        		array (
        				"FINALIZADO",
        				'Estado que permite identificar que la propuesta ya ha sido finalizada como proyecto de grado'
        		),
        		array (
        				"PROYECTO",
        				'Estado que permite identificar que el anteproyecto fue radicado como proyecto de grado'
        		),
        		array (
        				"NO APROBADO",
        				'Estado que permite indentificar que el anteproyecto no fue aprobado por los revisores'
        		),
        		array (
        				"CANCELADO",
        				'Estado que permite indentificar que el anteproyecto fue cancelado en esta etapa o alguna futura'
        		)
        );
        
        $atributos ['matrizItems'] = $matrizItems;
        
        // Utilizar lo siguiente cuando no se pase un arreglo:
        // $atributos['baseDatos']='ponerAquiElNombreDeLaConexión';
        // $atributos ['cadena_sql']='ponerLaCadenaSqlAEjecutar';
        $tab ++;
        echo $this->miFormulario->campoCuadroLista ( $atributos );
        unset ( $atributos );
        
        // --------------- FIN CONTROL : Cuadro Lista --------------------------------------------------
        
		
		// ------------------Division para los botones-------------------------
		$atributos ["id"] = "botones";
		$atributos ["estilo"] = "marcoBotones";
		echo $this->miFormulario->division ( "inicio", $atributos );
		
		// -----------------CONTROL: Botón ----------------------------------------------------------------
		$esteCampo = 'botonCrear';
		$atributos ["id"] = $esteCampo;
		$atributos ["tabIndex"] = $tab;
		$atributos ["tipo"] = 'boton';
		// submit: no se coloca si se desea un tipo button genérico
		$atributos ['submit'] = true;
		$atributos ["estiloMarco"] = '';
		$atributos ["estiloBoton"] = '';
		// verificar: true para verificar el formulario antes de pasarlo al servidor.
		$atributos ["verificar"] = '';
		$atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
		$atributos ["valor"] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['nombreFormulario'] = $esteBloque ['nombre'];
		$tab ++;
		
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoBoton ( $atributos );
		// -----------------FIN CONTROL: Botón -----------------------------------------------------------
		
		// -----------------CONTROL: Botón ----------------------------------------------------------------
		$esteCampo = 'botonCancelar';
		$atributos ["id"] = $esteCampo;
		$atributos ["tabIndex"] = $tab;
		$atributos ["tipo"] = 'boton';
		// submit: no se coloca si se desea un tipo button genérico
		$atributos ['submit'] = true;
		$atributos ["estiloMarco"] = '';
		$atributos ["estiloBoton"] = '';
		// verificar: true para verificar el formulario antes de pasarlo al servidor.
		$atributos ["verificar"] = '';
		$atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
		$atributos ["valor"] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['nombreFormulario'] = $esteBloque ['nombre'];
		$tab ++;
		
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoBoton ( $atributos );
		// -----------------FIN CONTROL: Botón -----------------------------------------------------------
		
		
		// ------------------Fin Division para los botones-------------------------
		echo $this->miFormulario->division ( "fin" );
		
		// ------------------- SECCION: Paso de variables ------------------------------------------------
		
		/**
		 * En algunas ocasiones es útil pasar variables entre las diferentes páginas.
		 * SARA permite realizar esto a través de tres
		 * mecanismos:
		 * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
		 * la base de datos.
		 * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
		 * formsara, cuyo valor será una cadena codificada que contiene las variables.
		 * (c) a través de campos ocultos en los formularios. (deprecated)
		 */
		
		// En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:
		
		// Paso 1: crear el listado de variables
		
		// $valorCodificado = "action=" . $esteBloque ["nombre"];
		$valorCodificado = "pagina=inicio";
		$valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
		$valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
		$valorCodificado .= "&opcion=mostrar";
		/**
		 * SARA permite que los nombres de los campos sean dinámicos.
		 * Para ello utiliza la hora en que es creado el formulario para
		 * codificar el nombre de cada campo.
		 */
		$valorCodificado .= "&campoSeguro=" . $_REQUEST ['tiempo'];
		// Paso 2: codificar la cadena resultante
		$valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );
		
		$atributos ["id"] = "formSaraData"; // No cambiar este nombre
		$atributos ["tipo"] = "hidden";
		$atributos ['estilo'] = '';
		$atributos ["obligatorio"] = false;
		$atributos ['marco'] = true;
		$atributos ["etiqueta"] = "";
		$atributos ["valor"] = $valorCodificado;
		echo $this->miFormulario->campoCuadroTexto ( $atributos );
		unset ( $atributos );
		
		// ----------------FIN SECCION: Paso de variables -------------------------------------------------
		
		// ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
		
		// ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
		// Se debe declarar el mismo atributo de marco con que se inició el formulario.
		$atributos ['marco'] = true;
		$atributos ['tipoEtiqueta'] = 'fin';
		echo $this->miFormulario->formulario ( $atributos );
		
		return true;
	}
	function mensaje() {
		
		// Si existe algun tipo de error en el login aparece el siguiente mensaje
		$mensaje = $this->miConfigurador->getVariableConfiguracion ( 'mostrarMensaje' );
		$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', null );
		
		if ($mensaje) {
			
			$tipoMensaje = $this->miConfigurador->getVariableConfiguracion ( 'tipoMensaje' );
			
			if ($tipoMensaje == 'json') {
				
				$atributos ['mensaje'] = $mensaje;
				$atributos ['json'] = true;
			} else {
				$atributos ['mensaje'] = $this->lenguaje->getCadena ( $mensaje );
			}
			// -------------Control texto-----------------------
			$esteCampo = 'divMensaje';
			$atributos ['id'] = $esteCampo;
			$atributos ["tamanno"] = '';
			$atributos ["estilo"] = 'information';
			$atributos ["etiqueta"] = '';
			$atributos ["columnas"] = ''; // El control ocupa 47% del tamaño del formulario
			echo $this->miFormulario->campoMensaje ( $atributos );
			unset ( $atributos );
		}
		
		return true;
	}
}

$miFormulario = new Formulario ( $this->lenguaje, $this->miFormulario );

$miFormulario->formulario ();
$miFormulario->mensaje ();

?>