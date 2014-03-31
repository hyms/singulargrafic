<?php

/**
 * This is the model class for table "movimientoAlmacen".
 *
 * The followings are the available columns in table 'movimientoAlmacen':
 * @property integer $id
 * @property integer $idEmpleado
 * @property integer $idAlmacen
 * @property integer $unidad
 * @property integer $paquete
 * @property integer $estado
 * @property integer $tipo
 * @property string $fechaInicio
 * @property string $fechaFinal
 */
class MovimientoAlmacen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'movimientoAlmacen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idAlmacen, estado, fechaInicio', 'required'),
			array('idEmpleado, idAlmacen, unidad, paquete, estado', 'numerical', 'integerOnly'=>true,'message'=>'El campo <b>{attribute}</b> solo puede ser numerico'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idEmpleado, idAlmacen, unidad, paquete, estado, tipo, fechaInicio, fechaFinal', 'safe', 'on'=>'search'),
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
				'Empleado'=>array(self::BELONGS_TO, 'Empleado', 'idEmpleado'),
				'Almacen'=>array(self::BELONGS_TO, 'Almacen', 'idAlmacen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idEmpleado' => 'Id Empleado',
			'idAlmacen' => 'Id Almacen',
			'unidad' => 'Unidad',
			'paquete' => 'Paquete',
			'estado' => 'Estado',
			'tipo' => 'Tipo',	
			'fechaInicio' => 'Fecha Inicio',
			'fechaFinal' => 'Fecha Final',
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
		$criteria->compare('idEmpleado',$this->idEmpleado);
		$criteria->compare('idAlmacen',$this->idAlmacen);
		$criteria->compare('unidad',$this->unidad);
		$criteria->compare('paquete',$this->paquete);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('fechaInicio',$this->fechaInicio,true);
		$criteria->compare('fechaFinal',$this->fechaFinal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MovimientoAlmacen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
