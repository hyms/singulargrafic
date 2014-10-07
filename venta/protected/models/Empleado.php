<?php

/**
 * This is the model class for table "empleado".
 *
 * The followings are the available columns in table 'empleado':
 * @property integer $idEmpleado
 * @property string $nombre
 * @property string $apellido
 * @property string $fechaRegistro
 * @property string $email
 * @property string $telefono
 * @property string $ci
 * @property integer $idSucursal
 *
 * The followings are the available model relations:
 * @property Sucursal $idSucursal0
 * @property User[] $users
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
			array('idSucursal', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido', 'length', 'max'=>40),
			array('email', 'length', 'max'=>50),
			array('telefono, ci', 'length', 'max'=>20),
			array('fechaRegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idEmpleado, nombre, apellido, fechaRegistro, email, telefono, ci, idSucursal', 'safe', 'on'=>'search'),
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
			'idSucursal0' => array(self::BELONGS_TO, 'Sucursal', 'idSucursal'),
			'users' => array(self::HAS_MANY, 'User', 'idEmpleado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idEmpleado' => 'Id Empleado',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'fechaRegistro' => 'Fecha Registro',
			'email' => 'Email',
			'telefono' => 'Telefono',
			'ci' => 'Ci',
			'idSucursal' => 'Id Sucursal',
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

		$criteria->compare('idEmpleado',$this->idEmpleado);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('fechaRegistro',$this->fechaRegistro,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('ci',$this->ci,true);
		$criteria->compare('idSucursal',$this->idSucursal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
