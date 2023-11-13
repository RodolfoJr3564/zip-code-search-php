<?php

namespace App\UseCases\list_addresses;

use App\Common\UseCaseInterface;
use App\UseCases\list_addresses\SortableField;
use App\Domain\address\repository\AddressRepositoryInterface;
use App\UseCases\list_addresses\ListAddressesUseCaseInputDTO;
use App\UseCases\list_addresses\ListAddressesUseCaseOutputDTO;
use App\Domain\address\entity\AddressEntity;
use App\Infrastructure\routes\http\AbstractRequest;
use App\Domain\address\value_object\ZipCodeValueObject;
use App\Domain\address\value_object\state\BrazilianStateValueObject;

class ListAddressesUseCase implements UseCaseInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function execute(AbstractRequest $request): ListAddressesUseCaseOutputDTO
    {
        $queryParams = $request->queryParams["sort"] ?? [];
        $orderClauses = array_map(fn ($orderClause) => new SortableField(...$orderClause), $queryParams);

        $addresses = $this->addressRepository->list($orderClauses);
        $addressEntities =  array_map(function ($address) {
            $zipCode = new ZipCodeValueObject($address["zip"]);
            $stateUF = new BrazilianStateValueObject($address["uf"]);
            return new AddressEntity(
                zipCode: $zipCode,
                stateUF: $stateUF,
                street: $address["street"],
                city: $address["city"],
                complement: $address["complement"],
                district: $address["district"]
            );
        }, $addresses);
        return new ListAddressesUseCaseOutputDTO($addresses);
    }
}
