@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 text-center p-5">
            

                @if ($status == 'success')
                    <div class="mb-4">
                        <i class="fas fa-check-circle fa-4x text-success"></i>
                    </div>
                    <h2 class="text-success">Payment Successful</h2>
                    <p class="lead">🎉 Your room is booked. Enjoy your stay!</p>
                @else
                    <div class="mb-4">
                        <i class="fas fa-times-circle fa-4x text-danger"></i>
                    </div>
                    <h2 class="text-danger">Payment Failed</h2>
                    <p class="lead">⚠️ Something went wrong. Please try again later.</p>
                @endif

                <a href="{{ route('home') }}" class="btn btn-primary mt-4 px-4">
                    <i class="fas fa-home me-2"></i>Back to Home
                </a>

            </div>
        </div>
    </div>
</div>
@endsection
