<?php
namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactRepository;

class ContactServices {
    protected $contactRepository;

    public function __construct()
    {
        $this->contactRepository = new ContactRepository(new Contact());
    }

    public function verstuurContactFormulier(array $data)
    {
        return $this->contactRepository->create($data);
    }
}
