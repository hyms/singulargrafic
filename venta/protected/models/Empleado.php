<?php

/**
 * This is the model class for table "empleado".
 *
 * The followings are the available columns in table 'empleado':
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $ci
 * @property string $telefono
 * @property string $email
 * @property string $cargo
 * @property string $turno
 * @property integer $sueldo
 * @property string $skype
 * @property string $face
 * @property integer $sucursal
 * @property integer $superior
 * @property string $fechaIngreso
 * @property string $idUsers
 * @property string $obs
 */
class Empleado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empleado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombres, apellidos, ci, telefono, cargo, sueldo, skype, sucursal, fechaIngreso', 'required', 'message'=>'El campo <b>{attribute}</b> es obligatorio',),
			array('ci, sueldo, sucursal, superior', 'numerical', 'integerOnly'=>true, 'message'=>'El campo <b>{attribute}</b> solo puede ser numerico'),
			array('nombres, apellidos, email, skype, face', 'length', 'max'=>100,'message'=>'<b>{attribute}</b> solo puede contener 100 caracteres'),
			array('email','email','message'=>'La direccion de <b>{attribute}</b> no es valido'),
			array('ci', 'length', 'max'=>20,'message'=>'<b>{attribute}</b> solo puede contener 20 caracteres'),
			array('telefono', 'length', 'max'=>15,'message'=>'<b>{attribute}</b> solo puede contener 15 caracteres'),
			array('turno, cargo', 'length', 'max'=>50,'message'=>'<b>{attribute}</b> solo puede contener 50 caracteres'),
			array('obs', 'length', 'max'=>500,'message'=>'<b>{attribute}</b> solo puede contener 500 caracteres'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nombres, apellidos, ci, telefono, email, cargo, turno, sueldo, skype, face, superior,idUsers, obs', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'MovimientoAlmacen'=>array(self::HAS_ONE, 'MovimientoAlmacen', 'idEmpleado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'ci' => 'CI',
			'telefono' => 'Telefono',
			'email' => 'Email',
			'cargo' => 'Cargo',
			'turno' => 'Turno',
			'sueldo' => 'Sueldo',
			'skype' => 'Skype',
			'face' => 'Facebook',
			'sucursal' => 'Sucursal',
			'superior' => 'Superior',
			'fechaIngreso' => 'Fecha de Ingreso',
			'idUsers' => 'Users',
			'obs' => 'Observaciones',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('ci',$this->ci,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('cargo',$this->cargo);
		$criteria->compare('turno',$this->turno,true);
		$criteria->compare('sueldo',$this->sueldo);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('face',$this->face,true);
		$criteria->compare('sucursal',$this->sucursal);
		$criteria->compare('superior',$this->superior);
		$criteria->compare('fechaIngreso',$this->fechaIngreso,true);
		$criteria->compare('idUsers',$this->idUsers);
		$criteria->compare('obs',$this->obs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getSucursales(){
		return CHtml::listData( Empresa::model()->findAll(),'id','nombre' );
	}
	
	public function getSuperiores(){
		if($this->id==null)
			return CHtml::listData( $this::model()->findAll(array('select'=>'id, cargo','group'=>'cargo')),'id','cargo' );
		return CHtml::listData( $this::model()->findAll('id!='.$this->id, array('select'=>'id, cargo','group'=>'cargo')),'id','cargo' );
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empleado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
