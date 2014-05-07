<?php

/**
 * This is the model class for table "cajaTipo".
 *
 * The followings are the available columns in table 'cajaTipo':
 * @property integer $id
 * @property string $nombre
 * @property integer $idParent
 */
class CajaTipo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cajaTipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, idParent', 'required'),
			array('idParent', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, idParent', 'safe', 'on'=>'search'),
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
			'Caja'=>array(self::HAS_ONE, 'Caja', 'idTipoCaja'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'idParent' => 'Id Parent',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('idParent',$this->idParent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getSuperiores(){
		if($this->id==null)
			return CHtml::listData( $this::model()->findAll(array('select'=>'id, nombre')),'id','nombre' );
		return CHtml::listData( $this::model()->findAll('id!='.$this->id, array('select'=>'id, nombre')),'id','nombre' );
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CajaTipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
