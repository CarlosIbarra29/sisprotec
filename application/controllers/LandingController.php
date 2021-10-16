<?php
class LandingController extends Zend_Controller_Action{

    private $_landing;
    
    public function init(){

        $this->_landing = new Application_Model_LandingModel;

    }    

    public function indexAction(){

        $this->_helper->layout()->setLayout('layout_landing');

        // $aData = $this->_landing->ALL_GET_TEXTOS();

        // $aDataImg = $this->_landing->ALL_GET_TEXTOS_CARRUSEL();

        // $this->view->aDataImg = $aDataImg;

        // $this->view->aData = $aData;

        $table="servicios";
        $this->view->Carrusel = $this->_landing->Getcarrusel();
        // Where in (12, 13, 14)

        $this->view->QuienesSomos = $this->_landing->QuienesSomos();

        $this->view->Servicios = $this->_landing->Servicios();
        $this->view->Footer = $this->_landing->Footer();

    }




}