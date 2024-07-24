<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;



class ContactController extends Controller
{

    public function index()
    {
        $data['contact_data'] = Contact::where('del', 0)->orderBy('id', 'desc')->paginate(10);
        return view('index', ['data' => $data]);
    }

    public function AddContact(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:100|min:4|unique:contacts',
            'phone' => 'required|regex:/^\d+$/|max:13|min:10|unique:contacts',
        ], [
            'name.required' => 'Please Enter Contact Name',
            'phone.required' => 'Please Enter Phone Number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $contact = Contact::where('name', $data['name'])->where('phone', $data['phone'])->get();

        if(count($contact) == 0) {

            if (Contact::create($data)) {
                session()->flash('Success', 'Contact added successfully !');
            } else {
                session()->flash('Erorr', 'Error occured while adding new contact, try again !');
            }
        } else {
            session()->flash('Exist', 'Contact already exist !');
        }
        return redirect()->route('home');
    }

    public function EditContact($id)
    {
        $id = base64_decode($id);

        $data['contact_edit_data'] = Contact::find($id);

        return view('edit', ['data' => $data]);
    }

    public function UpdateContact($id, Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:100|min:4|',
            'phone' => 'required|regex:/^\d+$/|max:13|min:10|',
        ], [
            'name.required' => 'Please Enter Contact Name',
            'phone.required' => 'Please Enter Phone Number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $contact = Contact::find(base64_decode($id));
        $contact->name = $data['name'];
        $contact->phone = $data['phone'];

        if ($contact->save()) {
            session()->flash('Success', 'Contact updated successfully !');
        } else {
            session()->flash('Erorr', 'Error occured while updated contact, try again !');
        }

        return redirect()->route('home');
    }

    public function deleteRecord($id)
    {

        $record_id = base64_decode($id);

        $contact = Contact::find($record_id);

        if (!$contact) {
            session()->flash('Error', 'Record not found');
        }

        $contact->del = 1;

        if ($contact->save()) {
            session()->flash('Success', 'Record deleted successfully');
        } else {
            session()->flash('Erorr', 'Failed to delete Record');
        }

        return redirect()->route('home');
    }
}
