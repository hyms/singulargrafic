<?php

/**
 * This is the model class for table "cajaChica".
 *
 * The followings are the available columns in table 'cajaChica':
 * @property integer $idcajaChica
 * @property integer $idUser
 * @property integer $idCaja
 * @property double $saldo
 * @property double $maximo
 * @property string $detalle
 *
 * The followings are the available model relations:
 * @property Caja $idCaja0
 * @property User $idUser0
 * @property CajaChicaMovimiento[] $cajaChicaMovimientos
 * @property CajaChicaTipo[] $cajaChicaTipos
 */
class CajaChica extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cajaChica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('saldo', 'required'),
			array('idUser, idCaja', 'numerical', 'integerOnly'=>true),
			array('saldo, maximo', 'numerical'),
			array('detalle', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcajaChica, idUser, idCaja, saldo, maximo, detalle', 'safe', 'on'=>'search'),
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
			'idCaja0' => array(self::BELONGS_TO, 'Caja', 'idCaja'),
			'idUser0' => array(self::BELONGS_TO, 'Users', 'idUser'),
			'cajaChicaMovimientos' => array(self::HAS_MANY, 'CajaChicaMovimiento', 'idcajaChica'),
			'cajaChicaTipos' => array(self::HAS_MANY, 'CajaChicaTipo', 'idcajaChica'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcajaChica' => 'Idcaja Chica',
			'idUser' => 'Id User',
			'idCaja' => 'Id Caja',
			'saldo' => 'Saldo',
			'maximo' => 'Maximo',
			'detalle' => 'Detalle',
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

		$criteria->compare('idcajaChica',$this->idcajaChica);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('idCaja',$this->idCaja);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('maximo',$this->maximo);
		$criteria->compare('detalle',$this->detalle,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CajaChica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
