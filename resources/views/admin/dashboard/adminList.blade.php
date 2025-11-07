@extends('admin.layouts.master')

@section('content')
    <div class="mt-3 col">
        <div class="mb-4 d-sm-flex align-items-center justify-content-between">
            <a href="{{ route('user#list') }}"><button class="text-white btn btn-secondary">Users</button></a>

            <form action="{{ route('admin#list') }}" method="get">

                <div class="input-group">
                    <input type="text" name="searchKey" value="{{ request('searchKey') }}" class="form-control"
                        placeholder="Search...">
                    <button class="text-white btn bg-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>


        </div>

        <table class="table shadow-sm table-hover ">
            <thead class="text-white bg-primary">
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td><a href="{{ route('user#peek', $admin->id) }}">{{ $admin->name }}</a></td>
                        <td><span class="p-2 text-white badge bg-danger rounded-pill text-uppercase">
                                {{ $admin->role }}
                            </span></td>
                        <td> {{ $admin->created_at->format('d-F-Y (h:m:s)') }} </td>
                        <td>
                            {{-- <a href="{{ route('category#edit', $category->id) }}" class="btn btn-sm btn-outline-secondary"> <i
                                    class="fa-solid fa-pen-to-square"></i> </a> --}}
                            @if (auth()->user()->role === 'superadmin')
                                <button type="button" onclick="deleteConfirm({{ $admin->id }})"
                                    class="btn btn-sm btn-outline-danger"> <i class="fa-solid fa-trash"></i>
                                </button>
                            @endif

                        </td>
                    </tr>
                @endforeach






            </tbody>
        </table>

        <span class=" d-flex justify-content-center">{{ $admins->links() }}</span>

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

                    location.href = "/superadmin/delete/users/" + id;

                }
            });
        }
    </script>
@endpush
