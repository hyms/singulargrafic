<?php

/**
 * This is the model class for table "fallasCTP".
 *
 * The followings are the available columns in table 'fallasCTP':
 * @property integer $idfallasCTP
 * @property integer $idCtpRep
 * @property string $obs
 * @property string $fecha
 * @property string $nombre
 * @property double $costoT
 * @property integer $idEmpleado
 *
 * The followings are the available model relations:
 * @property Empleado $idEmpleado0
 * @property CTP $idCtpRep0
 */
class FallasCTP extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fallasCTP';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCtpRep, idEmpleado', 'numerical', 'integerOnly'=>true),
			array('costoT', 'numerical'),
			array('obs', 'length', 'max'=>60),
			array('nombre', 'length', 'max'=>45),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idfallasCTP, idCtpRep, obs, fecha, nombre, costoT, idEmpleado', 'safe', 'on'=>'search'),
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
			'idEmpleado0' => array(self::BELONGS_TO, 'Empleado', 'idEmpleado'),
			'idCtpRep0' => array(self::BELONGS_TO, 'CTP', 'idCtpRep'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idfallasCTP' => 'Idfallas Ctp',
			'idCtpRep' => 'Id Ctp Rep',
			'obs' => 'Obs',
			'fecha' => 'Fecha',
			'nombre' => 'Nombre',
			'costoT' => 'Costo T',
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

		$criteria->compare('idfallasCTP',$this->idfallasCTP);
		$criteria->compare('idCtpRep',$this->idCtpRep);
		$criteria->compare('obs',$this->obs,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('costoT',$this->costoT);
		$criteria->compare('idEmpleado',$this->idEmpleado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FallasCTP the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
