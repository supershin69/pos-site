@extends('admin.layouts.master')

@section('content')

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
                        <h1 class="mb-0 text-gray-800 h3">Category List</h1>
                        
                        <form action="{{ route('CategoryList') }}" method="get">
            
                            <div class="input-group">
                                <input type="text" name="searchKey" value="{{ request('searchKey') }}" class="form-control" placeholder="Search..." >
                                <button class="text-white btn bg-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                        
                        
                    </div>
                    

                    <div class="">
                        <div class="row">
                            <div class="mt-3 col-4">
                                <div class="card">
                                    <div class="shadow card-body">
                                        <form action="{{ route('category#create') }}" method="post" class="p-3 rounded ">
                                          @csrf

                                            <input type="text" name="categoryName" value="{{ old('categoryName') }}" class=" form-control @error('categoryName') is-invalid @enderror"
                                                placeholder="Category Name...">
                                            @error('categoryName')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror

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
                                            <th>Name</th>
                                            <th>Created Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($categories as $category )
                                          <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td> {{ $category->created_at->format('d-F-Y (h:m:s)') }} </td>
                                            <td>
                                                <a href="{{ route('category#edit', $category->id) }}" class="btn btn-sm btn-outline-secondary"> <i
                                                        class="fa-solid fa-pen-to-square"></i> </a>
                                                <button type="button" onclick="deleteConfirm({{ $category->id }})" class="btn btn-sm btn-outline-danger"> <i
                                                        class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        @endforeach






                                    </tbody>
                                </table>

                                <span class=" d-flex justify-content-center">{{ $categories->links() }}</span>

                            </div>
                        </div>
                    </div>

                </div>


@endsection

@if(Session::has('message'))
    @section('script-content')
    <script>
            Swal.fire({
            title: "{{ Session::get('message') }}",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
        });
       console.log('hello');
    </script>
    @endsection 
@endif

@section('script-content')

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
                location.href = "/admin/category/delete/"+id;
            }, 1400);
        }
        });
    }
</script>

@endsection

