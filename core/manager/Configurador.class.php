<?php
/**
 * Configurador.class.php
 *
 * Encargado de rescatar las variables de configuracion globales
 *
 * @author 	Paulo Cesar Coronado
 * @version 	2.0.0.0
 * @package 	manager
 * @copyright 	Universidad Distrital Francisco Jose de Caldas
 * @license 	GPL Version 3 o posterior
 *
 */

require_once("config/config.class.php");


class Configurador{

	private static $instance;


	/**
	 *
	 * Arreglo que contiene las variables de configuración globales para el aplicativo.
	 * Las variables se extraen de la base de datos de acuerdo a los datos de acceso declarados
	 * en config.inc.php.
	 *
	 * @var string
	 */
	public $configuracion;



	/**
	 *
	 * Fabrica de Conexiones a la base de datos de estructura
	 * @var ConectorBasicoDB
	 */

	public $fabricaConexiones;


	public $conexionDB;



	private function __construct() {
		$this->configuracion["inicio"] = true;
		$this->conexion=array();

	}


	public static function singleton()
	{
		if (!isset(self::$instance)) {
			$className = __CLASS__;
			self::$instance = new $className;
		}
		return self::$instance;
	}

	public function setConectorDB($objeto){
		$this->fabricaConexiones=$objeto;
	}



	/**
	 * Rescata las variables de configuración que se encuentran en config.inc.php y
	 * en la base de datos principal cuyos datos de conexión los retorna la función
	 * de acceso de config.class.php.
	 * Los datos son cargados en el arreglo $configuracion
	 * @param Ninguno
	 * @return number
	 */

	function variable() {

		$this->setMainConfig();
		$this->fabricaConexiones->setConfiguracion($this->configuracion);

		//Crear un recurso llamado "configuracion"
		$resultado=$this->fabricaConexiones->setRecursoDB('','configuracion');

		if($resultado){
			$this->conexionDB=$this->fabricaConexiones->getRecursoDB('configuracion');
		}

		if($this->conexionDB && $this->rescatarVariablesDB()){
			return true;
		};

		return false;
	}

	/**
	 * Método. Obtiene los datos de acceso a la base de datos principal del
	 * aplicativo.
	 *
	 * @param string $ruta
	 * @return boolean
	 */

	private function setMainConfig(){

		$configuracionBasica= ArchivoConfiguracion::singleton();

		$conf=$configuracionBasica->getConf();

		foreach($conf as $clave=>$valor){

			$this->configuracion[$clave] = $valor;
		}

		return true;
	}

	/**
	 * Método. Accede a la base de datos de estructura y rescata los valores
	 * almacenados en la tabla de configuración.
	 * @return number
	 */
	private function rescatarVariablesDB(){


		if ($this->conexionDB->getEnlace()) {

			$cadena_sql = "SELECT ";
			$cadena_sql.=" parametro,  ";
			$cadena_sql.=" valor  ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$this->configuracion["dbprefijo"] . "configuracion ";


			$this->total = $this->conexionDB->registro_db($cadena_sql, 0);

			if ($this->total > 0) {
				$this->registro = $this->conexionDB->getRegistroDb();
				for ($j = 0; $j < $this->total; $j++) {
					$this->configuracion[trim($this->registro[$j]["parametro"])] = trim($this->registro[$j]["valor"]);
					//print_r($this->configuracion);
				}

				return true;


			} else {

				error_log("No se puede iniciar la aplicacion. Imposible rescatar las variables de configuracion!", 0);
				return 0;
			}
		} else {
			error_log("No se puede iniciar la aplicacion. Imposible determinar un recurso de base de datos.!", 0);
			return 0;
		}


	}


	/**
	 * Método de acceso que retorna el arreglo con todos los datos de configuración
	 * @return string[]
	 */

	function getConfiguracion() {
		return $this->configuracion;
	}

	/**
	 * Método de acceso, retorna una variable específica desde el arreglo de
	 * configuración.
	 * @param string $cadena
	 * @return string|boolean
	 */

	function getVariableConfiguracion($cadena="") {

		if(isset($this->configuracion[$cadena])){

			return $this->configuracion[$cadena];
		}

		return false;

	}

	/**
	 * Método de acceso. Permite que se agreguen variables al arreglo de
	 * configuración.
	 * @param string $variable
	 * @param string $cadena
	 * @return boolean
	 */

	function setVariableConfiguracion($variable="", $cadena="") {



		if($variable!="" && $cadena!=""){
			$this->configuracion[$variable]=$cadena;
		}else{
			if (isset($this->configuracion[$variable]) && $cadena==null){
				unset($this->configuracion[$variable]);
			}
		}
		return true;

	}	


};

?>