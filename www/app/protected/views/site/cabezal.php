 <div class='cabezal'>
      <table>
        <tr>
          <td style='width:450px'>
            <img src='images/logo2.bmp'/>
            <br>
           <small>
              <?= utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL'))?><br>
           Fecha Inicio Act. <b>01-06-2008</b> <br>
            Administración: <?=utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION'));?><br>
            Tel. <?=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO')?> email:<?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?>
           </small>
          </td>
          <td>
            
              <strong>FECHA</strong> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",Date("Y-m-d"))?><br>
             
              <strong>CUIT </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')?><br>
              <strong>IVA </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
              <strong>INGRESOS BRUTOS </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>

          </td>
        </tr>
      </table>
      <h1><?=isset($titulo)?$titulo:""?></h1>
      
      </div>