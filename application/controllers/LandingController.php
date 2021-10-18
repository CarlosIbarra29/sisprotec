<?php
class LandingController extends Zend_Controller_Action{

    private $_landing;
    
    public function init(){

        $this->_landing = new Application_Model_LandingModel;

    }    

    public function indexAction(){

        $this->_helper->layout()->setLayout('layout_landing');

        $table="servicios";
        $this->view->Carrusel = $this->_landing->Getcarrusel();

        $this->view->QuienesSomos = $this->_landing->QuienesSomos();

        $this->view->Servicios = $this->_landing->Servicios();
        $this->view->Footer = $this->_landing->Footer();

    }




}