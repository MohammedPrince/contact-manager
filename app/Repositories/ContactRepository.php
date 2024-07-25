<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Contact;


class ContactRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Contact::class;
    }

    public function getContacts()
    {
        return Contact::where('del', 0)->orderBy('id', 'desc')->paginate(10);
    }

    public function addContact($data)
    {
        $contact = Contact::where('name', $data['name'])->where('phone', $data['phone'])->get();

        if (count($contact) == 0) {
            if (Contact::create($data)) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new contact, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Contact already exists!'];
        }
    }

    public function findContact($id)
    {
        $contact_data = Contact::where('del', 0)->find($id);

        if ($contact_data) {
            return $contact_data ;
        } else {
            return ['success' => false, 'message' => 'Contact Not found!'];
        }
    }

    public function findContact_API($id)
    {
        $contact_data = Contact::where('del', 0)->find($id);

        if ($contact_data) {
            return ['success' => true, 'contact_data' => $contact_data];
        } else {
            return ['success' => false, 'message' => 'Contact Not found!'];
        }
    }

    public function updateContact($id, $data)
    {
        $existingContact = Contact::where('phone', $data['phone'])->where('id', '!=', $id)->first();

        if ($existingContact) {
            return ['exists' => true, 'message' => 'Phone number already exists for another contact'];
        }
            $contact = Contact::find($id);

            if (!$contact) {
                return ['success' => false, 'message' => 'Contact not found'];
            }

            $contact->name = $data['name'];
            $contact->phone = $data['phone'];

            if ($contact->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating contact, try again!'];
            }
    }

    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return ['success' => false, 'message' => 'Record not found'];
        }

        $contact->del = 1;

        if ($contact->save()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'message' => 'Failed to delete record'];
        }
    }
}
