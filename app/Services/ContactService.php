<?php

namespace App\Services;

use App\Repositories\ContactRepository;

/**
 * Class ContactService.
 */

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getContacts()
    {

        return $this->contactRepository->getContacts();
    }

    public function addContact($data)
    {

        return $this->contactRepository->addContact($data);
    }

    public function findContact($id)
    {
        return $this->contactRepository->findContact($id);
    }

    public function findContact_API($id)
    {
        return $this->contactRepository->findContact_API($id);
    }
    
    public function updateContact($id, $data)
    {

        return $this->contactRepository->updateContact($id, $data);
    }

    public function deleteContact($id)
    {
        return $this->contactRepository->deleteContact($id);
    }
}
