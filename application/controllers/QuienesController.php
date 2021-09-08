<?php
class quienesController extends Zend_Controller_Action{
 
	private $_season;
    
    private $_session;
    
    private $_user;
    
    private $_epp;

    private $_landing;
    
    public function init(){

        $this->_season = new Application_Model_SeasonPanelModel;
        
        $this->_session = new Zend_Session_Namespace("current_session");
        
        $this->_panel = new Application_Model_GpsPanelModel;
        
        $this->_user = new Application_Model_GpsUserModel;

        $this->_landing = new Application_Model_LandingModel;

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

    }

     public function indexAction(){
        
        $aData = $this->_landing->ALL_GET_TEXTOS_SECCIONES();

        $this->view->aData = $aData;

    }

    public function updateAction(){

        $id = $_GET['catId'];

        if ( isset( $id )) {
            
            $aData = $this->_landing->ALL_GET_TEXTOS_SECCIONES_ID( $id );

            $this->view->aData = $aData;
        
        }

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TEXTO'] = $_POST['ID_TEXTO'];

            $aDataIn['TITULO'] = $_POST['TITULO'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            $aDataIn['COLOR'] = $_POST['COLOR'];

            $fnUpdate =  $this->view->aResponse = $this->_landing->fnUpdate( 'TEXTO', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_landing->ALL_GET_TEXTOS_SECCIONES_ID( $fnUpdate['ID_TEXTO'] );

            $this->view->aData = $aData;

        }
        
    }

}