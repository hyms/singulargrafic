<?php

/**
 * This is the model class for table "sucursal".
 *
 * The followings are the available columns in table 'sucursal':
 * @property integer $idSucursal
 * @property string $nombre
 * @property string $detalle
 *
 * The followings are the available model relations:
 * @property CTP[] $cTPs
 * @property Almacen[] $almacens
 * @property Caja[] $cajas
 * @property Empleado[] $empleados
 * @property NewsRelation[] $newsRelations
 * @property Recibos[] $reciboses
 * @property Venta[] $ventas
 */
class Sucursal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sucursal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'length', 'max'=>50),
			array('detalle', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idSucursal, nombre, detalle', 'safe', 'on'=>'search'),
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
			'cTPs' => array(self::HAS_MANY, 'CTP', 'idSucursal'),
			'almacens' => array(self::HAS_MANY, 'Almacen', 'idSucursal'),
			'cajas' => array(self::HAS_MANY, 'Caja', 'idSucursal'),
			'empleados' => array(self::HAS_MANY, 'Empleado', 'idSucursal'),
			'newsRelations' => array(self::HAS_MANY, 'NewsRelation', 'idSucursal'),
			'reciboses' => array(self::HAS_MANY, 'Recibos', 'idSucursal'),
			'ventas' => array(self::HAS_MANY, 'Venta', 'idSucursal'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idSucursal' => 'Id Sucursal',
			'nombre' => 'Nombre',
			'detalle' => 'Detalle',
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

		$criteria->compare('idSucursal',$this->idSucursal);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('detalle',$this->detalle,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sucursal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
