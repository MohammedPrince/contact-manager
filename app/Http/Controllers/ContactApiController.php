<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use App\Http\Requests\ContactFormRequest;


class ContactApiController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function GetConacts_API()
    {
        $data['contact_data'] = $this->contactService->getContacts();

        return response()->json($data);
    }

    public function AddContact_API(ContactFormRequest $request)
    {
        $data = $request->validated();
        $data = $request->all();

        $result = $this->contactService->addContact($data);

        if ($result['success']) {
            return response()->json(['message' => 'Contact added successfully'], 201);
        } else {
            return response()->json(['error' => $result['message']], 422);
        }
    }

    public function GetContactById_API($id)
    {
        $result = $this->contactService->findContact_API($id);

        if ($result['success']) {
            return response()->json($result);
        }else{
            return response()->json(['error' => $result['message']], 404);
        } 
    }

    public function UpdateContact_API($id, ContactFormRequest $request)
    {

        $data = $request->all();
        $data = $request->validated();

            $result = $this->contactService->updateContact($id, $data);
            
            if ($result['success']) {
                return response()->json(['message' => 'Contact updated successfully!'], 201);
            } else {
                return response()->json(['error' => $result['message']], 422);
            }
    }

    public function DeleteRecord_API($id)
    {
        $result = $this->contactService->deleteContact($id);
        
        if ($result['success']) {
            return response()->json(['message' => 'Record deleted successfully!'], 201);
        } else {
            return response()->json(['error' => $result['message']], 422);
        }
    }
}
