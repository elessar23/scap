<?php
require_once('/herramientas/parametros/ubicacion/dao_ubicacion.php');

class ci_localidades extends scap_ci
{

	protected $filtro;
	protected $s__seleccion;
	protected $s__datos_filtro;
	protected $s__where;  


	//-----------------------------------------------------------------------------------
	//---- filtro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__filtro(scap_ei_filtro $filtro)
	{
		if (isset ($this->s__datos_filtro)) { 
			$filtro->set_datos($this->s__datos_filtro);
			$this->s__where = $filtro->get_sql_where();
		}
	}

	function evt__filtro__filtrar($datos)
	{
		$this->s__datos_filtro = $datos;
	}

	function evt__filtro__cancelar()
	{
		unset($this->s__datos_filtro);
	}

	
	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro(scap_ei_cuadro $cuadro)
	{
		if (isset($this->s__datos_filtro)) {
			$datos = dao_ubicacion::get_listado_localidades($this->s__where);
		} else {
			$datos = dao_ubicacion::get_listado_localidades();
		}
		$cuadro->set_datos($datos);
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->cargar_localidad($seleccion);
		$this->cn()->set_cursor_localidad($seleccion);
		$this->set_pantalla('pant_edicion');

	}

	function evt__cuadro__eliminar($seleccion)
	{
		$this->cn()->cargar_localidad($seleccion);     
		$this->cn()->eliminar_localidad($seleccion);
		try
		{
			$this->cn()->guardar_dr_ubicacion();
		} catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23503') { 
				toba::notificacion()->agregar('La Localidad que desea eliminar esta asociada a una Provincia', 'error');
				$this->cn()->resetear_dr_ubicacion();
			}    
		}
		$this->cn()->resetear_dr_ubicacion();
		$this->set_pantalla('pant_inicial');  
	}

	//-----------------------------------------------------------------------------------
	//---- frm_localidad ----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__frm_localidad(scap_ei_formulario $form)
	{
		if ($this->cn()->hay_cursor_localidad()) {
			$datos = $this->cn()->get_localidad();
			$form->set_datos($datos);
		}    
	}

	function evt__frm_localidad__alta($datos)
	{
		$this->cn()->agregar_localidad($datos);
		try
		{
			$this->cn()->guardar_dr_ubicacion();
		} catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505') {
				toba::notificacion()->agregar('La Localidad que desea dar de alta ya existe', 'info');
				$this->cn()->resetear_dr_ubicacion();
			}
		}
		$this->set_pantalla('pant_inicial');
	}

	function evt__frm_localidad__modificacion($datos)
	{
		if ($this->cn()->hay_cursor_localidad()) {
			$this->cn()->set_localidad($datos);
			$this->cn()->guardar_dr_ubicacion();
		}
		$this->cn()->resetear_dr_ubicacion();
		$this->set_pantalla('pant_inicial');
	}

	function evt__frm_localidad__cancelar()
	{
		$this->cn()->resetear_dr_ubicacion();
		$this->set_pantalla('pant_inicial');
	}


	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resetear_dr_ubicacion();
		$this->set_pantalla('pant_edicion');
	}

	
}
?>