<?php
// ----------------------------------
final class LinkDB extends PDO {

	// ----------------------------------

	public static $inst;

	// ----------------------------------

	/**
	 * Crea una instancia de la clase de conexión a la base de datos sin clonarla
	 *
	 * @param string $db - Nombre de la base de datos
	 * @param string $driver - Driver de conexión a la base de datos
	 * @param bool $new - Crea nueva conexión sin clonar la anterior
	 *
	 * @return objeto de conexión
	 */

	final public static function Connect(string $db = DATABASE['dbname'], string $driver = DATABASE['driver'], bool $new = false) : LinkDB {
		if (!self::$inst instanceof self or $new) {
			self::$inst = new self($db, $driver);
		}

		return self::$inst;
	}

	// ----------------------------------

	/**
	 * Inicializa la conexión a la base de datos
	 *
	 * @param string $db - Base de datos a conectar
	 * @param string $driver - Motor de base de datos a conectar
	 *
	 * @return void;
	 */

	final public function __construct(string $db = DATABASE['dbname'], string $driver = DATABASE['driver']) {
		try {

			switch ($driver) {
				case 'oracle':
					parent::__construct('oci:dbname=(DESCRIPTION=
						(ADRESS_LIST=
							(ADDRESS = (PROTOCOL = '.DATABASE['protocol'].')(HOST = '.$driver.')(PORT = '.DATABASE['protocol'].'))
						)
						(CONNECT_DATA =
							(SERVICE_NAME = '.$db.')
						)
					);charset=utf8', DATABASE['user'], DATABASE['pass'], array(
						PDO::ATTR_EMULATE_PREPARES => false,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
					));
				break;
				case 'sqlite':
					parent::__construct('sqlite:'.$db);
				break;
				case 'odbc':
					parent::__construct('odbc:'.$db);
				break;
				case 'firebird':
					parent::__construct('firebird:dbname='.DATABASE['host'] .':'.$db, DATABASE['user'], DATABASE['pass'], array(
						PDO::ATTR_EMULATE_PREPARES => false,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					));
				break;
				case 'cubrid':
					parent::__construct('cubrid:host='.DATABASE['host'] .';port='.DATABASE['port'] .';dbname='.$db, DATABASE['user'], DATABASE['pass'], array(
						PDO::ATTR_EMULATE_PREPARES => false,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					));
				break;
				case 'pgsql':
					parent::__construct('pgsql:host='.DATABASE['host'] . ';dbname='.$db.';charset=utf8' , DATABASE['user'],DATABASE['pass'], array(
						PDO::ATTR_EMULATE_PREPARES => false,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					));
				break;
				case 'mysql':
					parent::__construct('mysql:host='.DATABASE['host'] . ';dbname='.$db, DATABASE['user'],DATABASE['pass'], array(
						PDO::ATTR_EMULATE_PREPARES => false,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
					));
				break;

				default:
					if (AJAX) {
						return json_encode(array('success' => false, 'msg' => '<strong>Error: </strong> Motor de base de datos Desconocido.'));
					}else{
						die('<strong>Error: </strong> Motor de base de datos Desconocido.');
					}
				break;
			}

		} catch (PDOException $e) {
			if (AJAX) {
				return json_encode(array('success' => false, 'msg' => '<strong>Error: </strong>'.$e->getMessage()));
			}else{
				die('<strong>Error: </strong>'.$e->getMessage());
			}
		}finally {
			unset($db, $driver);
		}



	}



	// ----------------------------------
	/**
	 * Devuelve el número de filas de una consulta
	 *
	 * @param PDOStatement $query - Consulta a evaluar
	 *
	 * @return Número de filas de una consulta
	 */

	final public function rows(PDOStatement $query) : int {
		return $query->rowCount();
	}

	// ----------------------------------

	/**
	 * Realiza una consulta preparada
	 *
	 * @param string $query - Consulta a realizar
	 * @param $exec - booleano o arreglo que ejecuta la consulta
	 *
	 * @return Objeto PDOStatement
	 */

	final public function pQuery(string $query, $exec = false) : PDOStatement {
		try {
			$q = parent::prepare($query);

			if (is_bool($exec) && true === $exec) {
				$q->execute();
			}else if(is_array($exec)){
				$q->execute($exec);
			}

			return $q;

		} catch (Exception $e) {
			$msg = '<b>Error en la consulta: </b> '. $e->getMessage();

			die(AJAX ? json_encode(array('success' => false, 'msg' => $msg)) : $msg);
		}
	}

	// ----------------------------------

	/**
	 * Inserta registros en una tabla
	 *
	 * @param array $datos - Arreglo asociativo con los datos a insertar, en forma: array(
	 * 																					campo1 => valor,
	 * 																					campo2 => valor
	 * 																					)
	 * @param string $table - Tabla en la que se quiere insertar
	 *
	 * @return void
	 */

	final public function pInsert(array $datos, string $table) {
		if (sizeof($datos) == 0) {
			trigger_error('El arreglo pasado por parametro no puede estar vacío', E_USER_ERROR);
		}

		$insert = "INSERT INTO $table (";
		$values = "VALUES(";
		$val = array();

		foreach ($datos as $c => $v) {
			$insert .= $c . ',';
			$values .= '?,';
			$val[] = $v;
		}


		$insert[strlen($insert) - 1] = ')';
		$values[strlen($values) - 1] = ')';

		$this->pQuery($insert . ' ' .$values, $val);
	}

	// ----------------------------------

	/**
	 * Modifica los datos de una tabla
	 *
	 * @param array $datos - Arreglo asociativo con los datos a modificar, en forma: array(
	 * 																					campo1 => valor,
	 * 																					campo2 => valor
	 * 																					)
	 * @param string $table - tabla a modificar
	 * @param string $where - Condición de la consulta
	 * @param string $limit - Límite de registros
	 */

	final public function pUpdate(array $datos, string $table, string $where, string $limit = 'LIMIT 1')  {
		if (sizeof($datos) == 0) {
			trigger_error('El arreglo pasado por parametro no puede estar vacío', E_USER_ERROR);
		}
		$update = "UPDATE $table SET ";
		$val = array();
		foreach ($datos as $c => $v) {
			$update .= $c . ' = ?,';
			$val[] = $v;
		}

		$update[strlen($update) - 1] = ' ';
		$update .= "WHERE $where $limit";

		$this->pQuery($update, $val);
	}

	// ----------------------------------
	/**
	 * Elimina registros de una tabla
	 *
	 * @param string $table - Tabla en la que se quiere borrar
	 * @param string $where - Condición de la consulta
	 * @param string $limit - Limita los registros
	 *
	 * @param Objeto PDOStatement
	 */

	final public function pDelete(string $table, string $where, string $limit = 'LIMIT 1') : PDOStatement{
		return $this->pQuery("DELETE FROM $table WHERE $where $limit", true);
	}

	// ----------------------------------

	/**
	 * Devuelve registros de la db en forma de matriz
	 *
	 * @param string $campos - Campos que queremos traer
	 * @param string $table - Tabla de la que se quiere traer
	 * @param string $where - Condición de la consulta
	 * @param string $limit - Limita los registros a traer
	 *
	 * @return una matriz en caso de haber registros, false en caso contrario
	 */

	final public function pSelect(string $campos, string $table, string $where = '1=1', string $limit = ''){
		$query = $this->pQuery("SELECT $campos FROM $table WHERE $where $limit",true);
		$result = $query->fetchAll();
		$query->closeCursor();

		if (sizeof($result) > 0) {
			return $result;
		}

		return false;
	}

	// ----------------------------------

	/**
	 * Lanza error en caso de clonar la conexión
	 *
	 * @return void;
	 */

	final public function __clone() {
		trigger_error('No puedes clonar la conexión', E_USER_ERROR);
	}
}



?>
