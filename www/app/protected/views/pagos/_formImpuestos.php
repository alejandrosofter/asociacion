<?$model=Impuestos::model()->findAll();
foreach($model as $item){?>
<strong><?=$item->nombreImpuesto;?><br></strong><input class='impuestos span1' data='<?=$item->id;?>' id='impuesto_<?=$item->id;?>' type='text' ></input><br>
<?}?>