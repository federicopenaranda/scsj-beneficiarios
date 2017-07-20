<?php

class ControladorCode extends CCodeModel
{
	public $connectionId='db';
	public $tablePrefix;
	public $tableName;
	public $modelClass='Controler';
	public $modelPath='application.controllers';
	#public $modelPath='application.models';
	public $baseClass;
	#public $baseClass='CActiveRecord';
	public $buildRelations=true;
	public $commentsAsLabels=false;
	//Agregamos un atributo para las acciones
	public $actions='read';
	//agregamso un atributo
	public $controller;

	/**
	 * @var array list of candidate relation code. The array are indexed by AR class names and relation names.
	 * Each element represents the code of the one relation in one AR class.
	 */
	protected $relations;

	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('tablePrefix, baseClass, tableName, modelClass, modelPath, connectionId', 'filter', 'filter'=>'trim'),
			array('connectionId, tableName, modelPath, baseClass', 'required'),
			array('tablePrefix, tableName, modelPath', 'match', 'pattern'=>'/^(\w+[\w\.]*|\*?|\w+\.\*)$/', 'message'=>'{attribute} should only contain word characters, dots, and an optional ending asterisk.'),
			array('connectionId', 'validateConnectionId', 'skipOnError'=>true),
			array('tableName', 'validateTableName', 'skipOnError'=>true),
			array('tablePrefix, modelClass', 'match', 'pattern'=>'/^[a-zA-Z_]\w*$/', 'message'=>'{attribute} should only contain word characters.'),
		    array('baseClass', 'match', 'pattern'=>'/^[a-zA-Z_][\w\\\\]*$/', 'message'=>'{attribute} should only contain word characters and backslashes.'),
			array('modelPath', 'validateModelPath', 'skipOnError'=>true),
			array('baseClass, modelClass', 'validateReservedWord', 'skipOnError'=>true),
			array('baseClass', 'validateBaseClass', 'skipOnError'=>true),
			array('connectionId, tablePrefix, modelPath, baseClass, buildRelations, commentsAsLabels', 'sticky'),
			//agregamos
			array('baseClass, actions', 'sticky'),
		));
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'tablePrefix'=>'Table Prefix',
			'tableName'=>'Nombre del Controlador',
			#'tableName'=>'Table Name',
			'modelPath'=>'Direccion del Controlador',
			#'modelPath'=>'Model Path',
			'modelClass'=>'Model Class',
			'baseClass'=>'Clase Base',
			#'baseClass'=>'Base Class',
			'buildRelations'=>'Build Relations',
			'commentsAsLabels'=>'Use Column Comments as Attribute Labels',
			'connectionId'=>'Database Connection',
			//Agregamos un atributo para la accion
			'actions'=>'Accciones',
			
		));
	}

	public function requiredTemplates()
	{
		return array(
			'controlador.php',
			#'model.php',
			//agregamos un template para las acciones
			'view.php',
		);
	}

	public function init()
	{
		if(Yii::app()->{$this->connectionId}===null)
			throw new CHttpException(500,'A valid database connection is required to run this generator.');
		$this->tablePrefix=Yii::app()->{$this->connectionId}->tablePrefix;
		parent::init();
	}

	public function prepare()
	{
		if(($pos=strrpos($this->tableName,'.'))!==false)
		{
			$schema=substr($this->tableName,0,$pos);
			$tableName=substr($this->tableName,$pos+1);
		}
		else
		{
			$schema='';
			$tableName=$this->tableName;
		}
		if($tableName[strlen($tableName)-1]==='*')
		{
			$tables=Yii::app()->{$this->connectionId}->schema->getTables($schema);
			if($this->tablePrefix!='')
			{
				foreach($tables as $i=>$table)
				{
					if(strpos($table->name,$this->tablePrefix)!==0)
						unset($tables[$i]);
				}
			}
		}
		else
			$tables=array($this->getTableSchema($this->tableName));

		$this->files=array();
		$templatePath=$this->templatePath;
		$this->relations=$this->generateRelations();
		//se agreto
		$param=array(
				'modelClass'=>"Reporte",);
		$this->files[]=new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).'/ReporteController.php',
				$this->render($templatePath.'/controladorRep.php', $param)
				);
		$this->files[]=new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).'/Reporte/reporte.php',
				$this->render($templatePath.'/reporte.php', $param)
				);
		$nomTab=array();
			
		foreach($tables as $table)
		{
			$tableName=$this->removePrefix($table->name);
			$className=$this->generateClassName($table->name);
			$params=array(
				'tableName'=>$schema==='' ? $tableName : $schema.'.'.$tableName,
				'modelClass'=>$className,
				'columns'=>$table->columns,
				'labels'=>$this->generateLabels($table),
				'rules'=>$this->generateRules($table),
				'relations'=>isset($this->relations[$className]) ? $this->relations[$className] : array(),
				'connectionId'=>$this->connectionId,
				//agregamos un campo
				#'actions'=>$this->actions,
			);
			$this->files[]=new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).'/'.$className.'Controller.php',
				#Yii::getPathOfAlias($this->modelPath).'/'.$className.'.php',
				$this->render($templatePath.'/controlador.php', $params)
				#$this->render($templatePath.'/model.php', $params)
			);
			//<agrego
			$nomTab[]=$className;
			//********************************
		#$this->files=array();
		#$templatePath=$this->templatePath;

		/*$this->files[]=new CCodeFile(
			$this->controllerFile,
			$this->render($templatePath.'/controlador.php')
		);*/
		
		//adiciono
			if($className=="Usuario"){
				$this->files[]=new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).'/'.$className.'/login.php',
				$this->render($templatePath.'/login.php', $params)
				);
				$this->files[]=new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).'/'.$className.'/logout.php',
				$this->render($templatePath.'/logout.php', $params)
				);
			}
		
		foreach($this->getActionIDs() as $action)
		{

			if($action=="create"){
				$this->files[]=new CCodeFile(
					Yii::getPathOfAlias($this->modelPath).'/'.$className.'/'.$action.'.php',
					#$this->getViewFile($action),
					$this->render($templatePath.'/create.php', array('action'=>$action,'tableName'=>$schema==='' ? $tableName : $schema.'.'.$tableName,'modelClass'=>$className,'columns'=>$table->columns))
					#$this->render($templatePath.'/view.php', array('action'=>$action))
				);
			}//if
			if($action=="read"){
				$this->files[]=new CCodeFile(
					Yii::getPathOfAlias($this->modelPath).'/'.$className.'/'.$action.'.php',
					#$this->getViewFile($action),
					$this->render($templatePath.'/read.php', array('action'=>$action,'tableName'=>$schema==='' ? $tableName : $schema.'.'.$tableName,'modelClass'=>$className,'columns'=>$table->columns))
					#$this->render($templatePath.'/view.php', array('action'=>$action))
				);
			}//if
			if($action=="update"){
				$this->files[]=new CCodeFile(
					Yii::getPathOfAlias($this->modelPath).'/'.$className.'/'.$action.'.php',
					#$this->getViewFile($action),
					$this->render($templatePath.'/update.php', array('action'=>$action,'tableName'=>$schema==='' ? $tableName : $schema.'.'.$tableName,'modelClass'=>$className,'columns'=>$table->columns))
					#$this->render($templatePath.'/view.php', array('action'=>$action))
				);
			}//if
			if($action=="delete"){
				$this->files[]=new CCodeFile(
					Yii::getPathOfAlias($this->modelPath).'/'.$className.'/'.$action.'.php',
					#$this->getViewFile($action),
					$this->render($templatePath.'/delete.php', array('action'=>$action,'tableName'=>$schema==='' ? $tableName : $schema.'.'.$tableName,'modelClass'=>$className,'columns'=>$table->columns))
					#$this->render($templatePath.'/view.php', array('action'=>$action))
				);
			}//if
		}
		//*********************************
		}
		//agrego
		$param=array(
				'modelClass'=>$nomTab,);
		if(in_array("PrivilegiosUsuario",$nomTab)){
			$this->files[]=new CCodeFile(
					Yii::getPathOfAlias($this->modelPath).'/PrivilegiosUsuario/insert.php',
					$this->render($templatePath.'/insert.php', $param)
					);
		}
		
	}
	//agregamos una funcion nueva para la validacion de las acciones
	public function getActionIDs()
	{
		$actions=preg_split('/[\s,]+/',$this->actions,-1,PREG_SPLIT_NO_EMPTY);
		$actions=array_unique($actions);
		sort($actions);
		return $actions;
	}
	//agregamos otro metodo mas para las acciones
	public function getViewFile($action)
	{
		$module=$this->getModule();
		return 'aplication.controllers'.'/'.$this->getControllerID().'/'.$action.'.php';
		#return $module->getViewPath().'/'.$this->getControllerID().'/'.$action.'.php';
	}
	//aregamos una vez mas una funcion para las acciones
	public function getModule()
	{
		if(($pos=strpos($this->modelClass,'/'))!==false)
		#if(($pos=strpos($this->controller,'/'))!==false)
		{
			$id=substr($this->modelClass,0,$pos);
			#$id=substr($this->controller,0,$pos);
			if(($module=Yii::app()->getModule($id))!==null)
				return $module;
		}
		return Yii::app();
	}
	//agregamo una nueva funcion para la accion
	public function getControllerID()
	{
		if($this->getModule()!==Yii::app())
			$id=substr($this->modelClass,strpos($this->modelClass,'/')+1);
			#$id=substr($this->controller,strpos($this->controller,'/')+1);
		else
			$id=$this->modelClass;
			#$id=$this->controller;
		if(($pos=strrpos($id,'/'))!==false)
			$id[$pos+1]=strtolower($id[$pos+1]);
		else
			$id[0]=strtolower($id[0]);
		return $id;
	}

	public function validateTableName($attribute,$params)
	{
		if($this->hasErrors())
			return;

		$invalidTables=array();
		$invalidColumns=array();

		if($this->tableName[strlen($this->tableName)-1]==='*')
		{
			if(($pos=strrpos($this->tableName,'.'))!==false)
				$schema=substr($this->tableName,0,$pos);
			else
				$schema='';

			$this->modelClass='';
			$tables=Yii::app()->{$this->connectionId}->schema->getTables($schema);
			foreach($tables as $table)
			{
				if($this->tablePrefix=='' || strpos($table->name,$this->tablePrefix)===0)
				{
					if(in_array(strtolower($table->name),self::$keywords))
						$invalidTables[]=$table->name;
					if(($invalidColumn=$this->checkColumns($table))!==null)
						$invalidColumns[]=$invalidColumn;
				}
			}
		}
		else
		{
			if(($table=$this->getTableSchema($this->tableName))===null)
				$this->addError('tableName',"Table '{$this->tableName}' does not exist.");
			if($this->modelClass==='')
				$this->addError('modelClass','Model Class cannot be blank.');

			if(!$this->hasErrors($attribute) && ($invalidColumn=$this->checkColumns($table))!==null)
					$invalidColumns[]=$invalidColumn;
		}

		if($invalidTables!=array())
			$this->addError('tableName', 'Model class cannot take a reserved PHP keyword! Table name: '.implode(', ', $invalidTables).".");
		if($invalidColumns!=array())
			$this->addError('tableName', 'Column names that does not follow PHP variable naming convention: '.implode(', ', $invalidColumns).".");
	}

	/*
	 * Check that all database field names conform to PHP variable naming rules
	 * For example mysql allows field name like "2011aa", but PHP does not allow variable like "$model->2011aa"
	 * @param CDbTableSchema $table the table schema object
	 * @return string the invalid table column name. Null if no error.
	 */
	public function checkColumns($table)
	{
		foreach($table->columns as $column)
		{
			if(!preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/',$column->name))
				return $table->name.'.'.$column->name;
		}
	}

	public function validateModelPath($attribute,$params)
	{
		if(Yii::getPathOfAlias($this->modelPath)===false)
			$this->addError('modelPath','Model Path must be a valid path alias.');
	}

	public function validateBaseClass($attribute,$params)
	{
		$class=@Yii::import($this->baseClass,true);
		if(!is_string($class) || !$this->classExists($class))
			$this->addError('baseClass', "Class '{$this->baseClass}' does not exist or has syntax error.");
		#elseif($class!=='CActiveRecord' && !is_subclass_of($class,'CActiveRecord'))
		#	$this->addError('baseClass', "'{$this->model}' must extend from CActiveRecord.");
	}

	public function getTableSchema($tableName)
	{
		$connection=Yii::app()->{$this->connectionId};
		return $connection->getSchema()->getTable($tableName, $connection->schemaCachingDuration!==0);
	}

	public function generateLabels($table)
	{
		$labels=array();
		foreach($table->columns as $column)
		{
			if($this->commentsAsLabels && $column->comment)
				$labels[$column->name]=$column->comment;
			else
			{
				$label=ucwords(trim(strtolower(str_replace(array('-','_'),' ',preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $column->name)))));
				$label=preg_replace('/\s+/',' ',$label);
				if(strcasecmp(substr($label,-3),' id')===0)
					$label=substr($label,0,-3);
				if($label==='Id')
					$label='ID';
				$label=str_replace("'","\\'",$label);
				$labels[$column->name]=$label;
			}
		}
		return $labels;
	}

	public function generateRules($table)
	{
		$rules=array();
		$required=array();
		$integers=array();
		$numerical=array();
		$length=array();
		$safe=array();
		foreach($table->columns as $column)
		{
			if($column->autoIncrement)
				continue;
			$r=!$column->allowNull && $column->defaultValue===null;
			if($r)
				$required[]=$column->name;
			if($column->type==='integer')
				$integers[]=$column->name;
			elseif($column->type==='double')
				$numerical[]=$column->name;
			elseif($column->type==='string' && $column->size>0)
				$length[$column->size][]=$column->name;
			elseif(!$column->isPrimaryKey && !$r)
				$safe[]=$column->name;
		}
		if($required!==array())
			$rules[]="array('".implode(', ',$required)."', 'required')";
		if($integers!==array())
			$rules[]="array('".implode(', ',$integers)."', 'numerical', 'integerOnly'=>true)";
		if($numerical!==array())
			$rules[]="array('".implode(', ',$numerical)."', 'numerical')";
		if($length!==array())
		{
			foreach($length as $len=>$cols)
				$rules[]="array('".implode(', ',$cols)."', 'length', 'max'=>$len)";
		}
		if($safe!==array())
			$rules[]="array('".implode(', ',$safe)."', 'safe')";

		return $rules;
	}

	public function getRelations($className)
	{
		return isset($this->relations[$className]) ? $this->relations[$className] : array();
	}

	protected function removePrefix($tableName,$addBrackets=true)
	{
		if($addBrackets && Yii::app()->{$this->connectionId}->tablePrefix=='')
			return $tableName;
		$prefix=$this->tablePrefix!='' ? $this->tablePrefix : Yii::app()->{$this->connectionId}->tablePrefix;
		if($prefix!='')
		{
			if($addBrackets && Yii::app()->{$this->connectionId}->tablePrefix!='')
			{
				$prefix=Yii::app()->{$this->connectionId}->tablePrefix;
				$lb='{{';
				$rb='}}';
			}
			else
				$lb=$rb='';
			if(($pos=strrpos($tableName,'.'))!==false)
			{
				$schema=substr($tableName,0,$pos);
				$name=substr($tableName,$pos+1);
				if(strpos($name,$prefix)===0)
					return $schema.'.'.$lb.substr($name,strlen($prefix)).$rb;
			}
			elseif(strpos($tableName,$prefix)===0)
				return $lb.substr($tableName,strlen($prefix)).$rb;
		}
		return $tableName;
	}

	protected function generateRelations()
	{
		if(!$this->buildRelations)
			return array();

		$schemaName='';
		if(($pos=strpos($this->tableName,'.'))!==false)
			$schemaName=substr($this->tableName,0,$pos);

		$relations=array();
		foreach(Yii::app()->{$this->connectionId}->schema->getTables($schemaName) as $table)
		{
			if($this->tablePrefix!='' && strpos($table->name,$this->tablePrefix)!==0)
				continue;
			$tableName=$table->name;

			if ($this->isRelationTable($table))
			{
				$pks=$table->primaryKey;
				$fks=$table->foreignKeys;

				$table0=$fks[$pks[0]][0];
				$table1=$fks[$pks[1]][0];
				$className0=$this->generateClassName($table0);
				$className1=$this->generateClassName($table1);

				$unprefixedTableName=$this->removePrefix($tableName);

				$relationName=$this->generateRelationName($table0, $table1, true);
				$relations[$className0][$relationName]="array(self::MANY_MANY, '$className1', '$unprefixedTableName($pks[0], $pks[1])')";

				$relationName=$this->generateRelationName($table1, $table0, true);

				$i=1;
				$rawName=$relationName;
				while(isset($relations[$className1][$relationName]))
					$relationName=$rawName.$i++;

				$relations[$className1][$relationName]="array(self::MANY_MANY, '$className0', '$unprefixedTableName($pks[1], $pks[0])')";
			}
			else
			{
				$className=$this->generateClassName($tableName);
				foreach ($table->foreignKeys as $fkName => $fkEntry)
				{
					// Put table and key name in variables for easier reading
					$refTable=$fkEntry[0]; // Table name that current fk references to
					$refKey=$fkEntry[1];   // Key in that table being referenced
					$refClassName=$this->generateClassName($refTable);

					// Add relation for this table
					$relationName=$this->generateRelationName($tableName, $fkName, false);
					$relations[$className][$relationName]="array(self::BELONGS_TO, '$refClassName', '$fkName')";

					// Add relation for the referenced table
					$relationType=$table->primaryKey === $fkName ? 'HAS_ONE' : 'HAS_MANY';
					$relationName=$this->generateRelationName($refTable, $this->removePrefix($tableName,false), $relationType==='HAS_MANY');
					$i=1;
					$rawName=$relationName;
					while(isset($relations[$refClassName][$relationName]))
						$relationName=$rawName.($i++);
					$relations[$refClassName][$relationName]="array(self::$relationType, '$className', '$fkName')";
				}
			}
		}
		return $relations;
	}

	/**
	 * Checks if the given table is a "many to many" pivot table.
	 * Their PK has 2 fields, and both of those fields are also FK to other separate tables.
	 * @param CDbTableSchema table to inspect
	 * @return boolean true if table matches description of helpter table.
	 */
	protected function isRelationTable($table)
	{
		$pk=$table->primaryKey;
		return (count($pk) === 2 // we want 2 columns
			&& isset($table->foreignKeys[$pk[0]]) // pk column 1 is also a foreign key
			&& isset($table->foreignKeys[$pk[1]]) // pk column 2 is also a foriegn key
			&& $table->foreignKeys[$pk[0]][0] !== $table->foreignKeys[$pk[1]][0]); // and the foreign keys point different tables
	}

	protected function generateClassName($tableName)
	{
		if($this->tableName===$tableName || ($pos=strrpos($this->tableName,'.'))!==false && substr($this->tableName,$pos+1)===$tableName)
			return $this->modelClass;

		$tableName=$this->removePrefix($tableName,false);
		if(($pos=strpos($tableName,'.'))!==false) // remove schema part (e.g. remove 'public2.' from 'public2.post')
			$tableName=substr($tableName,$pos+1);
		$className='';
		foreach(explode('_',$tableName) as $name)
		{
			if($name!=='')
				$className.=ucfirst($name);
		}
		return $className;
	}

	/**
	 * Generate a name for use as a relation name (inside relations() function in a model).
	 * @param string the name of the table to hold the relation
	 * @param string the foreign key name
	 * @param boolean whether the relation would contain multiple objects
	 * @return string the relation name
	 */
	protected function generateRelationName($tableName, $fkName, $multiple)
	{
		if(strcasecmp(substr($fkName,-2),'id')===0 && strcasecmp($fkName,'id'))
			$relationName=rtrim(substr($fkName, 0, -2),'_');
		else
			$relationName=$fkName;
		$relationName[0]=strtolower($relationName);

		if($multiple)
			$relationName=$this->pluralize($relationName);

		$names=preg_split('/_+/',$relationName,-1,PREG_SPLIT_NO_EMPTY);
		if(empty($names)) return $relationName;  // unlikely
		for($name=$names[0], $i=1;$i<count($names);++$i)
			$name.=ucfirst($names[$i]);

		$rawName=$name;
		$table=Yii::app()->{$this->connectionId}->schema->getTable($tableName);
		$i=0;
		while(isset($table->columns[$name]))
			$name=$rawName.($i++);

		return $name;
	}

	public function validateConnectionId($attribute, $params)
	{
		if(Yii::app()->hasComponent($this->connectionId)===false || !(Yii::app()->getComponent($this->connectionId) instanceof CDbConnection))
			$this->addError('connectionId','A valid database connection is required to run this generator.');
	}
}
