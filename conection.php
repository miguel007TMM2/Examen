<?php

    class Conexiones{
        private $server= "us-cdbr-east-06.cleardb.net";
        private $usuario="baa9481b33ad2f";
        private $password="a7947433";
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
