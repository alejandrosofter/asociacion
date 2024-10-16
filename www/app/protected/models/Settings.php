<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $category
 * @property string $key
 * @property string $value
 */
class Settings extends CActiveRecord
{
	public $descripcion;
        public $idUsuario;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function num2letras($num, $fem = false, $dec = true) { 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 
   
   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];

   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'as'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . '?n'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   //Zi hack --> return ucfirst($tex);
   $end_num=ucfirst($tex).' pesos '.$float[1].'/100';
   return $end_num; 
} 

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'settings';
	}
	public function getEstadosAlertas()
	{
    	return array('1' => 'Activa', '0' => 'Desactiva');
	}
  public function getEstadosMails()
  {
      return array('1' => 'Activa', '0' => 'Desactiva', '2' => 'Test');
  }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key, value,descripcion', 'required'),
			array('category,idUsuario', 'length', 'max'=>64),
			array('key', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idUsuario, category, key, value', 'safe', 'on'=>'search'),
		);
	}
	public function getSetting($valor,$idUsuario=null)
	{
		$connection=Yii::app()->getDb();
                if($idUsuario==null)
		$sql="SELECT * from settings t WHERE t.key='$valor'";
                else $sql="SELECT * from settings t WHERE t.key='$valor' AND idUsuario='$idUsuario'";
        $command=$connection->createCommand($sql);
  
            $res= $command->queryAll();
		if(count($res)>0) return $res[0];
		return false;
	}
//	public function getValorSistema($valor)
//	{
//		$connection=Yii::app()->getDb();
//        $command=$connection->createCommand(
//"SELECT * from settings t WHERE t.key='$valor'
//");
//            
//            $res= $command->queryAll();
//		if(count($res>0)) return $res[0]['value'];
//		return false;
//	}
	public function getValorSistema($valor,$params=null,$categoriaNuevo=null,$idUsuario=null)
	{
		$connection=Yii::app()->getDb();
                if($idUsuario==null)
                    $sql="SELECT * from settings t WHERE t.key='$valor'";
                        else $sql="SELECT * from settings t WHERE t.key='$valor' AND t.idUsuario='$idUsuario'";
                    
                $command=$connection->createCommand($sql);
            
                $res= $command->queryAll();
            
		if(count($res)>0) $salida= html_entity_decode($res[0]['value']);else{
			//echo 'nuevo!';
			$model=new Settings;
			$model->key=$valor;
			$model->value=$valor;
			$model->descripcion=$valor;
			$model->category=$categoriaNuevo;
                        $model->idUsuario=$idUsuario;
			$model->save();
			//if($model->save())echo 'salvo';else print_r($model->errors);
			$salida='';
		}
		if($params!=null)
		foreach($params as $campo=>$item)
			$salida = str_replace("%".$campo, $item,$salida);
			
		return $salida;
	}
        public function setValorSistemaUsuario($key,$valor,$idUsuario)
	{
		$item=$this->getSetting($key,$idUsuario);
		$item=$item['id'];

		if($item!=false){
			$connection=Yii::app()->getDb();
                        $sql=" UPDATE settings SET value = \"$valor\" WHERE id ='$item' AND idUsuario='$idUsuario'";
        	$command=$connection->createCommand($sql);
        	
            $res= $command->query();
		}
	}
	public function setValorSistema($key,$valor)
	{
		$item=$this->getSetting($key);
		$item=$item['id'];$valor=htmlentities($valor);
		if($item!=false){
			$connection=Yii::app()->getDb();
                      
			$sql=" UPDATE settings SET value = \"$valor\" WHERE id ='$item'";
        	$command=$connection->createCommand($sql);
        	
            $res= $command->query();
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'key' => 'Key',
			'value' => 'Value',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function consultarVariablesSistema()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category','impresiones',true,'<>');
		$criteria->compare('key',$this->key,true);
		$criteria->compare('value',$this->value,true);

		return self::model()->findAll($criteria);
	}
        public function consultarVariablesSistemaUsuario($idUsuario)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('idUsuario',$idUsuario,true);

		return self::model()->findAll($criteria);
	}
        public function getDiasSemana()
	{
    	return array('*' => 'Todos','1' => 'Lunes', '2' => 'Martes', '3' => 'Miercoles','4' => 'Jueves', '5' => 'Viernes', '6' => 'Sabado', '0' => 'Domingo');
	}
         public function getMeses()
	{
    	return array('*' => 'Todos','0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo','3' => 'Abril', '4' => 'Mayo', '5' => 'Junio', '6' => 'Julio','7' => 'Agosto', '8' => 'Septiembre', '9' => 'Octubre','10' => 'Noviembre', '11' => 'Diciembre');
	}
        public function getMinutos()
	{
    	return array('*' => 'Todos','0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo','3' => 'Abril', '4' => 'Mayo', '5' => 'Junio', '6' => 'Julio','7' => 'Agosto', '8' => 'Septiembre', '9' => 'Octubre','10' => 'Noviembre', '11' => 'Diciembre');
	}
        public function getDias()
	{
    	return array('*' => 'Todos','0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo','3' => 'Abril', '4' => 'Mayo', '5' => 'Junio', '6' => 'Julio','7' => 'Agosto', '8' => 'Septiembre', '9' => 'Octubre','10' => 'Noviembre', '11' => 'Diciembre');
	}
        public function getHoras()
	{
    	return array('*' => 'Todos','0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo','3' => 'Abril', '4' => 'Mayo', '5' => 'Junio', '6' => 'Julio','7' => 'Agosto', '8' => 'Septiembre', '9' => 'Octubre','10' => 'Noviembre', '11' => 'Diciembre');
	}
	public function consultarImpresionesSistema()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('category','impresiones',false);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}