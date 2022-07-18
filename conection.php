<?php

    class Conexiones{
        private $server= "localhost"; //127.0.0.1
        private $usuario="root";
        private $password="";
        private $conection;

        public function __construct(){
            try{

                $this->conection= new PDO("mysql:host=$this->server; dbname=facturacion", $this->usuario, $this->password);
                $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $error){
                return "falla de conexion".$error;
            }
        }

        public function publicConection(){
            return $this->conection;
        }
        

        public function ejecutar($sql){ //ISERTAR/DELETE/ACTUALIZAR

            $this->publicConection()->exec($sql);
            return $this->conection->lastInsertId();
        }

        public function consultar($sql){
            
            $sentencia = $this->publicConection()->prepare($sql);
            $sentencia->execute();

            return $sentencia->fetchAll();
        }
        
    }
