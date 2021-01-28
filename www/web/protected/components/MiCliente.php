<?php
class MiCliente extends CApplicationComponent
{
        private $client = null;
        public $ws_url;
        private function clienteInterno() 
        {
                if($this->client == null)
                {
                        // para que reconozca nuevas funciones del WS 
                        ini_set (  'soap.wsdl_cache_enable'  ,  0  );
                        ini_set (  'soap.wsdl_cache_ttl'  ,  0  );
                        $this->client = new SoapClient($this->ws_url);
                }
                return $this->client;
        }
        public function getInformeProfesional($id,$ano)
        {
                return $this->clienteInterno()->getInformeProfesional($id,$ano);
        }
        public function ultimosPagos($id,$ano)
        {
                return $this->clienteInterno()->ultimosPagos($id,$ano);
        }
        public function getPorcentajesFacturas($id,$ano)
        {
                return $this->clienteInterno()->getPorcentajesFacturas($id,$ano);
        }
        public function getPendientes($id,$ano)
        {
                return $this->clienteInterno()->getPendientes($id,$ano);
        }
         public function anualFacturasProfesional($id,$ano)
        {
                return $this->clienteInterno()->getPendientes($id,$ano);
        }
        public function anualPagos($id,$ano)
        {
                return $this->clienteInterno()->anualPagos($id,$ano);
        }
        public function getImpuestos($id,$ano)
        {
                return $this->clienteInterno()->getImpuestos($id,$ano);
        }

}
?>