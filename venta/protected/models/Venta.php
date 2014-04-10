<?php

/**
 * This is the model class for table "venta".
 *
 * The followings are the available columns in table 'venta':
 * @property integer $id
 * @property integer $idTipoPago
 * @property integer $idCliente
 * @property string $fechaVenta
 * @property string $fechaPlazo
 * @property integer $idEmpleado
 * @property double $montoTotal
 * @property double $montoPagado
 * @property double $montoCambio
 * @property string $codigo
 * @property integer $estado
 * @property string $autorizado
 * @property string $obs
 */
class Venta extends CActiveRecord
{
	public $max;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'venta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTipoPago, idCliente, fechaVenta, idEmpleado, montoTotal, montoPagado, montoCambio, codigo, estado', 'required','message'=>'El campo <b>{attribute}</b> es obligatorio'),
			array('idTipoPago, idCliente, idEmpleado, estado', 'numerical', 'integerOnly'=>true,'message'=>'El campo <b>{attribute}</b> solo puede ser numerico'),
			array('montoTotal, montoPagado, montoCambio', 'numerical','message'=>'El campo <b>{attribute}</b> solo puede ser numerico'),
			array('codigo, autorizado', 'length', 'max'=>20 ,'message'=>'El campo <b>{attribute}</b> solo puede tener 20 caracteres'),
			array('obs', 'length', 'max'=>200 ,'message'=>'El campo <b>{attribute}</b> solo puede tener 200 caracteres'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idTipoPago, idCliente, fechaVenta, fechaPlazo, idEmpleado, montoTotal, montoPagado, montoCambio, codigo, estado, autorizado, obs', 'safe', 'on'=>'search'),
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
			'Cliente'=>array(self::BELONGS_TO, 'Cliente', 'idCliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTipoPago' => 'Id Tipo Pago',
			'idCliente' => 'Id Cliente',
			'fechaVenta' => 'Fecha Venta',
			'fechaPlazo' => 'Fecha Plazo',
			'idEmpleado' => 'Id Empleado',
			'montoTotal' => 'Total',
			'montoPagado' => 'Pagado',
			'montoCambio' => 'Cambio',
			'codigo' => 'Codigo',
			'estado' => 'Estado',
			'autorizado' => 'Autorizado',
			'obs' => 'Observaciones',
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
		$criteria->compare('idTipoPago',$this->idTipoPago);
		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('fechaVenta',$this->fechaVenta,true);
		$criteria->compare('fechaPlazo',$this->fechaPlazo,true);
		$criteria->compare('idEmpleado',$this->idEmpleado);
		$criteria->compare('montoTotal',$this->montoTotal);
		$criteria->compare('montoPagado',$this->montoPagado);
		$criteria->compare('montoCambio',$this->montoCambio);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('autorizado',$this->autorizado);
		$criteria->compare('obs',$this->obs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Venta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
