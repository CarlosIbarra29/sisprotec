<?php
class LandingController extends Zend_Controller_Action{

    private $_landing;
    
    public function init(){

        $this->_landing = new Application_Model_LandingModel;

    }    

    public function indexAction(){

        $this->_helper->layout()->setLayout('layout_landing');

        $aData = $this->_landing->ALL_GET_TEXTOS();

        print '<pre>';

        var_dump($aData);

        print '</pre>';

        $this->view->aData = $aData;

    }




}