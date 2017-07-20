<?php
/**
 * Estas son la accion para el controlador "Usuario".
 */

class Create extends CAction
{
    /**
    * La funcion run ejecuta la logica de la accion
    * Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
    * @param array $callback se introduce el nombre de una funcion
    */
    public function run()
    {
        $controller=$this->getController();
        $respuesta=new stdClass();
        $model=new Usuario();
        $error="";
        $error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
        $error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";

        if ($error == "") 
        {
            $callback=$_GET['callback'];
            $query=explode('&', $_SERVER['QUERY_STRING']);
            $listaRecords=$model->divideRecords($query);
            $numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
                'actividad'=>'Actividad',
                'asistencia'=>'Asistencia',
                'biblioteca'=>'Biblioteca',
                'eval_atencion_medica'=>'EvalAtencionMedica',
                'eval_computacion'=>'EvalComputacion',
                'eval_edu_childfund'=>'EvalEduChildfund',
                'eval_edu_nelson_ortiz'=>'EvalEduNelsonOrtiz',
                'eval_enfermeria'=>'EvalEnfermeria',
                'eval_nutricion'=>'EvalNutricion',
                'eval_odontologia'=>'EvalOdontologia',
                'eval_pedagogico'=>'EvalPedagogico',
                'eval_psicologico'=>'EvalPsicologico',
                'log_sistema'=>'LogSistema',
                'personal_asistencia'=>'PersonalAsistencia',
                'usuario_beneficiario'=>'UsuarioBeneficiario',
                'usuario_entidad'=>'UsuarioEntidad',
                'usuario_lugar'=>'UsuarioLugar',
            );
        
            foreach ($listaRecords as $value)
            {
                $TotalEleVectores=0;
                $records=json_decode($value);
                
                foreach ($records as $propiedad => $valor)
                {
                    if (is_array($valor))
                    {
                        $TotalEleVectores+=sizeof($valor);
                    } 
                }
                $ListaTotalEleVec[]=$TotalEleVectores;
            }

            $NumVal=0;
            $i=0;
            $transaction=$model->dbConnection->beginTransaction();
            try 
            {
                foreach ($listaRecords as $listaRecord)
                {
                    $sw=0;
                    $contValRecords=0;
                    $record=CJSON::decode(urldecode($listaRecord));
                    $model=new Usuario();
                    $audi=new LogSistema();

                    if (json_last_error() === JSON_ERROR_NONE)
                    {
                        try
                        {
                            $error.= (!isset($record['fk_id_tipo_usuario'])) ? "Variable indefinida {fk_id_tipo_usuario}" : "";
                            $error.= (!isset($record['nombre_usuario'])) ? "Variable indefinida {nombre_usuario}" : "";
                            $error.= (!isset($record['apellido_usuario'])) ? "Variable indefinida {apellido_usuario}" : "";
                            $error.= (!isset($record['login_usuario'])) ? "Variable indefinida {login_usuario}" : "";
                            $error.= (!isset($record['password_usuario'])) ? "Variable indefinida {password_usuario}" : "";
                            $error.= (!isset($record['sexo_usuario'])) ? "Variable indefinida {sexo_usuario}" : "";
                            #$error.= (!isset($record['fecha_actualizacion_usuario'])) ? "Variable indefinida {fecha_actualizacion_usuario}" : "";
                            $error.= (!isset($record['telefono_usuario'])) ? "Variable indefinida {telefono_usuario}" : "";
                            $error.= (!isset($record['celular_usuario'])) ? "Variable indefinida {celular_usuario}" : "";
                            $error.= (!isset($record['correo_usuario'])) ? "Variable indefinida {correo_usuario}" : "";
                            $error.= (!isset($record['direccion_usuario'])) ? "Variable indefinida {direccion_usuario}" : "";
                            $error.= (!isset($record['observacion_usuario'])) ? "Variable indefinida {observacion_usuario}" : "";

                            if ($error=="")
                            {
                                $model->fk_id_tipo_usuario			=$record['fk_id_tipo_usuario'];
                                $model->nombre_usuario				=$record['nombre_usuario'];
                                $model->apellido_usuario			=$record['apellido_usuario'];
                                $model->login_usuario				=$record['login_usuario'];
                                $model->password_usuario			=sha1($record['password_usuario']);
                                $model->sexo_usuario				=$record['sexo_usuario'];
                                $model->fecha_actualizacion_usuario =date('Y-m-d H:i:s');
                                $model->telefono_usuario			=$record['telefono_usuario'];
                                $model->celular_usuario				=$record['celular_usuario'];
                                $model->correo_usuario				=$record['correo_usuario'];
                                $model->direccion_usuario			=$record['direccion_usuario'];
                                $model->observacion_usuario			=$record['observacion_usuario'];

                                if ($model->validate())
                                {
                                    $model->save();
                                    $id_tabla_principal=$model->getPrimaryKey();
                                    $audi->insertAudi("create",$model->tableName(),$id_tabla_principal);  

                                    foreach ($record as $NomTabRel => $valor)
                                    {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""

                                        if (is_array($valor) && sizeof($valor)!=0)
                                        {
                                            if (isset($listaRelaciones[$NomTabRel]))
                                            {
                                                foreach ($valor as $subvalue)
                                                {
                                                    $obj = new $listaRelaciones[$NomTabRel]();
                                                    $audi = new LogSistema();
                                                    $obj->fk_id_usuario = $id_tabla_principal;

                                                    foreach ($subvalue as $key3 => $value3)
                                                    {
                                                        if ($obj->validaCampo($key3))
                                                        {
                                                            if ($key3 == "fk_id_usuario") {
                                                                $obj->fk_id_usuario = $id_tabla_principal;
                                                            } else {
																if ($key3 == "fk_id_lugar_actividad")
																	$id_MM = $value3;
                                                                $obj->$key3 = $value3;
                                                            }
                                                        }
                                                    }
                                                    if ($obj->validate())
                                                    {
                                                        #$audi->insertAudi("create", $obj->tableName(), $obj->getPrimaryKey());
                                                        $obj->save();
														if (is_numeric($obj->getPrimaryKey())) {
															$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
														} else {
															$audi->insertAudi("create",$obj->tableName(),$id_tabla_principal."-".$id_MM);
														}
                                                        $sw++;
                                                    }
                                                    else
                                                    {
                                                        $error = $obj->getErrors();
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $error = "variable  indefinida " . $NomTabRel;
                                            }
                                        }
                                    }//foreach

                                    $contValRecords++;
                                }
                                else
                                {
                                    $error=array_merge(array("Variable idefinida o "),$model->getErrors());
                                }
                            } 
                        }
                        catch(Exception $e)
                        {
                            $error=$e->getMessage();
                        }
                    }
                    else
                    {
                        $error="Error de json";
                    }

                    if ($sw+$contValRecords == $ListaTotalEleVec[$i]+1)
                    {
                        $NumVal++;
                    } 

                    $i++;
                }//foreach
            
                if ($NumVal == $numeroRecords)
                {
                    $transaction->commit();
                    $respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
                    $controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
                }
                else
                {
                    $respuesta->meta=array("success"=>"false","msg"=>$error);
                    $controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
                }
            }
            catch (Exception $e)
            {
                $transaction->rollback();
                throw $e;
            }
        }
        else
        {
            $respuesta->meta=array("success"=>"false","msg"=>$error);
            $controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
        }
    }
}




