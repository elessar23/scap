<?php
class cn_ubicacion extends scap_cn
{
	function cargar_dr_ubicacion($id=null)
	{
		if (!$this->dep('dr_ubicacion')->esta_cargada()) {					// verifica si esta cargada el datos relacion
			if (!isset($id)) {
				$this->dep('dr_ubicacion')->cargar();					// lee de la BD fisica y carga al datos relacion
			} else {
				$this->dep('dr_ubicacion')->cargar($id);				// lee de la BD fisica y carga al datos relacion
			}
		}
	}

	function guardar_dr_ubicacion()
	{
		$this->dep('dr_ubicacion')->sincronizar();
	}

	function resetear_dr_ubicacion()
	{
		$this->dep('dr_ubicacion')->resetear();
	}

	//ABM Paises

	function cargar_pais($id=null)
	{
		if (!$this->dep('dr_ubicacion')->tabla('dt_paises')->esta_cargada()) {																					// verifica si esta cargada el datos relacion
			if (!isset($id)) {
				$this->dep('dr_ubicacion')->tabla('dt_paises')->cargar();					// lee de la BD fisica y carga al datos relacion
			} else {
				$this->dep('dr_ubicacion')->tabla('dt_paises')->cargar($id);				// lee de la BD fisica y carga al datos relacion
			}
		}
	}

	function get_pais()
	{
		return $this->dep('dr_ubicacion')->tabla('dt_paises')->get();
	}

	function set_cursor_pais($seleccion)
	{
		$id = $this->dep('dr_ubicacion')->tabla('dt_paises')->get_id_fila_condicion($seleccion);
		$this->dep('dr_ubicacion')->tabla('dt_paises')->set_cursor($id[0]);
	}

	function hay_cursor_pais()
	{
		return $this->dep('dr_ubicacion')->tabla('dt_paises')->hay_cursor();
	}

	function agregar_pais($datos)
	{
		$this->dep('dr_ubicacion')->tabla('dt_paises')->nueva_fila($datos);
	}

	function set_pais($datos)
	{
		$this->dep('dr_ubicacion')->tabla('dt_paises')->set($datos);
	}

	function modificar_pais($seleccion, $datos)
	{
		if ($this->dep('dr_ubicacion')->esta_cargada()) {
			$id = $this->dep('dr_ubicacion')->tabla('dt_paises')->get_id_fila_condicion($seleccion);
			$this->dep('dr_ubicacion')->tabla('dt_paises')->modificar_fila($id[0], $datos);
		}
	}

	function eliminar_pais($seleccion)
	{
		$id = $this->dep('dr_ubicacion')->tabla('dt_paises')->get_id_fila_condicion($seleccion);
		$this->dep('dr_ubicacion')->tabla('dt_paises')->eliminar_fila($id[0]);
	}

	//ABM Provincias

	function cargar_provincia($id=null) {

			if (!$this->dep('dr_ubicacion')->tabla('dt_provincias')->esta_cargada()) {																				// verifica si esta cargada el datos relacion
				if (!isset($id)) {
					$this->dep('dr_ubicacion')->tabla('dt_provincias')->cargar();					// lee de la BD fisica y carga al datos relacion
				} else {
					$this->dep('dr_ubicacion')->tabla('dt_provincias')->cargar($id);				// lee de la BD fisica y carga al datos relacion
				}
			}
	}

	function set_cursor_provincia($seleccion)
		{
			$id = $this->dep('dr_ubicacion')->tabla('dt_provincias')->get_id_fila_condicion($seleccion);
			$this->dep('dr_ubicacion')->tabla('dt_provincias')->set_cursor($id[0]);
		}

	function hay_cursor_provincia()
	{
		return $this->dep('dr_ubicacion')->tabla('dt_provincias')->hay_cursor();
	}

	function set_provincia($datos)
	{
		$this->dep('dr_ubicacion')->tabla('dt_provincias')->set($datos);
	}

	function get_provincia()
	{
		return $this->dep('dr_ubicacion')->tabla('dt_provincias')->get();
	}

	function agregar_provincia($datos)
	{
		$this->dep('dr_ubicacion')->tabla('dt_provincias')->nueva_fila($datos);
	}

	function modificar_provincia($seleccion, $datos)
	{
		if ($this->dep('dr_ubicacion')->esta_cargada()) {
			$id = $this->dep('dr_ubicacion')->tabla('dt_provincias')->get_id_fila_condicion($seleccion);
			//ei_arbol($id);
			$this->dep('dr_ubicacion')->tabla('dt_provincias')->modificar_fila($id[0], $datos);
		}
	}

	function eliminar_provincia($seleccion)
	{
		$id = $this->dep('dr_ubicacion')->tabla('dt_provincias')->get_id_fila_condicion($seleccion);
		$this->dep('dr_ubicacion')->tabla('dt_provincias')->eliminar_fila($id[0]);
		
	}

	//ABM Localidades

	function cargar_localidad($id = null)
	{
		if (!$this->dep('dr_ubicacion')->tabla('dt_localidades')->esta_cargada()) {																				// verifica si esta cargada el datos relacion
			if (!isset($id)) {
				$this->dep('dr_ubicacion')->tabla('dt_localidades')->cargar();					// lee de la BD fisica y carga al datos relacion
			} else {
				$this->dep('dr_ubicacion')->tabla('dt_localidades')->cargar($id);				// lee de la BD fisica y carga al datos relacion
			}
		}
	}

	function set_cursor_localidad($seleccion)
		{
			$id = $this->dep('dr_ubicacion')->tabla('dt_localidades')->get_id_fila_condicion($seleccion);
			//ei_arbol($id);
			$this->dep('dr_ubicacion')->tabla('dt_localidades')->set_cursor($id[0]);
		}

	function hay_cursor_localidad()
	{
		return $this->dep('dr_ubicacion')->tabla('dt_localidades')->hay_cursor();
	}

	function set_localidad($datos)
	{
		$this->dep('dr_ubicacion')->tabla('dt_localidades')->set($datos);
	}

	function get_localidad()
	{
		return $this->dep('dr_ubicacion')->tabla('dt_localidades')->get();
	}

	function agregar_localidad($datos) 
	{
		$this->dep('dr_ubicacion')->tabla('dt_localidades')->nueva_fila($datos);	
	}

	function modificar_localidad($seleccion, $datos)
	{
		if ($this->dep('dr_ubicacion')->esta_cargada()) {
			$id = $this->dep('dr_ubicacion')->tabla('dt_localidades')->get_id_fila_condicion($seleccion);
			$this->dep('dr_ubicacion')->tabla('dt_localidades')->modificar_fila($id[0], $datos);
		}
	}

	function eliminar_localidad($seleccion)
	{
		$id = $this->dep('dr_ubicacion')->tabla('dt_localidades')->get_id_fila_condicion($seleccion);
		$this->dep('dr_ubicacion')->tabla('dt_localidades')->eliminar_fila($id[0]);
	}
}

?>