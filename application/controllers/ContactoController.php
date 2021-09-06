<?php
class ContactoController extends Zend_Controller_Action{
 
	private $_season;
    private $_session;
    private $_user;
    private $_epp;
    private $_contacto;
    
    public function init(){
        $this->_season = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_panel = new Application_Model_GpsPanelModel;
        $this->_user = new Application_Model_GpsUserModel;
        $this->_contacto = new Application_Model_GpsContactoModel;

        if(empty($this->_session->id)){
            $this->redirect('/home/login');
        }
        $id=$this->_session->id;
        $wh="id";
        $table="usuario";
        $usr = $this->_season->GetSpecific($table,$wh,$id);
        foreach ($usr as $key) {
           $fk=$key['fkroles'];
        }
        // if($fk!=1){
        //     $this->redirect('/home/perfilusuario');
        // }
    }//END INIT


    public function bandejaAction(){

        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

        $op=$this->_getParam('op');
        $this->view->op_bandeja=$op;

        $table="contacto";
        $status_leido = 0;
        $status_imp = 0;
        $col= $this->_contacto->Getbandeja($table,$status_leido,$status_imp);
        $this->view->count_correo= count($col);

        if($op == 0){
            $table="contacto";
            $status_leido = 0;
            $status_imp = 0;
            $pagi_count= $this->_contacto->Getbandeja($table,$status_leido,$status_imp);
            $count=count($pagi_count);
            if(isset($_GET['pagina'])){$pagina = $_GET['pagina'];}else{$pagina= $this->view->pagina = 1;} 

            $no_of_records_per_page = 15;
            $offset = ($pagina-1) * $no_of_records_per_page; 
            $total_pages= $count;

            $this->view->totalpage = $total_pages;
            $this->view->total=ceil($total_pages/$no_of_records_per_page);
            $sql= $this->view->paginator= $this->_contacto->getbandejapag($table,$status_leido,$status_imp,$offset,$no_of_records_per_page);
        }

        if($op == 1){
            $table="contacto";
            $status_leido = 1;
            $status_imp = 0;
            $pagi_count= $this->_contacto->Getbandeja($table,$status_leido,$status_imp);
            $count=count($pagi_count);
            if(isset($_GET['pagina'])){$pagina = $_GET['pagina'];}else{$pagina= $this->view->pagina = 1;} 

            $no_of_records_per_page = 15;
            $offset = ($pagina-1) * $no_of_records_per_page; 
            $total_pages = $count;

            $this->view->totalpage = $total_pages;
            $this->view->total=ceil($total_pages/$no_of_records_per_page);
            $sql= $this->view->paginator= $this->_contacto->getbandejapag($table,$status_leido,$status_imp,$offset,$no_of_records_per_page);
        }

        if($op == 2){
            $table="contacto";
            $status_leido = 1;
            $status_imp = 1;
            $pagi_count= $this->_contacto->Getbandeja($table,$status_leido,$status_imp);
            $count=count($pagi_count);
            if(isset($_GET['pagina'])){$pagina = $_GET['pagina'];}else{$pagina= $this->view->pagina = 1;} 

            $no_of_records_per_page = 15;
            $offset = ($pagina-1) * $no_of_records_per_page; 
            $total_pages= $count;

            $this->view->totalpage = $total_pages;
            $this->view->total=ceil($total_pages/$no_of_records_per_page);
            $sql= $this->view->paginator= $this->_contacto->getbandejapag($table,$status_leido,$status_imp,$offset,$no_of_records_per_page);
        }
    }

    public function bandejadetailAction(){
        $id=$this->_getParam('id');
        $this->view->id_correo=$id;
        $this->view->info_correo= $this->_contacto->Getbandejaid($id);
    }


}