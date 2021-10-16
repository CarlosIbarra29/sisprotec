<?php

class Application_Model_GpsPanelModel extends Zend_Db_Table_Abstract{
    protected $_name = 'semanatres_bts';
    protected $_primary = 'id';

    public function insertfotopreliminarsemanatres($post,$table){
        try {
            $row = $this->createRow();
            $row->idsitio_tipo = $post['sitio'];
            $res = $row->save();              
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }// END INSERT CERTIFICADO MEDICO PERSONAL DE CAMPO


    public function insertcontacto($post,$table,$hoy){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'nombre'=>$post['namecontacto'],
                'email_personal'=>$post['mailcontacto'],
                'mensaje'=>$post['message'],
                'empresa'=>$post['empresa'],
                'fecha_envio'=>$hoy
            ); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }// END INSERT USER
}