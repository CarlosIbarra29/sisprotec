<?php

class Application_Model_LandingModel extends Zend_Db_Table_Abstract{

    public function ALL_GET_TEXTOS(){

        try {
        
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.imagen as IMAGEN, A.nombre as TEXTO_TITULO, A.descripcion AS TEXTO , A.color as COLOR 

                    FROM servicios A  WHERE A.tpo_seccion = 1";
        
            $qry = $db->query( $sql );
        
            $row = $qry->fetchAll();

            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    
    }

    public function ALL_GET_TEXTOS_SECCIONES(){

        try {
        
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT * 

                    FROM TEXTO A

                    JOIN SECCIONES_TEXTO B ON A.ID_SECCION = B.ID_SECCION";
        
            $qry = $db->query( $sql );
        
            $row = $qry->fetchAll();

            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    
    }

    public function ALL_GET_TEXTOS_SECCIONES_ID( $catId ){

        try {
        
            $db = Zend_Db_Table::getDefaultAdapter( $catId );

            $sql = "SELECT * 

                    FROM TEXTO A

                    JOIN SECCIONES_TEXTO B ON A.ID_SECCION = B.ID_SECCION

                    WHERE A.ID_SECCION = $catId ";
        
            $qry = $db->query( $sql );
        
            $row = $qry->fetchAll();

            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    
    }

    public function fnUpdate( $table, $post ){
        
        try {

            $db = Zend_Db_Table::getDefaultAdapter();

            $result = $db->query("UPDATE $table SET TEXTO_TITULO = ? , TEXTO = ?,  COLOR = ?  WHERE ID_TEXTO = ?", array(

                $post['TITULO'],

                $post['DESCRIPCION'],

                $post['COLOR'],

                $post['ID_TEXTO'],

            ));            

            $db->closeConnection();               
            
            if ( $result ) {

                $aResponse = array('status' => 1, 'ID_TEXTO' => $post['ID_TEXTO'], 'TITULO' =>  $post['TITULO'] , 'TEXTO_TITULO' => $post['DESCRIPCION'], 'COLOR' => $post['COLOR']);

            }else{

                $aResponse = array('status' => -1, 'ID_TEXTO' => $post['ID_TEXTO'], 'TITULO' =>  $post['TITULO'] , 'TEXTO_TITULO' => $post['DESCRIPCION'], 'COLOR' => $post['COLOR']);
                
            }

            return $aResponse;
        
        }catch (Exception $e) {
        
            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error al insertar');

            return $aResponse;
        
        }

    }

    public function ALL_GET_TEXTOS_CARRUSEL(){

        try {
        
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.imagen as IMAGEN, A.nombre as TEXTO_TITULO, A.descripcion AS TEXTO , A.color as COLOR 

                    FROM servicios A  WHERE A.tpo_seccion = 2";
        
            $qry = $db->query( $sql );
        
            $row = $qry->fetchAll();

            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    
    }


    public function Getcarrusel(){
        try {
        
            $db = Zend_Db_Table::getDefaultAdapter();
            $sql = "SELECT A.imagen as IMAGEN, A.nombre as TEXTO_TITULO, A.descripcion AS TEXTO , A.color as COLOR 
                    FROM servicios A  WHERE A.tpo_seccion = 2";
            $qry = $db->query( $sql );      
            $row = $qry->fetchAll();
            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    }


    public function QuienesSomos(){
        try {
        
            $db = Zend_Db_Table::getDefaultAdapter();
            $sql = "SELECT * FROM servicios  WHERE id in (1, 15, 16, 17)";
            $qry = $db->query( $sql );      
            $row = $qry->fetchAll();
            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    }


    public function Servicios(){
        try {
        
            $db = Zend_Db_Table::getDefaultAdapter();
            $sql = "SELECT * FROM servicios  WHERE id in (2, 3, 4, 5, 6, 7, 8, 9, 10, 11)";
            $qry = $db->query( $sql );      
            $row = $qry->fetchAll();
            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    }

     public function Footer(){
        try {
        
            $db = Zend_Db_Table::getDefaultAdapter();
            $sql = "SELECT * FROM footer";
            $qry = $db->query( $sql );      
            $row = $qry->fetchAll();
            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    }

    public function ClientesLogos(){
        try {
        
            $db = Zend_Db_Table::getDefaultAdapter();
            $sql = "SELECT * FROM clientes";
            $qry = $db->query( $sql );      
            $row = $qry->fetchAll();
            $db->closeConnection();
            
            return $row;
        
        } catch (Exception $e) {
        
            echo $e;
        
        }
    }
}