<?php

namespace App\UseCases\store_address;

use App\Common\UseCaseInterface;
use App\UseCases\store_address\StoreAddressUseCaseInputDTO;
use App\Domain\address\entity\AddressEntity;
use App\Domain\address\value_object\ZipCodeValueObject;
use App\Domain\address\value_object\state\BrazilianStateValueObject;
use App\Domain\address\repository\AddressRepositoryInterface;
use App\Infrastructure\routes\http\AbstractRequest;

class StoreAddressUseCase implements UseCaseInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function execute(AbstractRequest $request): void
    {
        $body = $request->body;

        if(empty($body)) {
            throw new BodyParsingException();
        }

        $zipCodeInstance = new ZipCodeValueObject($this->sanitizeInput($body['zipCode']));
        $stateUFInstance = new BrazilianStateValueObject($this->sanitizeInput($body['stateUF']));

        $addressEntity = new AddressEntity(
            zipCode: $zipCodeInstance,
            stateUF: $stateUFInstance,
            street: $this->sanitizeInput($body['street']),
            city: $this->sanitizeInput($body['city']),
            complement: $this->sanitizeInput($body['complement']),
            district: $this->sanitizeInput($body['district'])
        );

        $this->addressRepository->save($addressEntity);
    }

    private function sanitizeInput($value): string
    {
        return filter_var(trim(strip_tags($value ?? "")));
    }
}
