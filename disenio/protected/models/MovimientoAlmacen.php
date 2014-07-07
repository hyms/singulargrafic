<?php

/**
 * This is the model class for table "movimientoAlmacen".
 *
 * The followings are the available columns in table 'movimientoAlmacen':
 * @property integer $idMovimientoAlmacen
 * @property integer $idProducto
 * @property integer $idAlmacenOrigen
 * @property integer $idAlmacenDestino
 * @property integer $cantidadU
 * @property integer $cantidadP
 * @property integer $idUser
 * @property string $fechaMovimiento
 *
 * The followings are the available model relations:
 * @property Producto $idProducto0
 * @property Almacen $idAlmacenOrigen0
 * @property Almacen $idAlmacenDestino0
 * @property User $idUser0
 */
class MovimientoAlmacen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'movimientoAlmacen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProducto, idAlmacenOrigen, idAlmacenDestino, cantidadU, cantidadP, idUser', 'numerical', 'integerOnly'=>true),
			array('fechaMovimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idMovimientoAlmacen, idProducto, idAlmacenOrigen, idAlmacenDestino, cantidadU, cantidadP, idUser, fechaMovimiento', 'safe', 'on'=>'search'),
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
			'idAlmacenOrigen0' => array(self::BELONGS_TO, 'Almacen', 'idAlmacenOrigen'),
			'idAlmacenDestino0' => array(self::BELONGS_TO, 'Almacen', 'idAlmacenDestino'),
			'idUser0' => array(self::BELONGS_TO, 'User', 'idUser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idMovimientoAlmacen' => 'Id Movimiento Almacen',
			'idProducto' => 'Id Producto',
			'idAlmacenOrigen' => 'Id Almacen Origen',
			'idAlmacenDestino' => 'Id Almacen Destino',
			'cantidadU' => 'Cantidad Unidad',
			'cantidadP' => 'Cantidad Paquete',
			'idUser' => 'Id User',
			'fechaMovimiento' => 'Fecha Movimiento',
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

		$criteria->compare('idMovimientoAlmacen',$this->idMovimientoAlmacen);
		$criteria->compare('idProducto',$this->idProducto);
		$criteria->compare('idAlmacenOrigen',$this->idAlmacenOrigen);
		$criteria->compare('idAlmacenDestino',$this->idAlmacenDestino);
		$criteria->compare('cantidadU',$this->cantidadU);
		$criteria->compare('cantidadP',$this->cantidadP);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('fechaMovimiento',$this->fechaMovimiento,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MovimientoAlmacen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
