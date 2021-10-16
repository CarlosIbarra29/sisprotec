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

    public function updateservicioprincipal($post,$table,$urldb){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE $table SET TEXTO_TITULO = ?, TEXTO = ?, IMAGEN = ? WHERE ID_TEXTO = ?",array(
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


    public function updatequienessomos($post, $id){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE servicios SET descripcion = ? WHERE id = ?",array(
                $post['desc'],
                $id));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE SERVICIO

    public function updateslider_uno($post,$urldb){
        $id = 12;
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE servicios SET imagen = ? WHERE id = ?",array(
                $urldb,
                $id));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE SERVICIO

    public function updateslider_dos($post,$urldb_dos){
        $id = 13;
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE servicios SET imagen = ? WHERE id = ?",array(
                $urldb_dos,
                $id));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE SERVICIO

    public function updateslider_tres($post,$urldb_tres){
        $id = 14;
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE servicios SET imagen = ? WHERE id = ?",array(
                $urldb_tres,
                $id));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE SERVICIO

    public function updatesecciones($post,$imagen,$desc){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE servicios SET descripcion = ?, imagen = ? WHERE id = ?",array(
                $desc,
                $imagen,
                $post['id']));
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
                FROM servicios s where id != 1 AND id !=12 AND id !=13 AND id !=14 AND id !=15 AND id !=16 AND id !=17
                Order by id asc LIMIT $offset,$no_of_records_per_page");
            $row = $qry->fetchAll();
            return $row;
            $db->closeConnection();
        }catch (Exception $e){
            echo $e;
        }
    }

}