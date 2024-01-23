<?php
require_once "./vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

abstract class MysqlDatabase
{	
	protected static $connection = null;

	public static function get()
	{
		if (!self::$connection) {
			try {
				self::$connection = self::createConnection();
			} catch (PDOException $e) {
				// Log db error message
				// $e->getMessage()
				throw new Exception('Database ERROR');
			}
		}

		return self::$connection;
	}

	protected static function createConnection()
	{
		$dsn = $_ENV['DB_DSN'];
		$user = $_ENV['DB_USER'];
		$password = $_ENV['DB_PASSWORD'];


		return new PDO($dsn, $user, $password, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
	}
}