@extends('admin.layouts.master')

@section('content')
    <div class="mt-3 col-4 offset-4">
        <div class="card">
            <div class="shadow card-body">
                <h2 class="text-center">Payment Update form</h2>
                <form action="{{ route('payment#update', $payment->id) }}" method="post" class="p-3 rounded ">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="accNumber"
                            value="{{ old('accNumber') ? old('accNumber') : $payment->account_number }}"
                            class=" form-control @error('accNumber') is-invalid @enderror" placeholder="Account Number...">
                        @error('accNumber')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text" name="accName"
                            value="{{ old('accName') ? old('accName') : $payment->account_name }}"
                            class=" form-control @error('accName') is-invalid @enderror" placeholder="Account Name...">
                        @error('accName')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text" name="accType"
                            value="{{ old('accType') ? old('accType') : $payment->account_type }}"
                            class=" form-control @error('accType') is-invalid @enderror" placeholder="Account Type...">
                        @error('accType')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>


                    <input type="submit" value="Update" class="mt-3 btn btn-outline-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
