<?php

class InformesController extends Controller
{
	  public function actions()
    {
        return array(
            'ws'=>array('class'=>'CWebServiceAction',),
        );
    }
	public function actionDetalleObrasSociales()
	{
		$mesInicio= isset($_GET['mesInicio'])? $_GET['mesInicio'] : Date('m');
		$anoInicio =isset($_GET['anoInicio']) ? $_GET['anoInicio'] : Date('Y') ;

		$mesFin= isset($_GET['mesFin'])? $_GET['mesFin'] : Date('m');
		$anoFin =isset($_GET['anoFin']) ? $_GET['anoFin'] : Date('Y') ;

		$idObraSocial =isset($_GET['idObraSocial']) ? $_GET['idObraSocial'] : null ;

		$cabezal = Plantillas::model()->findByPk(4);

		$listaObras = PracticasProfesionales::model()->detalleObraSocial($idObraSocial,$mesInicio,$anoInicio,$mesFin,$anoFin);
		$param['cabezal'] = $cabezal->texto;
		$param['desde'] = PracticasProfesionales::model()->getMesLetras($mesInicio).' '.$anoInicio;
		$param['hasta'] = PracticasProfesionales::model()->getMesLetras($mesFin).' '.$anoFin;
		$plantillas = Plantillas::model()->getPlantilla('PRAC_POR_OS', $param);
		$plantillas = Plantillas::model()->imprimoGrilla($plantillas, 'obraSocial', $listaObras);

		$this->render('detalleObrasSociales',array('plantillas'=>$plantillas,'mesInicio'=>$mesInicio,'anoInicio'=>$anoInicio,'mesFin'=>$mesFin,'anoFin'=>$anoFin));
	}
	public function actionDetalleProfesional()
	{
		$mesInicio= isset($_GET['mesInicio'])? $_GET['mesInicio'] : Date('m');
		$mesFin= isset($_GET['mesFin'])? $_GET['mesFin'] : Date('m');

		$anoInicio =isset($_GET['anoInicio']) ? $_GET['anoInicio'] : Date('Y') ;
		$anoFin =isset($_GET['anoFin']) ? $_GET['anoFin'] : Date('Y') ;

		$idProfesional =isset($_GET['idProfesional']) ? $_GET['idProfesional'] : null ;
		$idObraSocial =isset($_GET['idObraSocial']) ? $_GET['idObraSocial'] : null ;
		$cabezal = Plantillas::model()->findByPk(4);

		$listaProfesionales = PracticasProfesionales::model()->detalleProfesional($idProfesional,$idObraSocial,$mesInicio,$mesFin,$anoInicio,$anoFin);
		$param['cabezal'] = $cabezal->texto;
		$param['desde'] = PracticasProfesionales::model()->getMesLetras($mesInicio).' '.$anoFin;
		$param['hasta'] = PracticasProfesionales::model()->getMesLetras($mesFin).' '.$anoFin;
		$plantillas = Plantillas::model()->getPlantilla('PRAC_PROFESIONAL', $param);
		$plantillas = Plantillas::model()->imprimoGrilla($plantillas, 'profesionales', $listaProfesionales);
		$this->render('detalleProfesional',array('plantillas'=>$plantillas,'mesInicio'=>$mesInicio,'anoInicio'=>$anoInicio,'mesFin'=>$mesFin,'anoFin'=>$anoFin));
	}
	/**
	 * @param int $id 
	 * @param int $ano 
     * @return string
     * @soap
     */
	public function getInformeProfesional($id,$ano)
	{
		return $this->estado($id,$ano);
	}

