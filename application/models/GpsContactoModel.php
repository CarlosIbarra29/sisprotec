<?php

class Application_Model_GpsContactoModel extends Zend_Db_Table_Abstract{

    public function Getbandejaid($id){
         try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT c.id, c.nombre, c.email_personal, c.mensaje, c.status_leido, c.status_imp, c.created_at 
                        FROM contacto c
                        where c.id = ?",array($id));
            $row = $qry->fetchAll();
            $db->closeConnection();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function Getbandeja($table,$status_leido,$status_imp){
         try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT c.id, c.nombre, c.email_personal, c.mensaje, c.status_leido, c.status_imp, c.created_at 
						FROM contacto c
						where c.status_leido = ? AND c.status_imp = ?",array($status_leido, $status_imp));
            $row = $qry->fetchAll();
            $db->closeConnection();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function getbandejapag($table,$status_leido,$status_imp,$offset,$no_of_records_per_page){
        try{
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT c.id, c.nombre, c.email_personal, c.mensaje, c.status_leido, c.status_imp, c.created_at 
						FROM contacto c
						where c.status_leido = ? AND c.status_imp = ? order by c.id DESC 
                        LIMIT $offset,$no_of_records_per_page",array($status_leido, $status_imp));
            $row = $qry->fetchAll();
            return $row;
            $db->closeConnection();
        }catch (Exception $e){
            echo $e;
        }
    }

    public function updatelido($post,$op){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE contacto SET status_leido = ? WHERE id = ?",array(
                $op,
                $post['id']));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE SERVICIO


    public function updateimportante($post,$op_leido,$op_imp){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE contacto SET status_leido = ?, status_imp = ? WHERE id = ?",array(
                $op_leido,
                $op_imp,
                $post['id']));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE SERVICIO


}