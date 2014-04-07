<?php

/**
 * This is the model class for table "detalleVenta".
 *
 * The followings are the available columns in table 'detalleVenta':
 * @property integer $id
 * @property integer $idVenta
 * @property integer $idProducto
 * @property integer $idAlmacen
 * @property integer $cantUnidad
 * @property integer $cantPaquete
 * @property integer $adicional
 * @property integer $costoTotal
 */
class DetalleVenta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalleVenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idVenta, idProducto, idAlmacen', 'required'),
			array('idVenta, idProducto, cantUnidad, cantPaquete, adicional, costoTotal', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idVenta, idProducto, cantUnidad, cantPaquete, adicional, costoTotal', 'safe', 'on'=>'search'),
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
			'Venta'=>array(self::BELONGS_TO, 'VentaTmp', 'idVenta'),
			'Producto'=>array(self::BELONGS_TO, 'Producto', 'idProducto'),
			'Almacen'=>array(self::BELONGS_TO, 'Almacen', 'idAlmacen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idVenta' => 'Id Venta',
			'idProducto' => 'Id Producto',
			'idAlmacen' => 'Id Almacen',
			'cantUnidad' => 'Cant Unidad',
			'cantPaquete' => 'Cant Paquete',
			'adicional' => 'Adicional',
			'costoTotal' => 'Costo Total',
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
		$criteria->compare('idVenta',$this->idVenta);
		$criteria->compare('idProducto',$this->idProducto);
		$criteria->compare('idAlmacen',$this->idAlmacen);
		$criteria->compare('cantUnidad',$this->cantUnidad);
		$criteria->compare('cantPaquete',$this->cantPaquete);
		$criteria->compare('adicional',$this->adicional);
		$criteria->compare('costoTotal',$this->costoTotal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleVenta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
