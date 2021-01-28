<br>
<small>
<?
$dataProvider=new CActiveDataProvider('Comunicados');
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/comunicados/_view',
    'template'=>'{items}'
    ))
?>
</small>