	public function actionEstadoGeneral()
	{
		$anualFacturacion=null;
		$anualCobros=null;
		$anualPagos=null;
		$impuestos=null;
		if(isset($_POST['ano'])){
			$ano=$_POST['ano'];
			$anualFacturacion=FacturasObrasSocial::model()->anual($ano);
			$anualPagos=Pagos::model()->anual(null,$ano);
			$anualCobros=Cobros::model()->anual($ano);
			$impuestos=PagosImpuestos::model()->getImpuestos(null,$ano);
		}
		
		$this->render('estadoGeneral',array('impuestos'=>$impuestos,'anualPagos'=>$anualPagos,'anualCobros'=>$anualCobros,'anualFacturacion'=>$anualFacturacion));
	}
	public function actionEstadoProfesional()
	{
		$info= $this->estado(isset($_POST['idProfesional'])?$_POST['idProfesional']:null,isset($_POST['ano'])?$_POST['ano']:null,true);
		$this->render('estado',array('info'=>$info));
	}
	public function actionEstado($idProfesional,$ano)
	{
		$info=$this->estado(isset($_POST['idProfesional'])?$_POST['idProfesional']:null,isset($_POST['ano'])?$_POST['ano']:null);
		$this->render('estado',array('info'=>$info));
	}

	
	/**
	 * @param int $id 
	 * @param int $ano 
     * @return string
     * @soap
     */
	public function ultimosPagos($id,$ano)
	{
		$ultimosPagos= Pagos::model()->getUltimos($id,$ano,10);
		return $this->renderPartial('_ultimosPagos',array('model'=>$ultimosPagos),true);
	}
	/**
	 * @param int $id 
	 * @param int $ano 
     * @return string
     * @soap
     */
	public function getPorcentajesFacturas($id,$ano)
	{
		$porcentajesObraSocial= FacturasProfesional::model()->porcentajes($id,$ano);
		return $this->renderPartial('_graficaFacturacion',array('model'=>$porcentajesObraSocial),true);
	}
	/**
	 * @param int $id 
	 * @param int $ano 
     * @return string
     * @soap
     */
	public function getPendientes($id,$ano)
	{
		$pendientes= FacturasProfesional::model()->getPendientes($id,$ano);
		return $this->renderPartial('_pendientesFacturacion',array('model'=>$pendientes),true);
	}
	/**
	 * @param int $id 
	 * @param int $ano 
     * @return string
     * @soap
     */
	public function anualPagos($id,$ano)
	{
		$anualPagos= Pagos::model()->anual($id,$ano);
		$anual= FacturasProfesional::model()->anual($id,$ano);
		return $this->renderPartial('_anualProfesional',array('model'=>$anual,'anualPagos'=>$anualPagos));
	}
	/**
	 * @param int $id 
	 * @param int $ano 
     * @return string
     * @soap
     */
	public function getImpuestos($id,$ano)
	{
		$impuestos= PagosImpuestos::model()->getImpuestos($id,$ano);
		return $this->renderPartial('_impuestos',array('model'=>$impuestos),true);
	}
	public function actionDetalleFacturadoMes()
	{
		$this->layout='//layouts/layoutSolo';
		$mydate=$_GET['fecha'];
		$mes = date("m",strtotime($mydate));
		$ano = date("Y",strtotime($mydate));
		$data=FacturasProfesional::model()->getFacturadoMes($_GET['idProfesional'],$ano,$mes,false);
		$this->render('_detalleFacturadoMes',array('data'=>$data,'mes'=>$mes,'ano'=>$ano));
	}
	public function estado($idProfesional,$ano,$muestraBuscador=false)
	{

		$pendientes=null;
		$ultimosPagos=null;
		$porcentajesObraSocial=null;
		$profesional=null;
		$anual=null;
		$anualPagos=null;
		$impuestos=null;
		$pendienteCobro=null;
		if(isset($idProfesional) && $idProfesional!=null){
			$id=$idProfesional;
			$ano=$ano;
			$pendientes=FacturasProfesional::model()->getFacturadoMes($id,$ano);
			$ultimosPagos=Pagos::model()->getUltimos($id,$ano,10);
			$porcentajesObraSocial=FacturasProfesional::model()->porcentajes($id,$ano);
			$profesional=Profesionales::model()->findByPk($id);
			$anual=FacturasProfesional::model()->anual($id,$ano);
			$anualPagos=Pagos::model()->anual($id,$ano);
			$impuestos=PagosImpuestos::model()->getImpuestos($id,$ano);
			$pendienteCobro=CobrosItems::model()->getPendientes($id);
		}
		
		return $this->renderPartial('estadoProfesional',array('muestraBuscador'=>$muestraBuscador,'pendienteCobro'=>$pendienteCobro,'idProfesional'=>$idProfesional,'ano'=>$ano,'impuestos'=>$impuestos,'anualPagos'=>$anualPagos,'anual'=>$anual,'profesional'=>$profesional,'pendientes'=>$pendientes,'ultimosPagos'=>$ultimosPagos,'porcentajesObraSocial'=>$porcentajesObraSocial),true);

	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPracticas()
	{
		$fechaInicio= isset($_GET['fechaInicio'])? $_GET['fechaInicio'] : null;
		$fechaFin =isset($_GET['fechaFin']) ? $_GET['fechaFin'] : null ;

		$cabezal = Plantillas::model()->findByPk(4);

		$listaPracticas = PracticasProfesionales::model()->detallePracticas($fechaInicio,$fechaFin);
		$param['cabezal'] = $cabezal->texto;
		$param['fechaInicio'] = $fechaInicio;
		$param['fechaFin'] = $fechaFin;
		$plantillas = Plantillas::model()->getPlantilla('INFO_PRAC', $param);
		$plantillas = Plantillas::model()->imprimoGrilla($plantillas, 'practica', $listaPracticas);
		$this->render('practicas',array('plantillas'=>$plantillas));
	}
}