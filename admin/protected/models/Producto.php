<?php

/**
 * This is the model class for table "producto".
 *
 * The followings are the available columns in table 'producto':
 * @property integer $idProducto
 * @property string $codigo
 * @property string $material
 * @property string $color
 * @property string $marca
 * @property string $industria
 * @property integer $cantXPaquete
 * @property double $precioSFU
 * @property double $precioSFP
 * @property double $precioCFU
 * @property double $precioCFP
 * @property string $familia
 * @property string $detalle
 *
 * The followings are the available model relations:
 * @property AlmacenProducto[] $almacenProductos
 * @property MovimientoAlmacen[] $movimientoAlmacens
 */
class Producto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantXPaquete', 'numerical', 'integerOnly'=>true),
			array('precioSFU, precioSFP, precioCFU, precioCFP', 'numerical'),
			array('codigo, material, color, marca, industria, familia', 'length', 'max'=>40),
			array('detalle', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idProducto, codigo, material, color, marca, industria, cantXPaquete, precioSFU, precioSFP, precioCFU, precioCFP, familia, detalle', 'safe', 'on'=>'search'),
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
			'almacenProductos' => array(self::HAS_MANY, 'AlmacenProducto', 'idProducto'),
			'movimientoAlmacens' => array(self::HAS_MANY, 'MovimientoAlmacen', 'idProducto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idProducto' => 'Id Producto',
			'codigo' => 'Codigo',
			'material' => 'Material',
			'color' => 'Color',
			'marca' => 'Marca',
			'industria' => 'Industria',
			'cantXPaquete' => 'Cant Xpaquete',
			'precioSFU' => 'Precio Sf Unidad',
			'precioSFP' => 'Precio Sf Paquete',
			'precioCFU' => 'Precio Cf Unidad',
			'precioCFP' => 'Precio Cf Paquete',
			'familia' => 'Familia',
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

		$criteria->compare('idProducto',$this->idProducto);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('material',$this->material,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('marca',$this->marca,true);
		$criteria->compare('industria',$this->industria,true);
		$criteria->compare('cantXPaquete',$this->cantXPaquete);
		$criteria->compare('precioSFU',$this->precioSFU);
		$criteria->compare('precioSFP',$this->precioSFP);
		$criteria->compare('precioCFU',$this->precioCFU);
		$criteria->compare('precioCFP',$this->precioCFP);
		$criteria->compare('familia',$this->familia,true);
		$criteria->compare('detalle',$this->detalle,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Producto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
