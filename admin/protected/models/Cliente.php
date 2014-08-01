<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property integer $idCliente
 * @property string $nitCi
 * @property string $apellido
 * @property string $nombre
 * @property string $correo
 * @property string $fechaRegistro
 * @property string $telefono
 * @property string $direccion
 * @property integer $idTIposClientes
 *
 * The followings are the available model relations:
 * @property CTP[] $cTPs
 * @property Imprenta[] $imprentas
 * @property TiposClientes $idTIposClientes0
 * @property Recibos[] $reciboses
 * @property Venta[] $ventas
 */
class Cliente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTIposClientes', 'numerical', 'integerOnly'=>true),
			array('nitCi, telefono', 'length', 'max'=>20),
			array('apellido, nombre', 'length', 'max'=>40),
			array('correo', 'length', 'max'=>50),
			array('direccion', 'length', 'max'=>100),
			array('fechaRegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCliente, nitCi, apellido, nombre, correo, fechaRegistro, telefono, direccion, idTIposClientes', 'safe', 'on'=>'search'),
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
			'cTPs' => array(self::HAS_MANY, 'CTP', 'idCliente'),
			'imprentas' => array(self::HAS_MANY, 'Imprenta', 'idCliente'),
			'idTIposClientes0' => array(self::BELONGS_TO, 'TiposClientes', 'idTIposClientes'),
			'reciboses' => array(self::HAS_MANY, 'Recibos', 'idCliente'),
			'ventas' => array(self::HAS_MANY, 'Venta', 'idCliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCliente' => 'Id Cliente',
			'nitCi' => 'Nit Ci',
			'apellido' => 'Apellido',
			'nombre' => 'Nombre',
			'correo' => 'Correo',
			'fechaRegistro' => 'Fecha Registro',
			'telefono' => 'Telefono',
			'direccion' => 'Direccion',
			'idTIposClientes' => 'Tipo Cliente',
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

		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('nitCi',$this->nitCi,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('fechaRegistro',$this->fechaRegistro,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('idTIposClientes',$this->idTIposClientes);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cliente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
