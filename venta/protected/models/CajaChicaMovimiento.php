<?php

/**
 * This is the model class for table "cajaChicaMovimiento".
 *
 * The followings are the available columns in table 'cajaChicaMovimiento':
 * @property integer $idcajaChicaMovimiento
 * @property integer $idUser
 * @property integer $idTipoMovimiento
 * @property double $monto
 * @property double $saldo
 * @property string $fechaMovimiento
 * @property integer $tipoMovimiento
 * @property integer $idcajaChica
 * @property string $detalle
 * @property string $Obs
 * @property integer $registro
 * @property string $factura
 *
 * The followings are the available model relations:
 * @property CajaChica $idcajaChica0
 * @property TipoMovimiento $tipoMovimiento0
 */
class CajaChicaMovimiento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cajaChicaMovimiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('monto, saldo, fechaMovimiento, detalle, Obs, registro, factura', 'required'),
			array('idUser, idTipoMovimiento, tipoMovimiento, idcajaChica, registro', 'numerical', 'integerOnly'=>true),
			array('monto, saldo', 'numerical'),
			array('detalle, Obs', 'length', 'max'=>100),
			array('factura', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcajaChicaMovimiento, idUser, idTipoMovimiento, monto, saldo, fechaMovimiento, tipoMovimiento, idcajaChica, detalle, Obs, registro, factura', 'safe', 'on'=>'search'),
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
			'idcajaChica0' => array(self::BELONGS_TO, 'CajaChica', 'idcajaChica'),
			'tipoMovimiento0' => array(self::BELONGS_TO, 'TipoMovimiento', 'tipoMovimiento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcajaChicaMovimiento' => 'Idcaja Chica Movimiento',
			'idUser' => 'Id User',
			'idTipoMovimiento' => 'Tipo Movimiento',
			'monto' => 'Monto',
			'saldo' => 'Saldo',
			'fechaMovimiento' => 'Fecha Movimiento',
			'tipoMovimiento' => 'Tipo Movimiento',
			'idcajaChica' => 'Idcaja Chica',
			'detalle' => 'Detalle',
			'Obs' => 'Obs',
			'registro' => 'Registro',
			'factura' => 'Factura',
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

		$criteria->compare('idcajaChicaMovimiento',$this->idcajaChicaMovimiento);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('idTipoMovimiento',$this->idTipoMovimiento);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('fechaMovimiento',$this->fechaMovimiento,true);
		$criteria->compare('tipoMovimiento',$this->tipoMovimiento);
		$criteria->compare('idcajaChica',$this->idcajaChica);
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('Obs',$this->Obs,true);
		$criteria->compare('registro',$this->registro);
		$criteria->compare('factura',$this->factura,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CajaChicaMovimiento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
