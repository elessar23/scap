<?php
class dao_ubicacion
{
	//Paises

	function get_listado_paises($where=null)
	{
		$sql="";
		if (isset($where)){
			$sql = "SELECT id_pais, pais FROM scap_paises where $where";	
		}else{
			$sql = "SELECT id_pais, pais FROM scap_paises";
	}
	return consultar_fuente($sql);
	}

	function get_paises(){
		$sql="";
		$sql="SELECT id_pais, pais FROM scap_paises order by pais";
		return consultar_fuente($sql);
	}
	
	//Provincias

	function get_listado_provincias($where = null)
	{
		$sql="";
		if (isset($where)) {
			$sql = "SELECT id_prov, pais, provincia FROM scap_provincias pr
					INNER JOIN scap_paises p ON p.id_pais=pr.id_pais  $where";
		} else {
			$sql = "SELECT id_prov, pais, provincia FROM scap_provincias pr
					INNER JOIN scap_paises p ON p.id_pais=pr.id_pais  ";
		}
	return consultar_fuente($sql);
	}

	function get_pais_prov($id_prov = null){
		$sql="";
		$sql="SELECT id_pais FROM scap_provincias where id_prov=$id_prov";
		return consultar_fuente($sql);
	}
	
	
	function get_provincias($id_pais = null)
	{
		$sql="";
		$sql="SELECT id_prov, provincia FROM scap_provincias where id_pais=$id_pais";
		return consultar_fuente($sql);
	}


	//Localidades

	function get_listado_localidades($where = null)
	{
	$sql="";
		if (isset($where)) {
			$sql = "SELECT l.id_loc, ps.pais, p.provincia,l.localidad, l.cp FROM scap_localidades l
					INNER JOIN scap_provincias p on l.id_prov=p.id_prov
					INNER JOIN scap_paises ps on ps.id_pais=p.id_pais $where";
		} else {
			$sql = "SELECT l.id_loc, ps.pais, p.provincia,l.localidad, l.cp FROM scap_localidades l
					INNER JOIN scap_provincias p on l.id_prov=p.id_prov
					INNER JOIN scap_paises ps on ps.id_pais=p.id_pais";	
		}
	return consultar_fuente($sql);
	}	

	function get_pais_loc($id_loc = null)
	{
		$sql="";
			$sql=" SELECT pr.id_pais from scap_localidades l
				   INNER JOIN scap_provincias pr on pr.id_prov = l.id_prov
				   WHERE l.id_loc= $id_loc ";
		return consultar_fuente($sql);
	}
	
	function get_prov_loc($id_loc = null)
	{
		$sql="";
			$sql="SELECT id_prov FROM scap_localidades WHERE id_loc= $id_loc ";
		return consultar_fuente($sql);
	}
		
	function get_localidad_prov($id_prov = null)
	{
		$sql="";
		$sql="SELECT id_loc, localidad FROM scap_localidades where id_prov=$id_prov";
		return consultar_fuente($sql);
	}
	
	function get_localidades()
	{
		$sql="";
		$sql="SELECT id_loc, localidad FROM scap_localidades ";
		return consultar_fuente($sql);
	}


	//Tipos de Documentos

	function get_listado_tipo_doc($where = null){
	$sql="";
		if (isset($where)) {
			$sql="SELECT id_tipo_doc, sigla, descrip_tipo_doc  FROM scap_tipo_doc  where $where";
		} else {
			$sql="SELECT id_tipo_doc, sigla, descrip_tipo_doc  FROM scap_tipo_doc  order by sigla";
		}
		return consultar_fuente($sql);
	}
	
	function get_tipo_doc ()
	{
		$sql= "";
		$sql= "SELECT id_tipo_doc, sigla  FROM scap_tipo_doc  order by sigla";
		return consultar_fuente($sql);
	}
}	
?>	