@extends('admin.layouts.master')

@section('content')

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
                        <h1 class="mb-0 text-gray-800 h3">Category List</h1>
                    </div>
                    @if(Session::has('message'))
                      <p class="alert alert-info">{{ Session::get('message') }}</p>
                    @endif

                    <div class="">
                        <div class="row">
                            <div class="col-4">
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

                            <div class="col ">
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


                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-outline-secondary"> <i
                                                        class="fa-solid fa-pen-to-square"></i> </a>
                                                <a href="" class="btn btn-sm btn-outline-danger"> <i
                                                        class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>

                                <span class=" d-flex justify-content-end"></span>

                            </div>
                        </div>
                    </div>

                </div>


@endsection