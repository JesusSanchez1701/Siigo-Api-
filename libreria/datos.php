<?php

    if (isset($_POST['datoss'])) {

        $id_orden=$_POST['id_orden'];
        $id_producto=$_POST['id_producto'];
        $nombre_producto=$_POST['nombre_producto'];
        $total=$_POST['valor'];
        $moneda=$_POST['moneda'];
        $nombres=$_POST['nombres'];
        $apellidos=$_POST['apellidos'];
        $empresa=$_POST['empresa'];
        $direccion=$_POST['direccion'];
        $ciudad=$_POST['ciudad'];
        $postal=$_POST['postal'];
        $email=$_POST['email'];
        $telefono=$_POST['telefono'];
        $fecha=$_POST['fecha'];
    }

    $num1=0;
    $num2=0;
    $num3=0;
    $num4=261;
    $num5=261;

    $resultado = $total - $num1 - $num2 + $num3 - $num4 + $num5;


    /*arreglo de datos para factura*/
    $par=[

        "Header"=> [
            "Id"=> 0,
            "DocCode"=> 45558,
            "Number"=> 0,
            "EmailToSend"=> null,
            "DocDate"=> $fecha,
            "MoneyCode"=> $moneda,
            "ExchangeValue"=> 0,
            "DiscountValue"=> 0,
            "VATTotalValue"=> 261,
            "ConsumptionTaxTotalValue"=> 0,
            "TaxDiscTotalValue"=> 261,
            "RetVATTotalID"=> -1,
            "RetVATTotalPercentage"=> -1,
            "RetVATTotalValue"=> 0,
            "RetICATotalID"=> -1,
            "RetICATotalValue"=> 0,
            "RetICATotaPercentage"=> -1,
            "TotalValue"=> $resultado,
            "TotalBase"=> $total,
            "SalesmanIdentification"=> "963852741",
            "Observations"=> "lgsussan",
            "Account"=> [
                "IsSocialReason"=> true,
                "FullName"=> "Malibu",
                "FirstName"=> "",
                "LastName"=> "",
                "IdTypeCode"=> "31",
                "Identification"=> "28412116",
                "CheckDigit"=> null,
                "BranchOffice"=> 0,
                "IsVATCompanyType"=> false,
                "City"=> [
                    "CountryCode"=> "Co",
                    "StateCode"=> "11",
                    "CityCode"=> $postal
                ],
                "Address"=> $direccion,
                "Phone"=> [
                    "Indicative"=> 0,
                    "Number"=> 9466474,
                    "Extention"=> 0
                ]
            ],
            "Contact"=> [
                "Code"=> 1,
                "Phone1"=> [
                    "Indicative"=> 1,
                    "Number"=> 6337150,
                    "Extention"=> 0
                ],
                "Mobile"=> [
                    "Indicative"=> 0,
                    "Number"=> 0,
                    "Extention"=> 0
                ],
                "EMail"=> $email,
                "FirstName"=> $nombres,
                "LastName"=> $apellidos,
                "IsPrincipal"=> true,
                "Gender"=> 1,
                "BirthDate"=> ""
            ],
            "CostCenterCode"=> "",
            "SubCostCenterCode"=> ""
        ],//wi
        "Items"=> [
            [
                "ProductCode"=> $id_producto,
                "Description"=> $nombre_producto,
                "GrossValue"=> $total,
                "BaseValue"=> $total,
                "Quantity"=> 1,
                "UnitValue"=> $total,
                "DiscountValue"=> 0,
                "DiscountPercentage"=> 0,
                "TaxAddName"=> "IVA 19%",
                "TaxAddId"=> 3440,
                "TaxAddValue"=> 261,
                "TaxAddPercentage"=> 19,
                "TaxDiscountName"=> "Retefuente 11%",
                "TaxDiscountId"=> 3446,
                "TaxDiscountValue"=> 261,
                "TaxDiscountPercentage"=> 11,
                "TotalValue"=> $resultado,
                "ProductSubType"=> 0,
                "TaxAdd2Name"=> "",
                "TaxAdd2Id"=> -1,
                "TaxAdd2Value"=> 0,
                "TaxAdd2Percentage"=> 0,
                "WareHouseCode"=> null,
                "SalesmanIdentification"=> null
            ]
        ],
        "Payments"=> [
            [
                "PaymentMeansCode"=> 2036,
                "Value"=> $resultado,
                "DueDate"=> $fecha,
                "DueQuote"=> 1
            ]
        ]

    ];
    $json = json_encode($par);
    $bytes = file_put_contents("factura.json", $json);

//capturando datos de woo.php


?>