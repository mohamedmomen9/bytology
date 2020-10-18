<?php
class DatabaseClass{	
	
  private $connection = null;

  public function __construct(){
      try{
          $configs = include('config.php');
          $this->connection = new PDO("mysql:host={$configs['dbhost']};dbname={$configs['dbname']};", $configs['username'], $configs['password']);
          $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      }catch(Exception $e){
          throw new Exception($e->getMessage());   
      }			

  }

  // Insert a row into Database
  public function Insert( $statement = "" , $parameters = [] ){
      try{
  
          $this->executeStatement( $statement , $parameters );
          return $this->connection->lastInsertId();
  
      }catch(Exception $e){
          throw new Exception($e->getMessage());   
      }		
  }

  // Select from Database 
  public function Select( $statement = "" , $parameters = [] ){
      try{
  
          $stmt = $this->executeStatement( $statement , $parameters );
          return $stmt->fetchAll();
  
      }catch(Exception $e){
          throw new Exception($e->getMessage());   
      }		
  }	
  
  // execute statement
  private function executeStatement( $statement = "" , $parameters = [] ){
      try{
          $stmt = $this->connection->prepare($statement);
          $stmt->execute($parameters);
          return $stmt;
  
      }catch(Exception $e){
          throw new Exception($e->getMessage());   
      }		
  }

}