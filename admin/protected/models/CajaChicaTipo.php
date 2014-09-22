<?php

/**
 * This is the model class for table "cajaChicaTipo".
 *
 * The followings are the available columns in table 'cajaChicaTipo':
 * @property integer $idcajaChicaTipo
 * @property integer $idcajaChica
 * @property integer $idTipoMovimiento
 *
 * The followings are the available model relations:
 * @property TipoMovimiento $idTipoMovimiento0
 * @property CajaChica $idcajaChica0
 */
class CajaChicaTipo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cajaChicaTipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcajaChica, idTipoMovimiento', 'required'),
			array('idcajaChica, idTipoMovimiento', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcajaChicaTipo, idcajaChica, idTipoMovimiento', 'safe', 'on'=>'search'),
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
			'idTipoMovimiento0' => array(self::BELONGS_TO, 'TipoMovimiento', 'idTipoMovimiento'),
			'idcajaChica0' => array(self::BELONGS_TO, 'CajaChica', 'idcajaChica'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcajaChicaTipo' => 'Idcaja Chica Tipo',
			'idcajaChica' => 'Idcaja Chica',
			'idTipoMovimiento' => 'Id Tipo Movimiento',
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

		$criteria->compare('idcajaChicaTipo',$this->idcajaChicaTipo);
		$criteria->compare('idcajaChica',$this->idcajaChica);
		$criteria->compare('idTipoMovimiento',$this->idTipoMovimiento);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CajaChicaTipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
