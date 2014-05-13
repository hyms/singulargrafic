<?php

/**
 * This is the model class for table "cajaVenta".
 *
 * The followings are the available columns in table 'cajaVenta':
 * @property integer $idCajaVenta
 * @property integer $idCaja
 * @property integer $idUser
 * @property double $saldo
 * @property string $fechaArqueo
 * @property integer $entregado
 *
 * The followings are the available model relations:
 * @property Caja $idCaja0
 * @property User $idUser0
 * @property Recibos[] $reciboses
 * @property Venta[] $ventas
 */
class CajaVenta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cajaVenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCaja, idUser, entregado', 'numerical', 'integerOnly'=>true),
			array('saldo', 'numerical'),
			array('fechaArqueo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCajaVenta, idCaja, idUser, saldo, fechaArqueo, entregado', 'safe', 'on'=>'search'),
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
			'idUser0' => array(self::BELONGS_TO, 'User', 'idUser'),
			'reciboses' => array(self::HAS_MANY, 'Recibos', 'idCaja'),
			'ventas' => array(self::HAS_MANY, 'Venta', 'idCaja'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCajaVenta' => 'Id Caja Venta',
			'idCaja' => 'Id Caja',
			'idUser' => 'Id User',
			'saldo' => 'Saldo',
			'fechaArqueo' => 'Fecha Arqueo',
			'entregado' => 'Entregado',
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

		$criteria->compare('idCajaVenta',$this->idCajaVenta);
		$criteria->compare('idCaja',$this->idCaja);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('fechaArqueo',$this->fechaArqueo,true);
		$criteria->compare('entregado',$this->entregado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CajaVenta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
