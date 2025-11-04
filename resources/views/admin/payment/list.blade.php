@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4 d-sm-flex align-items-center justify-content-between">
            <h1 class="mb-0 text-gray-800 h3">Payment Account List</h1>

            <form action="{{ route('payment#list') }}" method="get">

                <div class="input-group">
                    <input type="text" name="searchKey" value="{{ request('searchKey') }}" class="form-control"
                        placeholder="Search...">
                    <button class="text-white btn bg-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>


        </div>


        <div class="">
            <div class="row">
                <div class="mt-3 col-4">
                    <div class="card">
                        <div class="shadow card-body">
                            <form action="{{ route('payment#create') }}" method="post" class="p-3 rounded ">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="accNumber" value="{{ old('accNumber') }}"
                                        class=" form-control @error('accNumber') is-invalid @enderror"
                                        placeholder="Account Number...">
                                    @error('accNumber')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="accName" value="{{ old('accName') }}"
                                        class=" form-control @error('accName') is-invalid @enderror"
                                        placeholder="Account Name...">
                                    @error('accName')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="accType" value="{{ old('accType') }}"
                                        class=" form-control @error('accType') is-invalid @enderror"
                                        placeholder="Account Type...">
                                    @error('accType')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>


                                <input type="submit" value="Create" class="mt-3 btn btn-outline-primary">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-3 col">

                    <table class="table shadow-sm table-hover ">
                        <thead class="text-white bg-primary">
                            <tr>
                                <th>ID</th>
                                <th>Account Name</th>
                                <th>Account Type</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($paymentAccounts as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->account_name }}</td>
                                    <td>{{ $item->account_type }}</td>
                                    <td> {{ $item->created_at->format('d-F-Y (h:m:s)') }} </td>
                                    <td>
                                        <a href="{{ route('payment#edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-secondary"> <i
                                                class="fa-solid fa-pen-to-square"></i> </a>
                                        <button type="button" onclick="deleteConfirm({{ $item->id }})"
                                            class="btn btn-sm btn-outline-danger"> <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach






                        </tbody>
                    </table>

                    <span class=" d-flex justify-content-center">{{ $paymentAccounts->links() }}</span>

                </div>
            </div>
        </div>

    </div>
@endsection

@if (Session::has('message'))
    @push('scripts')
        <script>
            Swal.fire({
                title: "{{ Session::get('message') }}",
                icon: "success",
                showConfirmButton: false,
                timer: 1300
            });
            console.log('hello');
        </script>
    @endpush
@endif

@push('scripts')
    <script>
        function deleteConfirm(id) {
            console.log(id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    location.href = "/admin/payment/delete/" + id;

                }
            });
        }
    </script>
@endpush
