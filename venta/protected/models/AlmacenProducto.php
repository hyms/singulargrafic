<?php

/**
 * This is the model class for table "almacenProducto".
 *
 * The followings are the available columns in table 'almacenProducto':
 * @property integer $idAlmacenProducto
 * @property integer $idProducto
 * @property integer $stockU
 * @property integer $stockP
 * @property integer $idAlmacen
 *
 * The followings are the available model relations:
 * @property Producto $idProducto0
 * @property Almacen $idAlmacen0
 * @property DetalleVenta[] $detalleVentas
 */
class AlmacenProducto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'almacenProducto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProducto, stockU, stockP, idAlmacen', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idAlmacenProducto, idProducto, stockU, stockP, idAlmacen', 'safe', 'on'=>'search'),
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
			'idProducto0' => array(self::BELONGS_TO, 'Producto', 'idProducto'),
			'idAlmacen0' => array(self::BELONGS_TO, 'Almacen', 'idAlmacen'),
			'detalleVentas' => array(self::HAS_MANY, 'DetalleVenta', 'idAlmacenProducto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idAlmacenProducto' => 'Id Almacen Producto',
			'idProducto' => 'Id Producto',
			'stockU' => 'Stock U',
			'stockP' => 'Stock P',
			'idAlmacen' => 'Id Almacen',
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

		$criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
		$criteria->compare('idProducto',$this->idProducto);
		$criteria->compare('stockU',$this->stockU);
		$criteria->compare('stockP',$this->stockP);
		$criteria->compare('idAlmacen',$this->idAlmacen);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public $codigo;
	public $detalle;
	public $material;
	public $color;
	public $industria;
	public $paquete;
	public function searchAll()
	{
		$criteria=new CDbCriteria;
	
		$criteria->with= array(
				'idProducto0',
		);
		$criteria->condition = 'idAlmacen=1';
	
		$criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
		$criteria->compare('idProducto',$this->idProducto);
		$criteria->compare('stockU',$this->stockU);
		$criteria->compare('stockP',$this->stockP);
		$criteria->compare('idAlmacen',$this->idAlmacen);
		
		$criteria->compare('idProducto0.codigo',$this->codigo,true);
		$criteria->compare('idProducto0.detalle',$this->detalle,true);
		$criteria->compare('idProducto0.material',$this->material,true);
		$criteria->compare('idProducto0.color',$this->color,true);
		$criteria->compare('idProducto0.industria',$this->industria,true);
		$criteria->compare('idProducto0.cantXPaquete',$this->paquete,true);
		//$criteria->compare('idProducto',$this->idProducto);
		//$criteria->compare('stockU',$this->stockU);
		//$criteria->compare('stockP',$this->stockP);
		//$criteria->compare('idAlmacen',$this->idAlmacen);
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>4,
				),
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlmacenProducto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
