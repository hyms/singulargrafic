<?php

/**
 * This is the model class for table "recibo".
 *
 * The followings are the available columns in table 'recibo':
 * @property integer $id
 * @property string $categoria
 * @property string $codigo
 * @property integer $idCliente
 * @property string $responsable
 * @property string $celular
 * @property string $fecha
 * @property string $concepto
 * @property integer $idVenta
 * @property integer $idTrabajo
 * @property double $monto
 * @property double $acuenta
 * @property double $saldo
 * @property string $obs
 * @property integer $tipo
 * @property integer $idEmpleado
 * @property integer $idCaja
 * @property string $descuento
 * @property string $nro
 */
class Recibo extends CActiveRecord
{
	public $max;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recibo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('categoria, codigo, responsable, fecha, concepto, monto, acuenta, saldo, obs, tipo, idEmpleado, idCaja', 'required'),
			array('idCliente, idVenta, idTrabajo, tipo, idEmpleado, idCaja', 'numerical', 'integerOnly'=>true),
			array('monto, acuenta, saldo', 'numerical'),
			array('categoria, responsable, descuento, nro', 'length', 'max'=>50),
			array('codigo', 'length', 'max'=>20),
			array('celular', 'length', 'max'=>15),
			array('concepto', 'length', 'max'=>200),
			array('obs', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categoria, codigo, idCliente, responsable, celular, fecha, concepto, idVenta, idTrabajo, monto, acuenta, saldo, obs, tipo, idEmpleado, idCaja, descuento, nro', 'safe', 'on'=>'search'),
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
				'Venta'=>array(self::BELONGS_TO, 'Venta', 'idVenta'),
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
			'categoria' => 'Categoria',
			'codigo' => 'Codigo',
			'idCliente' => 'Id Cliente',
			'responsable' => 'Responsable',
			'celular' => 'Celular',
			'fecha' => 'Fecha',
			'concepto' => 'Concepto',
			'idVenta' => 'Id Venta',
			'idTrabajo' => 'Id Trabajo',
			'monto' => 'Monto',
			'acuenta' => 'Acuenta',
			'saldo' => 'Saldo',
			'obs' => 'Obs',
			'tipo' => 'Tipo',
			'idEmpleado' => 'Id Empleado',
			'idCaja' => 'Id Caja',
			'descuento' => 'Descuento',
			'nro' => 'Nro',
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
		$criteria->compare('categoria',$this->categoria,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('concepto',$this->concepto,true);
		$criteria->compare('idVenta',$this->idVenta);
		$criteria->compare('idTrabajo',$this->idTrabajo);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('acuenta',$this->acuenta);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('obs',$this->obs,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('idEmpleado',$this->idEmpleado);
		$criteria->compare('idCaja',$this->idCaja);
		$criteria->compare('descuento',$this->descuento,true);
		$criteria->compare('nro',$this->nro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recibo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
