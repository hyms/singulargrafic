<?php

/**
 * This is the model class for table "preciosDistribuidora".
 *
 * The followings are the available columns in table 'preciosDistribuidora':
 * @property integer $idPreciosDistribuidora
 * @property integer $idAlmacenProducto
 * @property double $precioCFU
 * @property double $precioCFP
 * @property double $precioSFU
 * @property double $precioSFP
 *
 * The followings are the available model relations:
 * @property AlmacenProducto $idAlmacenProducto0
 */
class PreciosDistribuidora extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'preciosDistribuidora';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idAlmacenProducto, precioCFU, precioCFP, precioSFU, precioSFP', 'required'),
			array('idAlmacenProducto', 'numerical', 'integerOnly'=>true),
			array('precioCFU, precioCFP, precioSFU, precioSFP', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idPreciosDistribuidora, idAlmacenProducto, precioCFU, precioCFP, precioSFU, precioSFP', 'safe', 'on'=>'search'),
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
			'idAlmacenProducto0' => array(self::BELONGS_TO, 'AlmacenProducto', 'idAlmacenProducto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idPreciosDistribuidora' => 'Id Precios Distribuidora',
			'idAlmacenProducto' => 'Id Almacen Producto',
			'precioCFU' => 'Precio Cfu',
			'precioCFP' => 'Precio Cfp',
			'precioSFU' => 'Precio Sfu',
			'precioSFP' => 'Precio Sfp',
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

		$criteria->compare('idPreciosDistribuidora',$this->idPreciosDistribuidora);
		$criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
		$criteria->compare('precioCFU',$this->precioCFU);
		$criteria->compare('precioCFP',$this->precioCFP);
		$criteria->compare('precioSFU',$this->precioSFU);
		$criteria->compare('precioSFP',$this->precioSFP);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PreciosDistribuidora the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
