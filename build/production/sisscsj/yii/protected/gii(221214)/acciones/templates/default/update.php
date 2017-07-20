<?php echo '<?php'; ?>
 
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Update extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de actualizar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
<?php $mode=new $this->nomodel;?>
<?php $array=array();$array=$mode->relations();
	$aux=array();
	for($i=0;$i<sizeof($array);$i++){
		$current=current($array);
		if(current($current)=="CBelongsToRelation"){
			$key=key($array);next($current);
			$nomode=current($current);
			$aux[]=$key;
			$aux[]=$nomode;
			$aux[]=next($current);
		}
		next($array);
	}
?>
    public function run(){
		$controller=$this->getController();
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];			
<?php foreach ($mode->attributeNames() as $name):?>
<?php $id=$name;break;?>
<?php endforeach; ?>
<?php if(sizeof($aux)==0)://RELACION 0?>
				if(<?php foreach ($mode->attributeNames() as $name):?>isset($records['<?php echo $name;?>']) && <?php endforeach;?>true){
<?php $sw=0;?><?php foreach ($mode->attributeNames() as $name):?><?php if($sw==0):?><?php $v=$name;$sw=1;?><?php endif;?><?php endforeach;?>
					$model=<?php echo $this->nomodel;?>::model()->findByPk($records['<?php echo $v?>']);
					if($model!==null){
<?php foreach ($mode->attributeNames() as $name):?><?php if($sw==0):?>
						$model-><?php echo$name;?>=$records['<?php echo$name;?>'];<?php echo"\n";else:$sw=0;?><?php endif;?><?php endforeach; ?>
						if($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));				
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif; ?>
<?php if(sizeof($aux)==3 && substr($id,0,2)=='id')://RELACION 1?>
				if(<?php foreach ($mode->attributeNames() as $name):?>isset($records['<?php echo$name; ?>']) && <?php endforeach;?>true){
<?php $sw=0?><?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0):?><?php $v=$name;$sw=1;?><?php endif;?><?php endforeach;?>
					$model=<?php echo $this->nomodel;?>::model()->findByPk($records['<?php echo $v?>']);
					if($model!==null){
<?php $mod1=new $aux[1]?>
						if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo $aux[2];?>'])!==false){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0): ?>
							$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php else:?><?php $sw=0;endif;?><?php endforeach;?>
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif; ?>
<?php if(sizeof($aux)==6 && substr($id,0,2)=='id')://RELACION 2?>
<?php $sw=0;?>
				if(<?php foreach ($mode->attributeNames() as $name):?>isset($records['<?php echo$name; ?>']) && <?php endforeach;?>true){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0){ ?><?php $v=$name;$sw=1;?><?php }?><?php endforeach;?>
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
					$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
					$model=<?php echo $this->nomodel; ?>::model()->findByPk($records['<?php echo $v?>']);
					if($model!==null){
<?php $mod1=new $aux[1];$mod2=new $aux[4];?>
						if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo key($mod2->attributeLabels());?>',$records['<?php echo $aux[5];?>'])!==false){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0){ ?>
							$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php }else{?><?php $sw=0;}?><?php endforeach;?>
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif; ?>
<?php if(sizeof($aux)==6 && substr($id,0,2)!=='id')://RELACION 2 SIN PK?>
<?php echo 'RELACION 2 SIN PK'?>
<?php $fk=array();?>
<?php foreach ($mode->attributeNames() as $name):?>
<?php if(substr($name,0,2)=='fk'){
	$fk[]=$name;
}?>
<?php endforeach;?>
<?php $sw=0?>
				if(<?php foreach ($mode->attributeNames() as $name){?>isset($records['<?php echo$name; ?>']) && <?php }?>isset($records['<?php echo ucfirst($fk[0]);?>']) && isset($records['<?php echo ucfirst($fk[1]);?>'])){
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?><?php $v=$name;$sw=1;?><?php }?><?php }?>
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
					$model=<?php echo $this->nomodel; ?>::model()->find(array('condition'=>'<?php echo $fk[0]?>=:<?php echo $fk[0]?> and <?php echo $fk[1]?>=:<?php echo $fk[1]?> and <?php echo $fk[2]?>=:<?php echo $fk[2]?>','params'=>array(':<?php echo $fk[0]?>'=>$records['<?php echo $fk[0]?>'],':<?php echo $fk[1]?>'=>$records['<?php echo $fk[1]?>'],':<?php echo $fk[2]?>'=>$records['<?php echo $fk[2]?>'])));
					if($model!==null){
<?php $mod1=new $aux[1];$mod2=new $aux[4];$mod3=new $aux[7];?>
						if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo key($mod2->attributeLabels());?>',$records['<?php echo $aux[5];?>'])!==false && $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo key($mod3->attributeLabels());?>',$records['<?php echo $aux[8];?>'])!==false &&    validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo ucfirst($fk[0]);?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo key($mod2->attributeLabels());?>',$records['<?php echo ucfirst($fk[1]);?>'])!==false){
<?php $i=0;?><?php foreach ($mode->attributeNames() as $name):?><?php if($i<2):?>
							$model-><?php echo $name; ?>=$records['<?php echo ucfirst($fk[$i]); ?>'];<?php echo"\n";	?><?php else:?>
							$model-><?php echo $name; ?>=$records['<?php echo $name; ?>'];<?php echo"\n";?>
<?php endif;$i++;?><?php endforeach;?>
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif; ?>
<?php if(sizeof($aux)==9 && substr($id,0,2)=='id')://RELACION  3?>
<?php $sw=0?>
				if(<?php foreach ($mode->attributeNames() as $name){?>isset($records['<?php echo$name; ?>']) && <?php }?>true){
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?><?php $v=$name;$sw=1;?><?php }?><?php }?>
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
					$model=<?php echo $this->nomodel; ?>::model()->findByPk($records['<?php echo $v?>']);
					if($model!==null){
<?php $mod1=new $aux[1];$mod2=new $aux[4];$mod3=new $aux[7];?>
						if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo key($mod2->attributeLabels());?>',$records['<?php echo $aux[5];?>'])!==false && $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo key($mod3->attributeLabels());?>',$records['<?php echo $aux[8];?>'])!==false){					
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?>
							$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php }else{?><?php $sw=0;}?><?php }?>
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>"Dato invalido");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif; ?>
<?php if(sizeof($aux)==9 && substr($id,0,2)!=='id')://RELACION 3 SIN PK?>
<?php $fk=array();?>
<?php foreach ($mode->attributeNames() as $name):?>
<?php if(substr($name,0,2)=='fk'){
	$fk[]=$name;
}?>
<?php endforeach;?>
<?php $sw=0?>
				if(<?php foreach ($mode->attributeNames() as $name){?>isset($records['<?php echo$name; ?>']) && <?php }?>isset($records['<?php echo ucfirst($fk[0]);?>']) && isset($records['<?php echo ucfirst($fk[1]);?>']) && isset($records['<?php echo ucfirst($fk[2]);?>'])){
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?><?php $v=$name;$sw=1;?><?php }?><?php }?>
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
					$model=<?php echo $this->nomodel; ?>::model()->find(array('condition'=>'<?php echo $fk[0]?>=:<?php echo $fk[0]?> and <?php echo $fk[1]?>=:<?php echo $fk[1]?> and <?php echo $fk[2]?>=:<?php echo $fk[2]?>','params'=>array(':<?php echo $fk[0]?>'=>$records['<?php echo $fk[0]?>'],':<?php echo $fk[1]?>'=>$records['<?php echo $fk[1]?>'],':<?php echo $fk[2]?>'=>$records['<?php echo $fk[2]?>'])));
					if($model!==null){
<?php $mod1=new $aux[1];$mod2=new $aux[4];$mod3=new $aux[7];?>
						if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo key($mod2->attributeLabels());?>',$records['<?php echo $aux[5];?>'])!==false && $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo key($mod3->attributeLabels());?>',$records['<?php echo $aux[8];?>'])!==false &&    validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo ucfirst($fk[0]);?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo key($mod2->attributeLabels());?>',$records['<?php echo ucfirst($fk[1]);?>'])!==false && $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo key($mod3->attributeLabels());?>',$records['<?php echo ucfirst($fk[2]);?>'])!==false){
<?php $i=0;?><?php foreach ($mode->attributeNames() as $name):?><?php if($i<3):?>
							$model-><?php echo $name; ?>=$records['<?php echo ucfirst($fk[$i]); ?>'];<?php echo"\n";	?><?php else:?>
							$model-><?php echo $name; ?>=$records['<?php echo $name; ?>'];<?php echo"\n";?>
<?php endif;$i++;?><?php endforeach;?>
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>"Dato invalido");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif; ?>
<?php if(sizeof($aux)==12 && substr($id,0,2)=='id')://RELACION 4?>
<?php $sw=0?>
				if(<?php foreach ($mode->attributeNames() as $name){?>isset($records['<?php echo$name; ?>']) && <?php }?>true){
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?><?php $v=$name;$sw=1;?><?php }?><?php }?>
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
					$model=<?php echo $this->nomodel; ?>::model()->findByPk($records['<?php echo $v?>']);
					if($model!==null){
<?php $mod1=new $aux[1];$mod2=new $aux[4];$mod3=new $aux[7];$mod4=new $aux[10];?>
						if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo key($mod2->attributeLabels());?>',$records['<?php echo $aux[5];?>'])!==false && $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo key($mod3->attributeLabels());?>',$records['<?php echo $aux[8];?>'])!==false && $model->validaFK('<?php echo $mod4->tableName();?>','<?php echo key($mod4->attributeLabels());?>',$records['<?php echo $aux[11];?>'])!==false){					
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?>
							$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php }else{?><?php $sw=0;}?><?php }?>
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>"Dato invalido");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif; ?>
<?php if(sizeof($aux)==15 && substr($id,0,2)=='id')://RELACION 5?>
<?php $sw=0?>
				if(<?php foreach ($mode->attributeNames() as $name){?>isset($records['<?php echo$name; ?>']) && <?php }?>true){
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?><?php $v=$name;$sw=1;?><?php }?><?php }?>
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
					$model=<?php echo $this->nomodel; ?>::model()->findByPk($records['<?php echo $v?>']);
					if($model!==null){
<?php $mod1=new $aux[1];$mod2=new $aux[4];$mod3=new $aux[7];$mod4=new $aux[10];$mod5=new $aux[13];?>
						if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo key($mod1->attributeLabels());?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo key($mod2->attributeLabels());?>',$records['<?php echo $aux[5];?>'])!==false && $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo key($mod3->attributeLabels());?>',$records['<?php echo $aux[8];?>'])!==false && $model->validaFK('<?php echo $mod4->tableName();?>','<?php echo key($mod4->attributeLabels());?>',$records['<?php echo $aux[11];?>'])!==false && $model->validaFK('<?php echo $mod5->tableName();?>','<?php echo key($mod5->attributeLabels());?>',$records['<?php echo $aux[14];?>'])!==false){
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?>
							$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php }else{?><?php $sw=0;}?><?php }?>
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>"Dato invalido");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif; ?>
	}
}
?>