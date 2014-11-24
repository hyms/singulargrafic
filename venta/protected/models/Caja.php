<?php

/**
 * This is the model class for table "caja".
 *
 * The followings are the available columns in table 'caja':
 * @property integer $idCaja
 * @property string $nombre
 * @property double $saldo
 * @property integer $idParent
 * @property integer $idSucursal
 *
 * The followings are the available model relations:
 * @property Caja $idParent0
 * @property Caja[] $cajas
 * @property Sucursal $idSucursal0
 * @property CajaArqueo[] $cajaArqueos
 * @property CajaChica[] $cajaChicas
 * @property CajaMovimientoVenta[] $cajaMovimientoVentas
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
			//array('nombre, saldo', 'required'),
			array('idParent, idSucursal', 'numerical', 'integerOnly'=>true),
			array('saldo', 'numerical'),
			array('nombre', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCaja, nombre, saldo, idParent, idSucursal', 'safe', 'on'=>'search'),
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
			'idSucursal0' => array(self::BELONGS_TO, 'Sucursal', 'idSucursal'),
			'cajaArqueos' => array(self::HAS_MANY, 'CajaArqueo', 'idCaja'),
			'cajaChicas' => array(self::HAS_MANY, 'CajaChica', 'idCaja'),
			'cajaMovimientoVentas' => array(self::HAS_MANY, 'CajaMovimientoVenta', 'idCaja'),
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
			'saldo' => 'Saldo',
			'idParent' => 'Id Parent',
			'idSucursal' => 'Id Sucursal',
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
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('idParent',$this->idParent);
		$criteria->compare('idSucursal',$this->idSucursal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
