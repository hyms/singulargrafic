<?php

/**
 * This is the model class for table "movimientoCaja".
 *
 * The followings are the available columns in table 'movimientoCaja':
 * @property integer $id
 * @property integer $idCaja
 * @property string $fecha
 * @property integer $monto
 * @property string $obs
 * @property integer $tipo
 * @property integer $idComprovante
 * @property integer $idEmpleado
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
			array('fecha, monto, obs, tipo, idEmpleado', 'required','message'=>'El campo <b>{attribute}</b> es obligatorio'),
			array('idCaja, monto, tipo, idComprovante, idEmpleado', 'numerical', 'integerOnly'=>true),
			array('obs', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idCaja, fecha, monto, obs, tipo, idComprovante, idEmpleado', 'safe', 'on'=>'search'),
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
			'Caja'=>array(self::BELONGS_TO, 'Caja', 'idCaja'),
			'Empleado'=>array(self::BELONGS_TO, 'Empleado', 'idEmpleado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idCaja' => 'Id Caja',
			'fecha' => 'Fecha',
			'monto' => 'Monto',
			'obs' => 'Obs',
			'tipo' => 'Tipo',
			'idComprovante' => 'Id Comprovante',
			'idEmpleado' => 'Id Empleado',
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
		$criteria->compare('idCaja',$this->idCaja);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('obs',$this->obs,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('idComprovante',$this->idComprovante);
		$criteria->compare('idEmpleado',$this->idEmpleado);

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
