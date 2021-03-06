<?php

/**
 * This is the model class for table "detalleEnvio".
 *
 * The followings are the available columns in table 'detalleEnvio':
 * @property integer $idDetalleEnvio
 * @property integer $idAlmacenProducto
 * @property integer $cantidadP
 * @property integer $cantidadU
 * @property integer $idEnvioMaterial
 *
 * The followings are the available model relations:
 * @property AlmacenProducto $idAlmacenProducto0
 * @property EnvioMaterial $idEnvioMaterial0
 */
class DetalleEnvio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalleEnvio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idAlmacenProducto, cantidadP, cantidadU, idEnvioMaterial', 'required'),
			array('idAlmacenProducto, cantidadP, cantidadU, idEnvioMaterial', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idDetalleEnvio, idAlmacenProducto, cantidadP, cantidadU, idEnvioMaterial', 'safe', 'on'=>'search'),
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
			'idEnvioMaterial0' => array(self::BELONGS_TO, 'EnvioMaterial', 'idEnvioMaterial'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idDetalleEnvio' => 'Id Detalle Envio',
			'idAlmacenProducto' => 'Id Almacen Producto',
			'cantidadP' => 'Cantidad P',
			'cantidadU' => 'Cantidad U',
			'idEnvioMaterial' => 'Id Envio Material',
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

		$criteria->compare('idDetalleEnvio',$this->idDetalleEnvio);
		$criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
		$criteria->compare('cantidadP',$this->cantidadP);
		$criteria->compare('cantidadU',$this->cantidadU);
		$criteria->compare('idEnvioMaterial',$this->idEnvioMaterial);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleEnvio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
