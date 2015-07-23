<?php
namespace development\saraFormCreator\builder;

if (! isset ( $GLOBALS ['autorizado'] )) {
	include ('index.php');
	exit ();
}

class formCreator {
	
	var $atributos;
	
	var $cadenaHTML;
	
	function setAtributos($misAtributos) {
	
		$this->atributos = $misAtributos;
	
	}

    function formulario($atributos) {
    	
        $this->setAtributos ( $atributos );
        
        $this->cadenaHTML = '';
        
        $this->cadenaHTML .= $this->createWrapper();
        
        return $this->cadenaHTML;
    
    }
    
    private function createModal(){
        
    	$htmlModal = file_get_contents('modal.html.php', true);
        return $htmlModal;
        
    }  
    private function createPageContentWrapper(){
    
    	$htmlModal = file_get_contents('page-content-wrapper.html.php', true);
    	return $htmlModal;
    
    }
    private function createSidebarWrapper(){
    
    	$htmlModal = file_get_contents('sidebar-wrapper.html.php', true);
    	return $htmlModal;
    
    }
    private function createWrapper(){
    	$inicio = '<!-- #Wrapper -->';
    	$inicio .= '<div id="wrapper">';
    	
    	$fin = '</div>';
    	$fin .= '<!-- /#wrapper -->';
    	
    	$html = $this->createModal();
    	$html .= $this->createSidebarWrapper();
    	$html .= $this->createPageContentWrapper();
    	return $inicio.$html.$fin;
    
    }
    
}