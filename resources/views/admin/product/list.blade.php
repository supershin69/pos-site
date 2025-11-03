@extends('admin.layouts.master')

@section('content')
    <div class="container">

        <table class="table align-middle shadow-sm table-hover">
            <thead class="text-white bg-primary">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ asset('uploads/' . $product->image) }}" class="rounded object-fit-cover"
                                style="width: 80px; height: 80px;" alt=""></td>
                        <td>{{ $product->name }}</td>
                        <td> {{ $product->created_at->format('d-F-Y (h:m:s)') }} </td>
                        <td>
                            <a href="{{ route('product#editPage', $product->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen-to-square"></i> </a>
                            <button type="button" onclick="deleteConfirm({{ $product->id }})"
                                class="btn btn-sm btn-outline-danger"> <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <span class=" d-flex justify-content-center">{{ $products->links() }}</span>

    </div>
@endsection

@if (Session::has('message'))
    @push('scripts')
        <script>
            Swal.fire({
                title: "{{ Session::get('message') }}",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
            console.log('hello');
        </script>
    @endpush
@endif

@if (Session::has('error'))
    @push('scripts')
        <script>
            Swal.fire({
                title: "{{ Session::get('error') }}",
                icon: "error",
                showConfirmButton: false,
                timer: 1500
            });
            console.log('error');
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
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                        timer: 1300,
                        timerProgressBar: true,
                    });
                    setInterval(() => {
                        location.href = "/admin/product/delete/" + id;
                    }, 1400);
                }
            });
        }
    </script>
@endpush('script-content')
