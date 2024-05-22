<?php
namespace Request;

use InvalidArgumentException;
use Model\Categorie;

class RequestCategorie
{
    private $categorie;

    public function __construct()
    {
        $this->categorie = new Categorie();
    }

    public function storeCategorie($data)
    {
        $this->validate($data);

        $sanitizeData = $this->sanitize($data);

        return $this->categorie->create(
            $sanitizeData["name"]
        );
    }

    public function updateCategorie(array $data)
    {
        $this->validate($data);

        $sanitizeData = $this->sanitize($data);

        return $this->categorie->put(
            $sanitizeData["id"],
            $sanitizeData["name"]
        );
    }


    protected function validate(array $data) : void
    {
        $requestValidated = ["name"];
        foreach($requestValidated as $request)
        {
            if (empty($data[$request]))
            {
                throw new InvalidArgumentException("$request is required");
            }
        }
    }

    protected function sanitize(array $data): array
    {
        return array_map('htmlspecialchars' , $data);
    }
}