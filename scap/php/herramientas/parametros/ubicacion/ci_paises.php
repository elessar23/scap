<?php

require_once('/herramientas/parametros/ubicacion/dao_ubicacion.php');

class ci_paises extends scap_ci
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
			$datos = dao_ubicacion::get_listado_paises($this->s__where);
		} else {
			$datos = dao_ubicacion::get_listado_paises();
		}
		$cuadro->set_datos($datos);
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->cargar_pais($seleccion);
		$this->cn()->set_cursor_pais($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__eliminar($seleccion)
	{
		$this->cn()->cargar_pais($seleccion);     
		$this->cn()->eliminar_pais($seleccion);
		try {
			$this->cn()->guardar_dr_ubicacion();
		} catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23503') { 
				toba::notificacion()->agregar('El Pais que desea eliminar posee provincias', 'error');
				$this->cn()->resetear_dr_ubicacion();
			}    
		}
		$this->cn()->resetear_dr_ubicacion();
		$this->set_pantalla('pant_inicial');      
	}
	

	//-----------------------------------------------------------------------------------
	//---- frm_pais ---------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__frm_pais(scap_ei_formulario $form)
	{
		if ($this->cn()->hay_cursor_pais()) {
			$datos = $this->cn()->get_pais();
			$form->set_datos($datos);
		}    
	}

	function evt__frm_pais__alta($datos)
	{
		$this->cn()->agregar_pais($datos);
		try {
			$this->cn()->guardar_dr_ubicacion();
		} catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505') {
				toba::notificacion()->agregar('El Pais que desea dar de alta ya existe', 'info');
				$this->cn()->resetear_dr_ubicacion();
			}
		}
		$this->set_pantalla('pant_inicial');
	}

	function evt__frm_pais__modificacion($datos)
	{
		if ($this->cn()->hay_cursor_pais()) {
			$this->cn()->set_pais($datos);
			$this->cn()->guardar_dr_ubicacion();
		}
		$this->cn()->resetear_dr_ubicacion();
		$this->set_pantalla('pant_inicial');
	}

	function evt__frm_pais__cancelar()
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