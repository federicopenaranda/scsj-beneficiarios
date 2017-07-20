<?php
/**
 * Esta es la clase modelo para la tabla "usuario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'usuario':
 * @property integer $id_usuario
 * @property integer $fk_id_tipo_usuario
 * @property string $nombre_usuario
 * @property string $apellido_usuario
 * @property string $login_usuario
 * @property string $password_usuario
 * @property string $sexo_usuario
 * @property string $fecha_creacion_usuario
 * @property string $fecha_actualizacion_usuario
 * @property string $telefono_usuario
 * @property string $celular_usuario
 * @property string $correo_usuario
 * @property string $direccion_usuario
 * @property string $observacion_usuario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Actividad[] $actividads
 * @property Asistencia[] $asistencias
 * @property Biblioteca[] $bibliotecas
 * @property EvalAtencionMedica[] $evalAtencionMedicas
 * @property EvalComputacion[] $evalComputacions
 * @property EvalEduChildfund[] $evalEduChildfunds
 * @property EvalEduNelsonOrtiz[] $evalEduNelsonOrtizs
 * @property EvalEnfermeria[] $evalEnfermerias
 * @property EvalNutricion[] $evalNutricions
 * @property EvalOdontologia[] $evalOdontologias
 * @property EvalPedagogico[] $evalPedagogicos
 * @property EvalPsicologico[] $evalPsicologicos
 * @property LogSistema[] $logSistemas
 * @property PersonalAsistencia[] $personalAsistencias
 * @property TipoUsuario $fkIdTipoUsuario
 * @property UsuarioBeneficiario[] $usuarioBeneficiarios
 * @property UsuarioEntidad[] $usuarioEntidads
 */
class Usuario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'usuario';
	}
	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_usuario, nombre_usuario, login_usuario, sexo_usuario, celular_usuario, correo_usuario', 'required'),
			array('fk_id_tipo_usuario', 'numerical', 'integerOnly'=>true),
			array('nombre_usuario, apellido_usuario, login_usuario, password_usuario, telefono_usuario, celular_usuario', 'length', 'max'=>45),
			array('correo_usuario', 'length', 'max'=>150),
			array('direccion_usuario, observacion_usuario', 'safe'),
			array('login_usuario', 'unique','message'=>'Dato invalido valor duplicado'),
			#array('fecha_actualizacion_usuario','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
			array('sexo_usuario','in','range'=>array('f','m'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'actividads' => array(self::HAS_MANY, 'Actividad', 'fk_id_usuario'),
			'asistencias' => array(self::HAS_MANY, 'Asistencia', 'fk_id_usuario'),
			'bibliotecas' => array(self::HAS_MANY, 'Biblioteca', 'fk_id_usuario'),
			'evalAtencionMedicas' => array(self::HAS_MANY, 'EvalAtencionMedica', 'fk_id_usuario'),
			'evalComputacions' => array(self::HAS_MANY, 'EvalComputacion', 'fk_id_usuario'),
			'evalEduChildfunds' => array(self::HAS_MANY, 'EvalEduChildfund', 'fk_id_usuario'),
			'evalEduNelsonOrtizs' => array(self::HAS_MANY, 'EvalEduNelsonOrtiz', 'fk_id_usuario'),
			'evalEnfermerias' => array(self::HAS_MANY, 'EvalEnfermeria', 'fk_id_usuario'),
			'evalNutricions' => array(self::HAS_MANY, 'EvalNutricion', 'fk_id_usuario'),
			'evalOdontologias' => array(self::HAS_MANY, 'EvalOdontologia', 'fk_id_usuario'),
			'evalPedagogicos' => array(self::HAS_MANY, 'EvalPedagogico', 'fk_id_usuario'),
			'evalPsicologicos' => array(self::HAS_MANY, 'EvalPsicologico', 'fk_id_usuario'),
			'logSistemas' => array(self::HAS_MANY, 'LogSistema', 'fk_id_usuario'),
			'personalAsistencias' => array(self::HAS_MANY, 'PersonalAsistencia', 'fk_id_usuario'),
			'fkIdTipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'fk_id_tipo_usuario'),
			'usuarioBeneficiarios' => array(self::HAS_MANY, 'UsuarioBeneficiario', 'fk_id_usuario'),
			'usuarioEntidads' => array(self::HAS_MANY, 'UsuarioEntidad', 'fk_id_usuario'),
			//read
			'usuarioLugars' => array(self::HAS_MANY, 'UsuarioLugar', 'fk_id_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'fk_id_tipo_usuario' => 'Fk Id Tipo Usuario',
			'nombre_usuario' => 'Nombre Usuario',
			'apellido_usuario' => 'Apellido Usuario',
			'login_usuario' => 'Login Usuario',
			'password_usuario' => 'Password Usuario',
			'sexo_usuario' => 'Sexo Usuario',
			'fecha_creacion_usuario' => 'Fecha Creacion Usuario',
			'fecha_actualizacion_usuario' => 'Fecha Actualizacion Usuario',
			'telefono_usuario' => 'Telefono Usuario',
			'celular_usuario' => 'Celular Usuario',
			'correo_usuario' => 'Correo Usuario',
			'direccion_usuario' => 'Direccion Usuario',
			'observacion_usuario' => 'Observacion Usuario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function validatePassword($password)
	{
    	if (sha1($password)!==$this->password_usuario)
    		return false;
    	else
    		return true;
   
    	//return CPasswordHelper::verifyPassword($password,$this->password_usuario);
    }
    
    public function hashPassword($password){
    	return CPasswordHelper::hashPassword($password);
    }

    public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}
}
