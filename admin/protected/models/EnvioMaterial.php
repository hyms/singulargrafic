<?php

/**
 * This is the model class for table "envioMaterial".
 *
 * The followings are the available columns in table 'envioMaterial':
 * @property integer $idEnvioMaterial
 * @property string $fechaEnvio
 * @property string $origen
 * @property string $destino
 * @property string $responsable
 * @property integer $idUser
 *
 * The followings are the available model relations:
 * @property DetalleEnvio[] $detalleEnvios
 * @property User $idUser0
 */
class EnvioMaterial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'envioMaterial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUser', 'numerical', 'integerOnly'=>true),
			array('origen, destino, responsable', 'length', 'max'=>45),
			array('fechaEnvio', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idEnvioMaterial, fechaEnvio, origen, destino, responsable, idUser', 'safe', 'on'=>'search'),
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
			'detalleEnvios' => array(self::HAS_MANY, 'DetalleEnvio', 'idEnvioMaterial'),
			'idUser0' => array(self::BELONGS_TO, 'User', 'idUser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idEnvioMaterial' => 'Id Envio Material',
			'fechaEnvio' => 'Fecha Envio',
			'origen' => 'Origen',
			'destino' => 'Destino',
			'responsable' => 'Responsable',
			'idUser' => 'Id User',
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

		$criteria->compare('idEnvioMaterial',$this->idEnvioMaterial);
		$criteria->compare('fechaEnvio',$this->fechaEnvio,true);
		$criteria->compare('origen',$this->origen,true);
		$criteria->compare('destino',$this->destino,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('idUser',$this->idUser);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EnvioMaterial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
