<?php

namespace App\Infrastructure\controllers;

use App\Infrastructure\routes\http\AbstractRequest;
use App\UseCases\list_addresses\ListAddressesUseCase;
use App\UseCases\store_address\StoreAddressUseCase;
use App\Infrastructure\routes\error_handling\errors\InvalidParamtersException;
use App\Infrastructure\models\repository\AddressRepository;

class AddressController
{
    public static function getConfig()
    {
        return [
            'DB_HOST' => $_SERVER['DB_HOST'],
            'DB_NAME' => $_SERVER['DB_NAME'],
            'DB_USER' => $_SERVER['DB_USER'],
            'DB_PASS' => $_SERVER['DB_PASS'],
            'DB_PORT' => $_SERVER['DB_PORT']
        ];
    }

    public static function index(AbstractRequest $request)
    {
        $config = self::getConfig();
        $addressRepository = new AddressRepository($config);
        $listAddressesUseCase = new ListAddressesUseCase($addressRepository);
        $addresses = $listAddressesUseCase->execute($request)->addresses;
        $queryState = self::handleQueryStage(request: $request, addresses: $addresses);
        $supportedFormats = ['json']; // TODO: Adicionar lógica para recuperar através da env

        include __DIR__ . "/../views/index.php";
    }

    public static function save(AbstractRequest $request)
    {
        $config = self::getConfig();
        $addressRepository = new AddressRepository($config);
        $storeAddressUseCase = new StoreAddressUseCase($addressRepository);
        $storeAddressUseCase->execute($request);

        http_response_code(201);
    }

    private static function handleQueryStage($request, array $addresses = [])
    {
        if(empty($addresses)) {
            return [];
        }

        $addressHeadFields = array_keys($addresses[0]);
        // TODO: Adicionar possíbilidade para multiplos filtros.
        $sortStage = $request->queryParams["sort"][0] ?? [];
        $url = "http://".$request->host;
        $queryState = [];
        foreach ($addressHeadFields as $value) {
            $hasSortParams = (bool) array_search($value, $sortStage);
            if ($hasSortParams) {
                $nextDirection = $sortStage["direction"] === "asc" ? "desc" : null;

                $queryState[$value] = [
                    "link" => (bool) $nextDirection ? $url."/?sort[0][fieldName]=".$value."&sort[0][direction]=".$nextDirection . "&sort[0][priority]=1" : $url,
                    "params" => $sortStage
                ];
                continue;
            }

            $queryState[$value] = [
                "link" => $url."/?sort[0][fieldName]=".$value."&sort[0][direction]=asc" . "&sort[0][priority]=1",
                "params" => []
            ];
        }

        return $queryState;
    }
}
