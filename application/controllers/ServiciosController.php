<?php

class ServiciosController extends Zend_Controller_Action{

	private $_session;
	private $_orden;
    private $_season;
    public function init(){

        $this->_season = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_panel = new Application_Model_GpsPanelModel;
        $this->_user = new Application_Model_GpsUserModel;
        $this->_servicio = new Application_Model_ServiciosModel;
    }

    public function serviciosAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

        $table="servicios";
        $servicio=$this->_season->GetAll($table);
        $count=count($servicio);
        if (isset($_GET['pagina'])) {$pagina = $_GET['pagina'];} else {$pagina= $this->view->pagina = 1;} 

        $no_of_records_per_page = 15;
        $offset = ($pagina-1) * $no_of_records_per_page; 
        $total_pages= $count;

        $this->view->totalpage = $total_pages;
        $this->view->total=ceil($total_pages/$no_of_records_per_page);
        $sql= $this->view->paginator= $this->_servicio->Getpaginationservicio($table,$offset,$no_of_records_per_page);



        $id = 2; // SERVICIO
        $table="texto";
        $wh="ID_TEXTO";
        $this->view->serv_principal = $this->_season->GetSpecific($table,$wh,$id);


    }

    public function editarprincipalAction(){
        $id = 2; // SERVICIO
        $table="texto";
        $wh="ID_TEXTO";
        $this->view->serv_principal = $this->_season->GetSpecific($table,$wh,$id);      
    }

    public function crearservicioAction(){

    }

    public function editarservicioAction(){
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="servicios";
            $wh="id";
            $this->view->servicio = $this->_season->GetSpecific($table,$wh,$id);
        }else {
            return $this-> _redirect('/servicios/servicios');
        }
    }


    public function requestupdateservicioprincipalAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        
        if($this->getRequest()->getPost()){

            $name = $_FILES['url']['name'];
            if(empty($name)){ 
                $urldb = $post['img_actual'];
            }else{
                $bytes = $_FILES['url']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info = new SplFileInfo($_FILES['url']['name']);
                    $ext = $info->getExtension();
                    $url = 'img/servicios/';
                    $urldb = $url.$info;
                    move_uploaded_file($_FILES['url']['tmp_name'],$urldb);
                }
            }

            $table="texto";
            $result = $this->_servicio->updateservicioprincipal($post,$table,$urldb);

            if ($result) {
                return $this-> _redirect('/servicios/servicios');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestaddservicoAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        
        if($this->getRequest()->getPost()){

            $name = $_FILES['url']['name'];
            if(empty($name)){ 
                print '<script language="JavaScript">'; 
                print 'alert("Agrega una imagen");'; 
                print '</script>'; 
            }else{
                $bytes = $_FILES['url']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info = new SplFileInfo($_FILES['url']['name']);
                    $ext = $info->getExtension();
                    $url = 'img/servicios/';
                    $urldb = $url.$info;
                    move_uploaded_file($_FILES['url']['tmp_name'],$urldb);
                }
            }

            $table="servicios";
            $result = $this->_servicio->insertservicio($post,$table,$urldb);

            if ($result) {
                return $this-> _redirect('/servicios/servicios');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }

    public function requestupdateservicioAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        
        if($this->getRequest()->getPost()){

            $name = $_FILES['url']['name'];
            if(empty($name)){ 
                $urldb = $post['img_actual'];
            }else{
                $bytes = $_FILES['url']['size'];
                $res = $this->formatSizeUnits($bytes);
                if($res == 0){ 
                    print '<script language="JavaScript">'; 
                    print 'alert("La imagen supera el maximo de tamaño");'; 
                    print '</script>'; 
                }else{
                    $info = new SplFileInfo($_FILES['url']['name']);
                    $ext = $info->getExtension();
                    $url = 'img/servicios/';
                    $urldb = $url.$info;
                    move_uploaded_file($_FILES['url']['tmp_name'],$urldb);
                }
            }

            $table="servicios";
            $result = $this->_servicio->updateservicio($post,$table,$urldb);

            if ($result) {
                return $this-> _redirect('/servicios/servicios');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }       
    }


    public function requestdeleteservicioAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        var_dump($post);exit;
        $id=$post['id'];
        $table="servicios";
        $wh="id";
        $result = $this->_season->deleteAll($id,$table,$wh);

        if ($result) {
            echo json_encode(array('status' => "1","message"=>"Se ha agregado correctamente", "data"=>$post));   
        }else{
            print '<script language="JavaScript">';
            print 'alert("Ocurrio un error: Comprueba los datos.");';
            print '</script>';
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