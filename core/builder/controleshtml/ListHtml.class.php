<?php
class ListHTML{
    
    
    function listaNoOrdenada($atributos) {
    
        if (isset ( $atributos ['id'] )) {
            $this->cadenaHTML = "<ul id='" . $atributos ['id'] . "'>";
        } else {
            $this->cadenaHTML = "<ul>";
        }
    
        foreach ( $atributos ["items"] as $clave => $valor ) {
            $this->cadenaHTML .= "<li>";
    
            $this->procesarValor ( $valor, $atributos );
    
            $this->cadenaHTML .= "</li>";
        }
    
        $this->cadenaHTML .= "</ul>";
    
        return $this->cadenaHTML;
    
    }
    
    private function procesarValor($valor, $atributos) {
        if (is_array ( $valor )) {
    
            if (isset ( $valor ['icono'] )) {
                $icono = '<span class="ui-accordion-header-icon ui-icon ' . $valor ['icono'] . '"></span>';
            } else {
                $icono = '';
            }
    
            if (isset ( $valor ['enlace'] ) && $atributos ['estilo'] == self::JQUERYUI) {
                $this->cadenaHTML .= "<a  id='pes" . $clave . "' href='" . $valor ['urlCodificada'] . "'>";
                $this->cadenaHTML .= "<div id='tab" . $clave . "' class='ui-accordion ui-widget ui-helper-reset'>";
                $this->cadenaHTML .= "<h3 class='ui-accordion-header ui-state-default ui-accordion-icons ui-corner-all'>" . $icono . $valor ['nombre'] . "</h3>";
                $this->cadenaHTML .= "</div>";
                $this->cadenaHTML .= "</a>";
            }
        } else {
            // Podría implementarse llamando a $this->enlace
            if (isset ( $atributos ["pestañas"] ) && $atributos ["pestañas"] == "true") {
                $this->cadenaHTML .= "<a id='pes" . $clave . "' href='#" . $clave . "'><div id='tab" . $clave . "'>" . $valor . "</div></a>";
            }
    
            if (isset ( $atributos ["enlaces"] ) && $atributos ["enlaces"] == "true") {
                $enlace = explode ( '|', $valor );
                $this->cadenaHTML .= "<a href='" . $enlace [1] . "'>" . $enlace [0] . "</a>";
            }
        }
    
        return true;
    }
    
    
    
}