<?php

/**
 * This is the model class for table "movimientoCaja".
 *
 * The followings are the available columns in table 'movimientoCaja':
 * @property integer $idMovimientoCaja
 * @property double $monto
 * @property string $motivo
 * @property string $fechaMovimiento
 * @property integer $idUser
 * @property integer $idCaja
 *
 * The followings are the available model relations:
 * @property Users $idUser0
 * @property CajaVenta $idCaja0
 */
class MovimientoCaja extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'movimientoCaja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUser, idCaja', 'numerical', 'integerOnly'=>true),
			array('monto', 'numerical'),
			array('motivo', 'length', 'max'=>100),
			array('fechaMovimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idMovimientoCaja, monto, motivo, fechaMovimiento, idUser, idCaja', 'safe', 'on'=>'search'),
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
			'idUser0' => array(self::BELONGS_TO, 'Users', 'idUser'),
			'idCaja0' => array(self::BELONGS_TO, 'CajaVenta', 'idCaja'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idMovimientoCaja' => 'Id Movimiento Caja',
			'monto' => 'Monto',
			'motivo' => 'Motivo',
			'fechaMovimiento' => 'Fecha Movimiento',
			'idUser' => 'Id User',
			'idCaja' => 'Id Caja',
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

		$criteria->compare('idMovimientoCaja',$this->idMovimientoCaja);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('motivo',$this->motivo,true);
		$criteria->compare('fechaMovimiento',$this->fechaMovimiento,true);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('idCaja',$this->idCaja);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MovimientoCaja the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
