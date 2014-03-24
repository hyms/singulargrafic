<?php

/**
 * This is the model class for table "ventaTmp".
 *
 * The followings are the available columns in table 'ventaTmp':
 * @property integer $id
 * @property string $codigo
 * @property integer $idPago
 * @property string $fechaVenta
 * @property string $fechaModifcacion
 * @property integer $Estado
 * @property integer $idCliente
 * @property integer $idEmpleado
 * @property string $obs
 */
class Venta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ventaTmp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, idPago, fechaModifcacion, idCliente, idEmpleado, obs', 'required'),
			array('idPago, Estado, idCliente, idEmpleado', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>20),
			array('obs', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, codigo, idPago, fechaVenta, fechaModifcacion, Estado, idCliente, idEmpleado, obs', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Codigo',
			'idPago' => 'Pago',
			'fechaVenta' => 'Fecha Venta',
			'fechaModifcacion' => 'Fecha Modifcacion',
			'Estado' => 'Estado',
			'idCliente' => 'Cliente',
			'idEmpleado' => 'Responsable',
			'obs' => 'Obs',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('idPago',$this->idPago);
		$criteria->compare('fechaVenta',$this->fechaVenta,true);
		$criteria->compare('fechaModifcacion',$this->fechaModifcacion,true);
		$criteria->compare('Estado',$this->Estado);
		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('idEmpleado',$this->idEmpleado);
		$criteria->compare('obs',$this->obs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VentaTmp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
