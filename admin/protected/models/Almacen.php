<?php

/**
 * This is the model class for table "almacen".
 *
 * The followings are the available columns in table 'almacen':
 * @property integer $id
 * @property integer $idProducto
 * @property integer $idTipoAlmacen
 * @property integer $stockUnidad
 * @property integer $stockPaquete
 */
class Almacen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'almacen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProducto, idTipoAlmacen', 'required'),
			array('idProducto, idTipoAlmacen, stockUnidad, stockPaquete', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idProducto, idTipoAlmacen, stockUnidad, stockPaquete', 'safe', 'on'=>'search'),
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
				'TipoAlmacen'=>array(self::BELONGS_TO, 'TipoAlmacen', 'idTipoAlmacen'),
				'Producto'=>array(self::BELONGS_TO, 'Producto', 'idProducto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idProducto' => 'Producto',
			'idTipoAlmacen' => 'Tipo Almacen',
			'stockUnidad' => 'Stock Unidad',
			'stockPaquete' => 'Stock Paquete',
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
		$criteria->compare('idProducto',$this->idProducto);
		$criteria->compare('idTipoAlmacen',$this->idTipoAlmacen);
		$criteria->compare('stockUnidad',$this->stockUnidad);
		$criteria->compare('stockPaquete',$this->stockPaquete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Almacen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
