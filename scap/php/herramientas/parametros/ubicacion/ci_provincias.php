<?php
require_once('/herramientas/parametros/ubicacion/dao_ubicacion.php');
class ci_provincias extends scap_ci
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
			$datos = dao_ubicacion::get_listado_provincias($this->s__where);
		} else {
			$datos = dao_ubicacion::get_listado_provincias();
		}
		$cuadro->set_datos($datos);
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->cargar_provincia($seleccion);
		$this->cn()->set_cursor_provincia($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__eliminar($seleccion)
	{
		$this->cn()->cargar_provincia($seleccion);     
		$this->cn()->eliminar_provincia($seleccion);
		try
		{
			$this->cn()->guardar_dr_ubicacion();
		} catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23503') { 
				toba::notificacion()->agregar('La Provincia que desea eliminar est aasociada a un provincia', 'error');
				$this->cn()->resetear_dr_ubicacion();
			}    
		}
		$this->cn()->resetear_dr_ubicacion();
		$this->set_pantalla('pant_inicial');      
	}

	//-----------------------------------------------------------------------------------
	//---- frm_provincia ----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__frm_provincia(scap_ei_formulario $form)
	{
		if ($this->cn()->hay_cursor_provincia()) {
			$datos = $this->cn()->get_provincia();
			$form->set_datos($datos);
		}    
	}

	function evt__frm_provincia__alta($datos)
	{
		$this->cn()->agregar_provincia($datos);
		try
		{
			$this->cn()->guardar_dr_ubicacion();
		} catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505') {
				toba::notificacion()->agregar('La Provinca que desea dar de alta ya existe', 'info');
				$this->cn()->resetear_dr_ubicacion();
			}
		}
		$this->set_pantalla('pant_inicial');
	}

	function evt__frm_provincia__modificacion($datos)
	{
		if ($this->cn()->hay_cursor_provincia()) {
			$this->cn()->set_provincia($datos);
			$this->cn()->guardar_dr_ubicacion();
		}
		$this->cn()->resetear_dr_ubicacion();
		$this->set_pantalla('pant_inicial');
	}

	function evt__frm_provincia__cancelar()
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