<?php

/**
 * This is the model class for table "newsRelation".
 *
 * The followings are the available columns in table 'newsRelation':
 * @property integer $idnewsRelation
 * @property integer $idNews
 * @property integer $idSucursal
 * @property integer $idUser
 *
 * The followings are the available model relations:
 * @property News $idNews0
 * @property Sucursal $idSucursal0
 * @property User $idUser0
 */
class NewsRelation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'newsRelation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idNews, idSucursal, idUser', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idnewsRelation, idNews, idSucursal, idUser', 'safe', 'on'=>'search'),
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
			'idNews0' => array(self::BELONGS_TO, 'News', 'idNews'),
			'idSucursal0' => array(self::BELONGS_TO, 'Sucursal', 'idSucursal'),
			'idUser0' => array(self::BELONGS_TO, 'User', 'idUser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idnewsRelation' => 'Idnews Relation',
			'idNews' => 'Id News',
			'idSucursal' => 'Id Sucursal',
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

		$criteria->compare('idnewsRelation',$this->idnewsRelation);
		$criteria->compare('idNews',$this->idNews);
		$criteria->compare('idSucursal',$this->idSucursal);
		$criteria->compare('idUser',$this->idUser);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewsRelation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
