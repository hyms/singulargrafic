<?php

/**
 * This is the model class for table "almacenProducto".
 *
 * The followings are the available columns in table 'almacenProducto':
 * @property integer $idAlmacenProducto
 * @property integer $idProducto
 * @property integer $stockU
 * @property integer $stockP
 * @property integer $idAlmacen
 *
 * The followings are the available model relations:
 * @property MatrizPreciosCTP[] $matrizPreciosCTPs
 * @property Almacen $idAlmacen0
 * @property Producto $idProducto0
 * @property DetalleCTP[] $detalleCTPs
 * @property DetalleEnvio[] $detalleEnvios
 * @property DetalleVenta[] $detalleVentas
 * @property PreciosDistribuidora[] $preciosDistribuidoras
 * @property SaldoProducto[] $saldoProductos
 */
class AlmacenProducto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'almacenProducto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProducto, stockU, stockP, idAlmacen', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idAlmacenProducto, idProducto, stockU, stockP, idAlmacen', 'safe', 'on'=>'search'),
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
			'matrizPreciosCTPs' => array(self::HAS_MANY, 'MatrizPreciosCTP', 'idAlmacenProducto'),
			'idAlmacen0' => array(self::BELONGS_TO, 'Almacen', 'idAlmacen'),
			'idProducto0' => array(self::BELONGS_TO, 'Producto', 'idProducto'),
			'detalleCTPs' => array(self::HAS_MANY, 'DetalleCTP', 'idAlmacenProducto'),
			'detalleEnvios' => array(self::HAS_MANY, 'DetalleEnvio', 'idAlmacenProducto'),
			'detalleVentas' => array(self::HAS_MANY, 'DetalleVenta', 'idAlmacenProducto'),
			'preciosDistribuidoras' => array(self::HAS_MANY, 'PreciosDistribuidora', 'idAlmacenProducto'),
			'saldoProductos' => array(self::HAS_MANY, 'SaldoProducto', 'idAlmacen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idAlmacenProducto' => 'Id Almacen Producto',
			'idProducto' => 'Id Producto',
			'stockU' => 'Stock U',
			'stockP' => 'Stock P',
			'idAlmacen' => 'Id Almacen',
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

    public $codigo;
    public $detalle;
    public $material;
    public $color;
    public $marca;
    public $paquete;
    public $industria;
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->with= array(
            'idProducto0',
        );
        $criteria->order = 'idProducto0.Material,idProducto0.codigo, idProducto0.detalle';

        $criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
        $criteria->compare('idProducto',$this->idProducto);
        $criteria->compare('stockU',$this->stockU);
        $criteria->compare('stockP',$this->stockP);
        $criteria->compare('`t`.idAlmacen',$this->idAlmacen);

        $criteria->compare('idProducto0.codigo',$this->codigo,true);
        $criteria->compare('idProducto0.detalle',$this->detalle,true);
        $criteria->compare('idProducto0.material',$this->material,true);
        $criteria->compare('idProducto0.color',$this->color,true);
        $criteria->compare('idProducto0.marca',$this->marca,true);
        $criteria->compare('idProducto0.cantXPaquete',$this->paquete,true);
        $criteria->compare('idProducto0.industria',$this->industria,true);

        $data = new CActiveDataProvider($this, array(
            'criteria'=>$criteria,

        ));
        Yii::app()->session['excel']= $this;
        return $data;
    }

    /*public function searchDistribuidora()
    {
        $criteria=new CDbCriteria;

        $criteria->with= array(
                'idProducto0',
        );
        $criteria->condition = 'idAlmacen=1';


        $criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
        $criteria->compare('idProducto',$this->idProducto);
        $criteria->compare('stockU',$this->stockU);
        $criteria->compare('stockP',$this->stockP);
        //$criteria->compare('idAlmacen',$this->idAlmacen);

        $criteria->compare('idProducto0.codigo',$this->codigo,true);
        $criteria->compare('idProducto0.detalle',$this->detalle,true);
        $criteria->compare('idProducto0.material',$this->material,true);
        $criteria->compare('idProducto0.color',$this->color,true);
        $criteria->compare('idProducto0.marca',$this->marca,true);
        $criteria->compare('idProducto0.cantXPaquete',$this->paquete,true);
        //$criteria->compare('idProducto',$this->idProducto);
        //$criteria->compare('stockU',$this->stockU);
        //$criteria->compare('stockP',$this->stockP);
        //$criteria->compare('idAlmacen',$this->idAlmacen);

        $data = new CActiveDataProvider($this, array(
                'criteria'=>$criteria,

        ));
        Yii::app()->session['excel']= $this;
        return $data;
    }
    */

    public function searchInventarioGral()
    {
        $criteria=new CDbCriteria;

        $criteria->with= array('idProducto0',);
        if(!empty($this->detalle))
            $criteria->condition = 'idAlmacen=1 and (idProducto0.detalle like "%'.$this->detalle.'%" or idProducto0.color like "%'.$this->detalle.'%" or idProducto0.marca like "%'.$this->detalle.'%")';
        else
            $criteria->condition = 'idAlmacen=1';
        $criteria->order = 'idProducto0.Material,idProducto0.codigo, idProducto0.detalle';
        //$criteria->order = 'idAlmacenProducto',

        $criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
        $criteria->compare('idProducto',$this->idProducto);
        $criteria->compare('stockU',$this->stockU);
        $criteria->compare('stockP',$this->stockP);
        //$criteria->compare('idAlmacen',$this->idAlmacen);

        $criteria->compare('idProducto0.codigo',$this->codigo,true);
        $criteria->compare('idProducto0.material',$this->material,true);
        $criteria->compare('idProducto0.industria',$this->industria,true);

        $data= new CActiveDataProvider($this, array(
            'criteria'=>$criteria,

        ));
        Yii::app()->session['excel']= $this;
        return $data;
    }

    public function searchStockDist()
    {
        $criteria=new CDbCriteria;

        $criteria->with= array('idProducto0',);
        if(!empty($this->detalle))
            $criteria->condition = 'idAlmacen=2 and (idProducto0.detalle like "%'.$this->detalle.'%" or idProducto0.color like "%'.$this->detalle.'%" or idProducto0.marca like "%'.$this->detalle.'%")';
        else
            $criteria->condition = 'idAlmacen=2';
        $criteria->order = 'idProducto0.Material,idProducto0.codigo, idProducto0.detalle';

        $criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
        $criteria->compare('idProducto',$this->idProducto);
        $criteria->compare('stockU',$this->stockU);
        $criteria->compare('stockP',$this->stockP);
        //$criteria->compare('idAlmacen',$this->idAlmacen);

        $criteria->compare('idProducto0.codigo',$this->codigo,true);
        $criteria->compare('idProducto0.material',$this->material,true);
        $criteria->compare('idProducto0.industria',$this->industria,true);

        $data = new CActiveDataProvider($this, array(
            'criteria'=>$criteria,

        ));
        Yii::app()->session['excel']= $this;
        return $data;
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AlmacenProducto the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getLink($id,$almacen)
    {
        $producto=AlmacenProducto::model()->find('idProducto='.$id." and idAlmacen=".$almacen);
        $return="";
        $detalle=$this->idProducto0->material." ".$this->idProducto0->color." ".$this->idProducto0->detalle." ".$this->idProducto0->marca;
        if(empty($producto))
            $return = CHtml::link("<span class=\"glyphicon glyphicon-ok\"></span>Añadir", array("productos/productoAdd", "id"=>$id, "almacen"=>$almacen), array('class'=>'btn btn-success btn-sm','title'=>'Añadir Producto','onclick'=>"return confirm('Desea añadir el producto ".$detalle."?')"));
        else
            $return = CHtml::link("<span class=\"glyphicon glyphicon-remove\"></span>Eliminar", array("productos/productoDel", "id"=>$id, "almacen"=>$almacen), array('class'=>'btn btn-danger btn-sm','title'=>'Eliminar Producto','onclick'=>"return confirm('Desea eliminar el producto ".$detalle."?')"));
        return $return;
    }
    public function distribuidoraLink($id)
    {
        $producto=AlmacenProducto::model()->find('idProducto='.$id." and idAlmacen=2");
        $return="";
        if(empty($producto))
            $return = CHtml::link("Añadir",array("stock/DistribuidoraAdd","id"=>$id));
        else
            $return=$producto->stockU."/".$producto->stockP;
        return $return;
    }

    public function ctpLink($id)
    {
        $producto=AlmacenProducto::model()->find('idProducto='.$id." and idAlmacen=3");
        $return="";
        if(empty($producto))
            $return = CHtml::link("Añadir",array("stock/ctpAdd","id"=>$id));
        else
            $return=$producto->stockU."/".$producto->stockP;
        return $return;
    }
}
