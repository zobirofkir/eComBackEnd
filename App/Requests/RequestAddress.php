<?php
namespace Request;

use InvalidArgumentException;
use Model\Address;

class RequestAddress
{
    private $addressModel;

    public function __construct()
    {
        $this->addressModel = new Address();
    }

    public function storeAddress(array $data)
    {
        $this->validate($data);
        $sanitizedData = $this->sanitize($data);

        return $this->addressModel->storeAddress(
            $sanitizedData['address_line1'],
            $sanitizedData['address_line2'],
            $sanitizedData['city'],
            $sanitizedData['state'],
            $sanitizedData['postal_code'],
            $sanitizedData['country']
        );
    }


    public function updateAddress(array $data)
    {
        $this->validate($data);
        $sanitizedData = $this->sanitize($data);

        return $this->addressModel->put(
            $sanitizedData['id'],
            $sanitizedData['address_line1'],
            $sanitizedData['address_line2'],
            $sanitizedData['city'],
            $sanitizedData['state'],
            $sanitizedData['postal_code'],
            $sanitizedData['country']
        );
    }

    protected function validate(array $data): void
    {
        $requiredFields = ["address_line1", "address_line2", "city", "state", "postal_code", "country"];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new InvalidArgumentException("$field is required.");
            }
        }
    }

    protected function sanitize(array $data): array
    {
        return array_map('htmlspecialchars', $data);
    }
}
