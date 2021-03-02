<?php 
require_once "CurlRequest.php";
require_once "datos.php";

function _log($msg) {
    echo   ": $msg\n";
}


$cReq = new CurlRequest();
class SiigoAPI
{
    private $urlToken;
    private $urlBase;
    private $apiUser;
    private $apiPassword;
    private $subscriptionKey;
    private $token = "";
    private $cReq = null;




    public function __construct()
    {
        $this->cReq = new CurlRequest();

        $config = parse_ini_file('siigoapi.conf', true);//parse_ini_file trae un fichero 
        $this->urlToken = $config['server']['url_token'];//trae solo  url token del fichero
        $this->urlBase = $config['server']['url_base'];//trae la url del servidor .net del fichero
        $this->apiUser = $config['user']['username'];//trae el nombre del usuario del fichero
        $this->subscriptionKey = $config['server']['subscription_key'];//trae la key del fichero
        $this->apiPassword = $config['user']['password'];//trae el password del fichero 
        
    }

    /**
     * Establece el token de acceso y obtiene información de autenticación
     * 
     * @return array Respuesta del servidor a la solicitud de autenticación
     */
    public function getAuth()
    {   
        //configuracion del postman parametros
        //_log("Obteniendo autorización");
        $postFields = [
            "grant_type" => "password",
            "username" => $this->apiUser,//trae el nombre de usuario 
            "password" => $this->apiPassword,//trae el password
            "scope" => "WebApi offline_access",
        ];

        //configuraciones como postman del headres
        $cOptions = [
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: Basic U2lpZ29XZWI6QUJBMDhCNkEtQjU2Qy00MEE1LTkwQ0YtN0MxRTU0ODkxQjYx",
                "Content-Type: application/x-www-form-urlencoded"
            ],
        ];


        list($httpCode, $resp) = $this->cReq->curlPost(
            $this->urlToken, $postFields, $cOptions
        );


        

        if ($httpCode !== 200) {
            _log($resp);
            throw new Exception("Información de autenticación no válida");
        }

        $decodedResp = json_decode($resp, true);//crea nueva variable y pasa el $resp json_decode
        $this->token = $decodedResp['access_token'];//trae el token de autorizacion 


        

        return $resp;
        
    }

    /**
     * Guarda una factura
     * 
     * @param string $invoiceData Cadena en formato json con la información de
     * la factura.
     * 
     * @return string Respuesta enviada por el servidor
     */
    //funcion para enviar factura
    public function saveInvoice($invoiceData) {
        //_log("Enviando factura");//mensaje
        $url = "{$this->urlBase}/Invoice/Save?namespace=1";
        $i = 0;
        do {
            $cOptions = [
                CURLOPT_HTTPHEADER => [
                    "Authorization: Bearer {$this->token}",//llama el tokent
                    "Content-Type: application/json",
                    "Ocp-Apim-Subscription-Key: {$this->subscriptionKey}",//llama la key
                ],
                CURLOPT_POSTFIELDS => $invoiceData,
            ];
            list($httpCode, $resp)
            = $this->cReq->curlPost($url, [], $cOptions);
            if ($httpCode === 401) {
                $this->getAuth();
            }elseif($httpCode !== 200){
                _log("<script >alert('el producto no exsiste');
                    window.location='../libreria/consultar_compra.php';
                    </script> [$httpCode]");
                die();
            }
            $i += 1;
        } while ($i < 2 && $httpCode === 401);
        //_log("Envío de factura finalizado [$httpCode]");

        return $resp;
    }
}

$token = '';
$api = new SiigoAPI();

$invoiceData = file_get_contents("factura.json");
$fac = json_decode($api->saveInvoice($invoiceData));
$result[] = '';
foreach ($fac as $key => $value) {
    $result[$key] = $value;

}

$tas = $result['Header'];

include '../ini/header.php';
?>
<!--sacar datos de un array json-->
<div class="over" id="">
    <div class="pop" id="">
        <h3>La factura se envió correctamente </h3>
        <div class="container">
            <div id="container">
                <h4> Id Factura:<span id="productId"><?php echo($tas->Number);?></span></h4>
                <a href="consultar_compra.php" class="btn btn-danger">Volver</a>
                <button class=" btn btn-primary" onclick="copyToClipboard('#productId')">Copiar Id  de Factura</button>
            </div>
        </div>
    </div>
</div>