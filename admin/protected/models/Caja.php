<?php

/**
 * This is the model class for table "caja".
 *
 * The followings are the available columns in table 'caja':
 * @property integer $idCaja
 * @property string $nombre
 * @property integer $idParent
 *
 * The followings are the available model relations:
 * @property Caja $idParent0
 * @property Caja[] $cajas
 * @property CajaVenta[] $cajaVentas
 * @property MovimientoCaja[] $movimientoCajas
 */
class Caja extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'caja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idParent', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCaja, nombre, idParent', 'safe', 'on'=>'search'),
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
			'idParent0' => array(self::BELONGS_TO, 'Caja', 'idParent'),
			'cajas' => array(self::HAS_MANY, 'Caja', 'idParent'),
			'cajaVentas' => array(self::HAS_MANY, 'CajaVenta', 'idCaja'),
			'movimientoCajas' => array(self::HAS_MANY, 'MovimientoCaja', 'idCaja'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCaja' => 'Id Caja',
			'nombre' => 'Nombre',
			'idParent' => 'Caja Superior',
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

		$criteria->compare('idCaja',$this->idCaja);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('idParent',$this->idParent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCajas()
	{
		$cajas = Caja::model()->findAll();
		if(!empty($this->idCaja))
			$cajas = Caja::model()->findAll("idCaja!=".$this->idCaja);
		$cajas = CHtml::listData($cajas,'idCaja','nombre');
		return $cajas;
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Caja the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
