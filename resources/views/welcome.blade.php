@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @error('status')
        <div class="alert alert-danger alert-dismissible fade show">{{ $message }}</div>
    @enderror
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">{{ __('Customer List') }} <button type="button" name="new"
                        class="btn btn-sm btn-primary text-white float-end" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"><i class="fa-solid fa-user-plus"></i> New Cucstomer</button>
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile No</th>
                                <th>Email Id</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile No</th>
                                <th>Email Id</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="addcustomer" action="/add" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  
                    <div class="mb-3">
                        <label for="name" class="form-label">Customer Name</label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @else is-valid @enderror" id="name"
                            placeholder="Enter Customer Name" required value="{{ old('name') }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile_no" class="form-label">Mobile No</label>
                        <input type="text" name="mobile_no"
                            class="form-control @error('mobile_no') is-invalid @else is-valid @enderror" id="mobile_no"
                            placeholder="Enter Customer Mobile Number with Country code" required
                            onkeyup="if (/[^\d\+\(\)\-]/g.test(this.value)) this.value = this.value.replace(/[^\d\+\(\)\-]/g,'')"
                            value="{{ old('mobile_no') }}">
                        @error('mobile_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @else is-valid @enderror" id="email"
                            placeholder="Enter Customer Email Id" required value="{{ old('email') }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Customer Address</label>
                        <textarea class="form-control @error('address') is-invalid @else is-valid @enderror"
                            name="address" id="address" rows="2"
                            required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Profile Image</label>
                        <input class="form-control @error('image') is-invalid @else is-valid @enderror" type="file"
                            name="image" id="image" required value="{{ old('image') }}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary" id="submitform" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- update Customer --}}
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        @if(session()->has('editdata'))
            @php
                $editdata = session()->get('editdata');
                //dd($editdata);
            @endphp
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Customer #{{ $editdata[0]->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" name="addcustomer" action="/update" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer Name</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @else is-valid @enderror" id="name"
                                placeholder="Enter Customer Name" required value="{{ $editdata[0]->name }}"/>
                            @error('name')
                            <div class=" alert alert-danger">{{ $message }} </div>
                            @enderror
                        </div>
    <div class="mb-3">
        <label for="mobile_no" class="form-label">Mobile No</label>
        <input type="text" name="mobile_no" class="form-control @error('mobile_no') is-invalid @else is-valid @enderror"
            id="mobile_no" placeholder="Enter Customer Mobile Number with Country code" onkeyup="if (/[^\d\+\(\)\-]/g.test(this.value)) this.value = this.value.replace(/[^\d\+\(\)\-]/g,'')" required value="{{ $editdata[0]->mobile_no }}" />
@error('mobile_no')
<div class=" alert alert-danger">{{ $message }} </div>
    @enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @else is-valid @enderror" id="email"
        placeholder="Enter Customer Email Id" required value="{{ $editdata[0]->email }}"/>
@error('email')
<div class=" alert alert-danger">{{ $message }} </div>
@enderror
</div>
<div class="mb-3">
    <label for="address" class="form-label">Customer Address</label>
    <textarea class="form-control @error('address') is-invalid @else is-valid @enderror" name="address" id="address"
        rows="2" required>{{ $editdata[0]->address }}</textarea>
    @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="image" class="form-label">Upload Profile Image</label>
    <input class="form-control @error('image') is-invalid @else is-valid @enderror" type="file" name="image" id="image"
         value="{{ $editdata[0]->image }}"/>
        <span>Uploaded Image : {{ $editdata[0]->image }} </span><br>
        <img src="storage/profile/{{ $editdata[0]->image }}" width="50px">
@error('image')
<div class="alert alert-danger">{{ $message }} </div>
@enderror
</div>
<input type="hidden" name="prev_image"  value="{{ $editdata[0]->image }}" />
<input type="hidden" name="id"  value="{{ $editdata[0]->id }}" />
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" name="submit" class="btn btn-primary" id="submitform" >Update </button>
</div>
</form>
</div>
@endif
</div>
</div>
@push('scripts')
    <style src="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></style>
    <style src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"></style>
    <style>
        .toolbar {
            float: left;
        }

        div.dataTables_filter input {
            width: 300px;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        //add customer
       
        $(document).ready(function() {
   $(".alert").delay(9000).slideUp( 300 ).fadeOut(300);
  });
        //update customer
        $(document).ready(function () {
            $("input[name='mobile_no']").keyup(function() {
    $(this).val($(this).val().replace(/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/, "($1) $2-$3-$4"));
});
        });
        //datatable process
        $(document).ready(function () {
            // $('#example').DataTable();
            $('#example').DataTable({
                // dom: '<"toolbar">frtip',
                processing: true,
                ajax: {
                    url: 'customer',
                    dataSrc: '',
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'mobile_no'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'image',
                        "render": function (data) {
                            return '<img src="storage/profile/' + data + '" width="40px">';
                        }
                    },
                    {
                        data: 'id',
                        "render": function (data) {
                            return '<a href="edit/' + data +
                                '" class="btn btn-primary btn-sm text-white" > <i class="fa-solid fa-pen-to-square"></i> Edit</a><a href="delete/' +
                                data +
                                '" class="btn btn-danger btn-sm text-white"/><i class="fa-solid fa-trash-can"></i> Delete</a> ';
                        }
                    },

                ],
            });
            // $('div.toolbar').html('<button type="button" name="new" class="btn btn-sm btn-info" onClick="alert(`Added..`)"> + New Cucstomer</button>');
        });

    </script>
    @if(session()->has('editdata'))
        <script>
            $(document).ready(function () {
                $('#staticBackdrop2').modal('show');
            });

        </script>
    @endif
@endpush
@endsection
