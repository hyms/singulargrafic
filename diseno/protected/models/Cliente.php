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
 * @property integer $idTiposClientes
 * @property integer $idParent
 *
 * The followings are the available model relations:
 * @property CTP[] $cTPs
 * @property Imprenta[] $imprentas
 * @property Cliente $idParent0
 * @property Cliente[] $clientes
 * @property TiposClientes $idTiposClientes0
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
            array('nitCi, apellido','required'),
			array('idTiposClientes, idParent', 'numerical', 'integerOnly'=>true),
			array('nitCi, telefono', 'length', 'max'=>20),
			array('apellido, nombre', 'length', 'max'=>40),
			array('correo', 'length', 'max'=>50),
			array('direccion', 'length', 'max'=>100),
			array('fechaRegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCliente, nitCi, apellido, nombre, correo, fechaRegistro, telefono, direccion, idTiposClientes, idParent', 'safe', 'on'=>'search'),
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
			'idParent0' => array(self::BELONGS_TO, 'Cliente', 'idParent'),
			'clientes' => array(self::HAS_MANY, 'Cliente', 'idParent'),
			'idTiposClientes0' => array(self::BELONGS_TO, 'TiposClientes', 'idTiposClientes'),
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
			'apellido' => 'Apellido/Razon Social',
			'nombre' => 'Nombre',
			'correo' => 'Correo',
			'fechaRegistro' => 'Fecha Registro',
			'telefono' => 'Telefono',
			'direccion' => 'Direccion',
			'idTiposClientes' => 'Id Tipos Clientes',
			'idParent' => 'Id Parent',
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
	public function search($cond=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        if($cond!=null)
            $criteria->condition = $cond;

        $criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('nitCi',$this->nitCi,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('fechaRegistro',$this->fechaRegistro,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('idTiposClientes',$this->idTiposClientes);
		$criteria->compare('idParent',$this->idParent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>5),
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
