<?php echo '<?php'; ?>

/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
<?php $mode=new $this->nomodel;?>
<?php $array=$mode->relations();
$aux=array();
for($i=0;$i<sizeof($array);$i++){
	$current=current($array);
	if(current($current)=="CHasManyRelation"){
		$key=key($array);next($current);
		$nomode=current($current);
		echo $nomode;
		$aux[]=$key;
		$aux[]=$nomode;
		$aux[]=next($current);
	}
	next($array);
}
for($i=0;$i<sizeof($aux);$i++){
	//echo $aux[$i]."hol <br>";
	$aux2[] = strtolower (preg_replace ('/([A-Z])/', '_$1', $aux[$i]));
}
//print_r($aux2);
?>
   public function run(){
		$controller=$this->getController();
		$model=new <?php echo $this->nomodel; ?>();
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
<?php foreach ($mode->attributeNames() as $name):?>
	<?php $id=$name;break;?>
<?php endforeach; ?>
<?php if(sizeof($aux)==0)://RELACION 0?><?php $sw=0?>
			if(<?php foreach ($mode->attributeNames() as $name):?><?php if($sw==1){?>isset($records['<?php echo$name; ?>']) && <?php }else{?><?php $sw=1;}?><?php endforeach;?>true){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0){ ?>
					$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?>
<?php }else{?>
<?php $sw=0;}?><?php endforeach;?>
					if($model->save()){
						$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
						$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
						$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif;?>
<?php if(sizeof($aux)==3)://RELACION 1?>
<?php $sw=0;?>
			if(<?php foreach ($mode->attributeNames() as $name):?><?php if($sw==1){?>isset($records['<?php echo $name; ?>']) && <?php }else{?><?php $sw=1;}?><?php endforeach;?>true){
<?php $mod1=new $aux[1];$campo1=key($mod1->attributeLabels());?>
					if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo $campo1;?>',$records['<?php echo $aux[2];?>'])!==false){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0){?>
						$model-><?php echo $name; ?>=$records['<?php echo $name; ?>'];<?php echo"\n";?><?php }else{?><?php $sw=0;}?><?php endforeach;?>
						if($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif;?>
<?php if(sizeof($aux)==6 && substr($id,0,2)=='id')://RELACION 2?>
<?php $sw=0;?>
			if(<?php foreach ($mode->attributeNames() as $name):?><?php if($sw==1){?>isset($records['<?php echo$name; ?>']) && <?php }else{?><?php $sw=1;}?><?php endforeach;?>true){
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
		<?php $mod1=new $aux[1];
		$campo1=key($mod1->attributeLabels());
		$mod2=new $aux[4];
		$campo2=key($mod2->attributeLabels());?>
			if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo $campo1;?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo $campo2;?>',$records['<?php echo $aux[5];?>'])!==false){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0){ ?>
						$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?>
<?php }else{?><?php $sw=0;}?><?php endforeach;?>
						if($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif;?>
<?php if(sizeof($aux)==6 && substr($id,0,2)!=='id')://RELACION 2?>
	<?php echo 'relacion 2 SIN PK';?>
<?php endif;?>
<?php if(sizeof($aux)==9 && substr($id,0,2)=='id')://RELACION 3?>
<?php $sw=0?>
			if(<?php foreach ($mode->attributeNames() as $name):?><?php if($sw==1){?>isset($records['<?php echo$name; ?>']) && <?php }else{?><?php $sw=1;}?><?php endforeach;?>true){
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
<?php $array=$mode->relations();for($i=0;$i<sizeof($array);$i++){$current=current($array);if(current($current)=="CBelongsToRelation"){$key=key($array);next($current);$nomode=current($current);$aux[]=$key;$aux[]=$nomode;$aux[]=next($current);}next($array);}?><?php $mod1=new $aux[1];$campo1=key($mod1->attributeLabels());$mod2=new $aux[4];$campo2=key($mod2->attributeLabels());$mod3=new $aux[7];$campo3=key($mod3->attributeLabels());?>
					if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo $campo1;?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo $campo2;?>',$records['<?php echo $aux[5];?>'])!==false&& $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo $campo3;?>',$records['<?php echo $aux[8];?>'])!==false){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0){ ?>
						$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php }else{?><?php $sw=0;}?><?php endforeach;?>
						if($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif;?>
<?php if(sizeof($aux)==9 && substr($id,0,2)!=='id')://RELACION 3?>
			/*if($records['CAM_BOOL']=='true' || $records['CAM_BOOL']===true){
						$records['CAM_BOOL']=1;
				}
				if($records['CAM_BOOL']=='false' || $records['CAM_BOOL']===false){
						$records['CAM_BOOL']=0;
				}*/
				if(<?php foreach ($mode->attributeNames() as $name):?>isset($records['<?php echo$name; ?>']) && <?php endforeach;?>true){
<?php
$mod1=new $aux[1];
$campo1=key($mod1->attributeLabels());
$mod2=new $aux[4];
$campo2=key($mod2->attributeLabels());
$mod3=new $aux[7];
$campo3=key($mod3->attributeLabels());?>
					if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo $campo1;?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo $campo2;?>',$records['<?php echo $aux[5];?>'])!==false&& $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo $campo3;?>',$records['<?php echo $aux[8];?>'])!==false){<?php foreach ($mode->attributeNames() as $name){ ?>
						$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php }?>
						try{
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
								$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
							}
						}catch(CDbException $e){
							$respuesta->meta=array("success"=>"false","msg"=>'Datos invalidos');
							$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
						}	
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif;?>
<?php if(sizeof($aux)==12 && substr($id,0,2)=='id')://RELACION 4?>
<?php $sw=0?>
			if(<?php foreach ($mode->attributeNames() as $name):?><?php if($sw==1){?>isset($records['<?php echo $name; ?>']) && <?php }else{?><?php $sw=1;}?><?php endforeach;?>true){
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
<?php $array=$mode->relations();for($i=0;$i<sizeof($array);$i++){$current=current($array);if(current($current)=="CBelongsToRelation"){$key=key($array);next($current);$nomode=current($current);$aux[]=$key;$aux[]=$nomode;$aux[]=next($current);}next($array);}?><?php $mod1=new $aux[1];$campo1=key($mod1->attributeLabels());$mod2=new $aux[4];$campo2=key($mod2->attributeLabels());$mod3=new $aux[7];$campo3=key($mod3->attributeLabels());$mod4=new $aux[10];$campo4=key($mod4->attributeLabels());?>
					if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo $campo1;?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo $campo2;?>',$records['<?php echo $aux[5];?>'])!==false && $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo $campo3;?>',$records['<?php echo $aux[8];?>'])!==false && $model->validaFK('<?php echo $mod4->tableName();?>','<?php echo $campo4;?>',$records['<?php echo $aux[11];?>'])!==false){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0){ ?>
						$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php }else{?><?php $sw=0;}?><?php endforeach;?>
						if($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif;?>
<?php if(sizeof($aux)==15 && substr($id,0,2)=='id')://RELACION 5?>
<?php $sw=0?>
			if(<?php foreach ($mode->attributeNames() as $name):?><?php if($sw==1){?>isset($records['<?php echo $name; ?>']) && <?php }else{?><?php $sw=1;}?><?php endforeach;?>true){
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
<?php $array=$mode->relations();for($i=0;$i<sizeof($array);$i++){$current=current($array);if(current($current)=="CBelongsToRelation"){$key=key($array);next($current);$nomode=current($current);$aux[]=$key;$aux[]=$nomode;$aux[]=next($current);}next($array);}?><?php $mod1=new $aux[1];$campo1=key($mod1->attributeLabels());$mod2=new $aux[4];$campo2=key($mod2->attributeLabels());$mod3=new $aux[7];$campo3=key($mod3->attributeLabels());$mod4=new $aux[10];$campo4=key($mod4->attributeLabels());$mod5=new $aux[13];$campo5=key($mod5->attributeLabels());?>
					if($model->validaFK('<?php echo $mod1->tableName();?>','<?php echo $campo1;?>',$records['<?php echo $aux[2];?>'])!==false && $model->validaFK('<?php echo $mod2->tableName();?>','<?php echo $campo2;?>',$records['<?php echo $aux[5];?>'])!==false && $model->validaFK('<?php echo $mod3->tableName();?>','<?php echo $campo3;?>',$records['<?php echo $aux[8];?>'])!==false && $model->validaFK('<?php echo $mod4->tableName();?>','<?php echo $campo4;?>',$records['<?php echo $aux[11];?>'])!==false && $model->validaFK('<?php echo $mod5->tableName();?>','<?php echo $campo5;?>',$records['<?php echo $aux[14];?>'])!==false){
<?php foreach ($mode->attributeNames() as $name): ?><?php if($sw==0){ ?>
						$model-><?php echo$name; ?>=$records['<?php echo$name; ?>'];<?php echo"\n";?><?php }else{?><?php $sw=0;}?><?php endforeach;?>
						if($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
<?php endif;?>
	}
}