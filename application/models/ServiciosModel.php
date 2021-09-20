<?php

class Application_Model_ServiciosModel extends Zend_Db_Table_Abstract{


	public function insertservicio($post,$table,$urldb){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
     
            $datasave = array(
                'nombre'=>$post['name'],
            	'descripcion'=>$post['desc'],
            	'imagen'=>$urldb); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }// END INSERT SERVICIO

    public function updateservicio($post,$table,$urldb){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE $table SET nombre = ?, descripcion = ?, imagen = ? WHERE id = ?",array(
                $post['name'],
                $post['desc'],
                $urldb,
                $post["ids"]));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE SERVICIO


    public function Getpaginationservicio($table,$offset,$no_of_records_per_page){
        try{
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT s.id, s.nombre, s.descripcion, s.imagen
                FROM servicios s
                Order by id asc LIMIT $offset,$no_of_records_per_page");
            $row = $qry->fetchAll();
            return $row;
            $db->closeConnection();
        }catch (Exception $e){
            echo $e;
        }
    }

}