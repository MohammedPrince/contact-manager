@extends('include.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            @if (session('Success'))
                <div class="col-lg-4 text-center" style="padding: 20px;border-radius:10px;background-color:#50C878;">
                    <span class="text-center" style="font-size: 17px;color:#fff;">{{ session('Success') }}</b>
                </div>
            @endif
            @if (session('Erorr'))
                <div class="col-lg-4 text-center" style="padding: 20px;border-radius:10px;background-color:#FF7074;">
                    <span class="text-center" style="font-size: 17px;color:#fff;">{{ session('Erorr') }}</b>
                </div>
            @endif
            @if (session('Exist'))
                <div class="col-lg-4 text-center" style="padding: 20px;border-radius:10px;background-color:#f58747;">
                    <span class="text-center" style="font-size: 17px;color:#fff;">{{ session('Exist') }}</b>
                </div>
            @endif

        </div>

        <div class="row" style="justify-content: center;justify-items:center">
            <div class="col-lg-6">
                <form id="myForm" method="post" action="{{ route('AddContact') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Contact Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Contact Name"
                            name="name" required="required" oninput="validateContactName()" value="{{ old('name')}}">
                        @error('name')
                            <p class="error-message"> {{ $errors->first('name') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Enter Contact Phone" required="required" oninput="validatePhoneNumber(this)" value="{{ old('phone')}}">
                        @error('phone')
                            <p class="error-message"> {{ $errors->first('phone') }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-info" name="submit">Add Contact</button>
                </form>
            </div>
        </div>

        @if ($data['contact_data']->total() != 0)
            <hr>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <table id="example" class="table table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['contact_data'] as $key => $val)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ $val->phone }}</td>
                                    <td>{{ date('d-M-Y | h:i A', strtotime($val->created_at)) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('EditContact', base64_encode($val->id)) }}"
                                            class="btn btn-sm btn-info" title="Edit Contact"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" id=""
                                            title="Delete Contact" data-id="{{ base64_encode($val->id) }}"  onclick="confirmDelete(this)" ><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="row">
                        <div class="col-lg-12" style="text-align:right;">
                            {{ $data['contact_data']->links() }}
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </div>
@endsection
