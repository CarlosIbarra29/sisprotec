<?php
class QuienesController extends Zend_Controller_Action{
 
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

        $this->_servicio = new Application_Model_ServiciosModel;

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
        
        $this->view->quienessomos = $this->_season->quienessomos();      
        $this->view->slider = $this->_season->sliderprincipal();
        $this->view->seccion = $this->_season->secciones();
    }

    public function requestaupdatequienesAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        
        if($this->getRequest()->getPost()){
            
            $id=1;
            $result = $this->_servicio->updatequienessomos($post,$id);

            if ($result) {
                return $this-> _redirect('/quienes/index');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }

    }

    public function requestaupdatesliderAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

        if($this->getRequest()->getPost()){
            
            $name_uno = $_FILES['file_uno']['name'];
            if(empty($name_uno)){ 
                $urldb = $post['url_uno'];
            }else{
                $bytes = $_FILES['file_uno']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info = new SplFileInfo($_FILES['file_uno']['name']);
                    $ext = $info->getExtension();
                    $url = 'img/slider/';
                    $urldb = $url.$info;
                    move_uploaded_file($_FILES['file_uno']['tmp_name'],$urldb);
                }
            }

            $name_dos = $_FILES['file_dos']['name'];
            if(empty($name_dos)){ 
                $urldb_dos = $post['url_dos'];
            }else{
                $bytes = $_FILES['file_dos']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info = new SplFileInfo($_FILES['file_dos']['name']);
                    $ext = $info->getExtension();
                    $url = 'img/slider/';
                    $urldb_dos = $url.$info;
                    move_uploaded_file($_FILES['file_dos']['tmp_name'],$urldb_dos);
                }
            }

            $name_tres = $_FILES['file_tres']['name'];
            if(empty($name_tres)){ 
                $urldb_tres = $post['url_tres'];
            }else{
                $bytes = $_FILES['file_tres']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info = new SplFileInfo($_FILES['file_tres']['name']);
                    $ext = $info->getExtension();
                    $url = 'img/slider/';
                    $urldb_tres = $url.$info;
                    move_uploaded_file($_FILES['file_tres']['tmp_name'],$urldb_tres);
                }
            }

            $this->_servicio->updateslider_uno($post,$urldb);
            $this->_servicio->updateslider_dos($post,$urldb_dos);
            $result = $this->_servicio->updateslider_tres($post,$urldb_tres);

            if ($result) {
                return $this-> _redirect('/quienes/index');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }   

    }

    public function requestupdsteseccionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

        if($this->getRequest()->getPost()){
 
            if($post['id'] == 15){
                $name_mision = $_FILES['file_mision']['name'];
                if(empty($name_mision)){ 
                    $urldb_mision = $post['url_mision'];
                }else{
                    $bytes = $_FILES['file_mision']['size'];
                    $res = $this->formatSizeUnits($bytes);
                    if($res == 0){ 
                        print '<script language="JavaScript">'; 
                        print 'alert("La imagen supera el maximo de tamaño");'; 
                        print '</script>'; 
                    }else{
                        $info = new SplFileInfo($_FILES['file_mision']['name']);
                        $ext = $info->getExtension();
                        $url = 'img/';
                        $urldb_mision = $url.$info;
                        move_uploaded_file($_FILES['file_mision']['tmp_name'],$urldb_mision);
                    }
                }
                $desc = $post['mision'];
                $result = $this->_servicio->updatesecciones($post,$urldb_mision,$desc);
            }

            if($post['id'] == 16){
                $name_vision = $_FILES['file_vision']['name'];
                if(empty($name_vision)){ 
                    $urldb_vision = $post['url_vision'];
                }else{
                    $bytes = $_FILES['file_vision']['size'];
                    $res = $this->formatSizeUnits($bytes);
                    if($res == 0){ 
                        print '<script language="JavaScript">'; 
                        print 'alert("La imagen supera el maximo de tamaño");'; 
                        print '</script>'; 
                    }else{
                        $info = new SplFileInfo($_FILES['file_vision']['name']);
                        $ext = $info->getExtension();
                        $url = 'img/';
                        $urldb_vision = $url.$info;
                        move_uploaded_file($_FILES['file_vision']['tmp_name'],$urldb_vision);
                    }
                }

                $desc = $post['vision'];
                $result = $this->_servicio->updatesecciones($post,$urldb_vision,$desc);
            }

            if($post['id'] == 17){
                $name_valores = $_FILES['file_valores']['name'];
                if(empty($name_valores)){ 
                    $urldb_vision = $post['url_valores'];
                }else{
                    $bytes = $_FILES['file_valores']['size'];
                    $res = $this->formatSizeUnits($bytes);
                    if($res == 0){ 
                        print '<script language="JavaScript">'; 
                        print 'alert("La imagen supera el maximo de tamaño");'; 
                        print '</script>'; 
                    }else{
                        $info = new SplFileInfo($_FILES['file_valores']['name']);
                        $ext = $info->getExtension();
                        $url = 'img/';
                        $urldb_valores = $url.$info;
                        move_uploaded_file($_FILES['file_valores']['tmp_name'],$urldb_valores);
                    }
                }
                
                $desc = $post['valores'];
                $result = $this->_servicio->updatesecciones($post,$urldb_valores,$desc);
            }

            if ($result) {
                return $this-> _redirect('/quienes/index');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }       
    }


    public function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }
        return $bytes;
    }//END FUNCION DE TAMAÑO DE IMAGEN



}