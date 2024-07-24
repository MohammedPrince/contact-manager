@extends('include.master')

@section('content')

<div class="container mt-5">


    <div class="row justify-content-center">
        @if(session('Success'))
        <div class="col-lg-4 text-center" style="padding: 20px;border-radius:10px;background-color:#50C878;">
            <span class="text-center" style="font-size: 17px;color:#fff;">{{ session('Success') }}</b>
        </div>
        @endif
        @if(session('Erorr'))
        <div class="col-lg-4 text-center" style="padding: 20px;border-radius:10px;background-color:#FF7074;">
            <span class="text-center" style="font-size: 17px;color:#fff;">{{ session('Erorr') }}</b>
        </div>
        @endif
      
    </div>

    <div class="row" style="justify-content: center;justify-items:center">
        <div class="col-lg-6">
            <form id="myForm" method="post" action="{{ route('UpdateContact',base64_encode($data['contact_edit_data']->id)) }}">
                @csrf
                <input type="hidden" class="form-control" name="contact_id" value="{{ $data['contact_edit_data']->id }}">

                <div class="form-group">
                    <label for="name">Contact Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Contact Name" name="name" required="required" value="{{ $data['contact_edit_data']->name }}" oninput="validateContactName()">
                    @error('name')
                    <p class="error-message">{{ $errors->first('name') }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Contact Phone" required="required" oninput="validatePhoneNumber(this)" value="{{ $data['contact_edit_data']->phone }}">
                    @error('phone')
                    <p class="error-message"> {{ $errors->first('phone') }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-info" name="submit">Edit Contact</button>
            </form>
        </div>
    </div>
</div>

@endsection