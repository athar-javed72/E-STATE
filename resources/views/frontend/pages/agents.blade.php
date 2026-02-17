@extends('layouts.app')

@section('title', 'Our Agents - FindState')
@section('meta_description', 'Meet our team of experienced real estate agents ready to help you find or sell your property.')

@section('content')
{{-- Breadcrumb --}}
<section class="breadcrumb-section py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0 fw-bold">Our Agents</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agents</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if($agents->count() > 0)
            <div class="row g-4">
                @foreach($agents as $agent)
                    <div class="col-lg-3 col-md-6">
                        @include('frontend.components.agent-card', ['agent' => $agent])
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-5">
                {{ $agents->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                <h3>No agents yet</h3>
                <p class="text-muted">Check back soon for our team profiles.</p>
            </div>
        @endif
    </div>
</section>
@endsection
