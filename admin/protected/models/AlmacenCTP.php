<?php

/**
 * This is the model class for table "almacenCTP".
 *
 * The followings are the available columns in table 'almacenCTP':
 * @property integer $idAlmacenCTP
 * @property integer $stock
 * @property integer $idAlmacen
 * @property integer $idMatrizPrecios
 * @property integer $idProducto
 *
 * The followings are the available model relations:
 * @property MatrizPreciosCTP[] $matrizPreciosCTPs
 * @property Producto $idProducto0
 * @property DetalleCTP[] $detalleCTPs
 */
class AlmacenCTP extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'almacenCTP';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idAlmacenCTP, stock', 'required'),
			array('idAlmacenCTP, stock, idAlmacen, idMatrizPrecios, idProducto', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idAlmacenCTP, stock, idAlmacen, idMatrizPrecios, idProducto', 'safe', 'on'=>'search'),
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
			'matrizPreciosCTPs' => array(self::HAS_MANY, 'MatrizPreciosCTP', 'idAlmacenCTP'),
			'idProducto0' => array(self::BELONGS_TO, 'Producto', 'idProducto'),
			'detalleCTPs' => array(self::HAS_MANY, 'DetalleCTP', 'idAlmacenCTP'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idAlmacenCTP' => 'Id Almacen Ctp',
			'stock' => 'Stock',
			'idAlmacen' => 'Id Almacen',
			'idMatrizPrecios' => 'Id Matriz Precios',
			'idProducto' => 'Id Producto',
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

		$criteria->compare('idAlmacenCTP',$this->idAlmacenCTP);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('idAlmacen',$this->idAlmacen);
		$criteria->compare('idMatrizPrecios',$this->idMatrizPrecios);
		$criteria->compare('idProducto',$this->idProducto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlmacenCTP the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
