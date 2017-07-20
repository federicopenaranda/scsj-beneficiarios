<?php
/**
 * Esta es la accion para el controlador PrivilegiosUsuario
 */
class Insert extends CAction
{
	/**
    * Esta accion inserta las 4 acciones (create,read,update,delete) por cada tabla de la base de datos.
    */
	public function run()
	{
    	$controller=$this->getController();
		$respuesta=new stdClass();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
		if ($error == "") {
        	$callback=$_GET['callback'];
        	$arreglo=array (
'Actividad',
'ActividadAreaActividad',
'ActividadFavorita',
'ActividadTipoActividad',
'AreaActividad',
'AreaConocimientoBiblioteca',
'Asistencia',
'AtencionMedicaEnfermedadComun',
'Beneficiario',
'BeneficiarioActividadFavorita',
'BeneficiarioAsistencia',
'BeneficiarioDonante',
'BeneficiarioEntidad',
'BeneficiarioEstadoBeneficiario',
'BeneficiarioEstadoCivil',
'BeneficiarioFamilia',
'BeneficiarioIdioma',
'BeneficiarioOcupacion',
'BeneficiarioOtrosProgramas',
'BeneficiarioPatrocinador',
'BeneficiarioTelefono',
'BeneficiarioTipo',
'BeneficiarioTipoIdentificacion',
'BeneficiarioTrabajo',
'BeneficiarioUnidadEducativa',
'Biblioteca',
'Departamento',
'Diagnostico',
'Donante',
'EdadesBeneficiario',
'EnfermedadComun',
'Entidad',
'EntidadEstadoEntidad',
'EntidadSalud',
'Escolaridad',
'EstadoAsistencia',
'EstadoBeneficiario',
'EstadoCivil',
'EstadoEntidad',
'EvalAtencionMedica',
'EvalComputacion',
'EvalEduChildfund',
'EvalEduNelsonOrtiz',
'EvalEnfermeria',
'EvalNutricion',
'EvalOdontologia',
'EvalPedagogico',
'EvalPsicologico',
'EventoVitalFamilia',
'Familia',
'FamiliaDireccion',
'FamiliaMetodoPlanificacionFamiliar',
'FamiliaServicioBasico',
'FamiliaTipoCasa',
'Gestion',
'GestionBeneficiario',
'Idioma',
'Localidad',
'LogSistema',
'LugarActividad',
'MetodoPlanificacionFamiliar',
'Ocupacion',
'OtrosProgramas',
'ParametrosGenerales',
'Parentesco',
'Patrocinador',
'PersonalAsistencia',
'PrivilegiosTipoUsuario',
'PrivilegiosUsuario',
'Provincia',
'Religion',
'Sector',
'ServicioBasico',
'SubArea',
'TipoActividad',
'TipoActorBeneficiario',
'TipoCasa',
'TipoCocina',
'TipoConsulta',
'TipoDonante',
'TipoEntidad',
'TipoEventoVital',
'TipoIdentificacion',
'TipoLugar',
'TipoParentesco',
'TipoPatrocinador',
'TipoProblematica',
'TipoUsuario',
'UnidadEducativa',
'Usuario',
'UsuarioBeneficiario',
'UsuarioEntidad',
'UsuarioLugar',
'Vacuna',
'Zona',
            );
            foreach ($arreglo as $valor) {
                
                for ($i=1;$i<=4;$i++) {
                    $model=new PrivilegiosUsuario();
                    switch ($i) {
                        case 1:
                            $model->accion_privilegio_usuario="create";
                            $model->nombre_privilegio_usuario="crea ".$valor;
                        break;
                        case 2:
                            $model->accion_privilegio_usuario="read";
                            $model->nombre_privilegio_usuario="lee ".$valor;
                        break;
                        case 3:
                            $model->accion_privilegio_usuario="update";
                            $model->nombre_privilegio_usuario="actualiza ".$valor;
                        break;
                        case 4:
                            $model->accion_privilegio_usuario="delete";
                            $model->nombre_privilegio_usuario="elimina ".$valor;
                        break;
                     }  
					$model->opciones_privilegio_usuario="controlador";
					if ($model->validate())
						$model->save(); 
                }
            }
            $respuesta->meta=array("success"=>"true","msg"=>"Registros Creados!!");
            $controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}