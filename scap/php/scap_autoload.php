<?php
/**
 * Esta clase fue y será generada automáticamente. NO EDITAR A MANO.
 * @ignore
 */
class scap_autoload 
{
	static function existe_clase($nombre)
	{
		return isset(self::$clases[$nombre]);
	}

	static function cargar($nombre)
	{
		if (self::existe_clase($nombre)) { 
			 require_once(dirname(__FILE__) .'/'. self::$clases[$nombre]); 
		}
	}

	static protected $clases = array(
		'scap_ci' => 'extension_toba/componentes/scap_ci.php',
		'scap_cn' => 'extension_toba/componentes/scap_cn.php',
		'scap_datos_relacion' => 'extension_toba/componentes/scap_datos_relacion.php',
		'scap_datos_tabla' => 'extension_toba/componentes/scap_datos_tabla.php',
		'scap_ei_arbol' => 'extension_toba/componentes/scap_ei_arbol.php',
		'scap_ei_archivos' => 'extension_toba/componentes/scap_ei_archivos.php',
		'scap_ei_calendario' => 'extension_toba/componentes/scap_ei_calendario.php',
		'scap_ei_codigo' => 'extension_toba/componentes/scap_ei_codigo.php',
		'scap_ei_cuadro' => 'extension_toba/componentes/scap_ei_cuadro.php',
		'scap_ei_esquema' => 'extension_toba/componentes/scap_ei_esquema.php',
		'scap_ei_filtro' => 'extension_toba/componentes/scap_ei_filtro.php',
		'scap_ei_firma' => 'extension_toba/componentes/scap_ei_firma.php',
		'scap_ei_formulario' => 'extension_toba/componentes/scap_ei_formulario.php',
		'scap_ei_formulario_ml' => 'extension_toba/componentes/scap_ei_formulario_ml.php',
		'scap_ei_grafico' => 'extension_toba/componentes/scap_ei_grafico.php',
		'scap_ei_mapa' => 'extension_toba/componentes/scap_ei_mapa.php',
		'scap_servicio_web' => 'extension_toba/componentes/scap_servicio_web.php',
		'scap_comando' => 'extension_toba/scap_comando.php',
		'scap_modelo' => 'extension_toba/scap_modelo.php',
	);
}
?>