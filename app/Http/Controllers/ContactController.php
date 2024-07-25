<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
{

    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $data['contact_data'] = $this->contactService->getContacts();

        return view('index', ['data' => $data]);
    }

    public function AddContact(ContactFormRequest $request)
    {

        $data = $request->all();
        $data = $request->validated();

        $result = $this->contactService->addContact($data);

        if ($result['success']) {
            session()->flash('Success', 'Contact added successfully!');
        } else {
            session()->flash('Error', $result['message']);
        }

        return redirect()->route('home');
    }

    public function EditContact($id)
    {
        $id = base64_decode($id);

        $data['contact_edit_data'] = $this->contactService->findContact($id);
        

        return view('edit', ['data' => $data]);
    }

    public function UpdateContact($id, ContactFormRequest $request)
    {

        $data = $request->all();
        $data = $request->validated();

        $result = $this->contactService->updateContact(base64_decode($id), $data);

        if ($result['success'] ?? false) {
            session()->flash('Success', 'Contact updated successfully!');
        } elseif ($result['exists'] ?? false) {
            session()->flash('Exist', 'Phone number already exists for another contact!');
        } else {
            session()->flash('Error', $result['message'] ?? 'An error occurred while updating the contact.');
        }

        return redirect()->route('home')->withInput($request->all());
    }

    public function deleteRecord($id)
    {

        $record_id = base64_decode($id);

        $result = $this->contactService->deleteContact($record_id);

        if ($result['success']) {
            session()->flash('Success', 'Record deleted successfully');
        } else {
            session()->flash('Error', $result['message']);
        }

        return redirect()->route('home');
    }
}
