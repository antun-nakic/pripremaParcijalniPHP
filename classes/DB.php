<?php

namespace DB;

use PDO;

// Singleton to connect db.
class DB
{
  // Hold the class instance.
  private static $instance = null;
  private $conn;

  private $host;
  private $user;
  private $pass;
  private $name;
  private $driver;

  // The db connection is established in the private constructor.
  private function __construct($parametriSpajanja)
  {
    $this->host = $parametriSpajanja['host'];
    $this->user = $parametriSpajanja['user'];
    $this->pass = $parametriSpajanja['pass'];
    $this->name = $parametriSpajanja['dbname'];
    $this->driver = $parametriSpajanja['driver'];

    $this->conn = new PDO(
      "{$this->driver}:host={$this->host};
dbname={$this->name}",
      $this->user,
      $this->pass,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
    );
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public static function getInstance($polje)
  {
    if (!self::$instance) {
      self::$instance = new DB($polje);
    }

    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }

  public function getTasks()
  {
    try {
      $stmt = $this->conn->prepare("SELECT id, name, odradjeno FROM tasks");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      die();
    }
  }

  public function createTask($imeTaska)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO tasks (name) VALUES (:name)");
      $stmt->bindParam(':name', $imeTaska);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
