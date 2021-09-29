<?php
class LandingController extends Zend_Controller_Action{

    private $_landing;
    
    public function init(){

        $this->_landing = new Application_Model_LandingModel;

    }    

    public function indexAction(){

        $this->_helper->layout()->setLayout('layout_landing');

        $aData = $this->_landing->ALL_GET_TEXTOS();

        $aDataImg = $this->_landing->ALL_GET_TEXTOS_CARRUSEL();

        $this->view->aDataImg = $aDataImg;

        $this->view->aData = $aData;

    }




}