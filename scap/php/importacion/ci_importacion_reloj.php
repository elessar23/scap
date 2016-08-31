<?php

//php_referencia::instancia()->agregar(__FILE__);

class ci_importacion_reloj extends scap_ci
{
	//public $s__nombre_archivo;
	//-----------------------------------------------------------------------------------
	//---- frm --------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__frm()
	{
		/*if (isset($this->s__nombre_archivo)){
            return array( 'archivo' => $this->s__nombre_archivo );
          }*/
	}

	function evt__frm__cargar()
	{
		/*if isset($datos['archivo']) {
			$this->s__nombre_archivo = $datos['archivo']['name'];
			foreach ($this->s__nombre_archivo as $rel ) {
			$reloj = array_values(array_filter(explode(' ', $rel)));
			ei_arbol($reloj);
			}
		}*/
		$archivo = file('C:\Users\pescalante\Desktop\reloj.kq');
		foreach ($archivo as $rel) {
			$reloj = array_values(array_filter(explode(' ', $rel)));
			ei_arbol($reloj);
		}
					
	}
}

?>