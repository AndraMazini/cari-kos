@extends('layouts.app')

@section('content')
<div class="container">

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- DETAIL KOS --}}
    <div class="card mb-4">
        <div class="card-body">
            <h3>{{ $boardingHouse->name }}</h3>
            <p>{{ $boardingHouse->address }}</p>
            <p>Harga mulai: Rp {{ number_format($boardingHouse->price) }}</p>
        </div>
    </div>

    {{-- BOOKING SECTION --}}
    <div class="card">
        <div class="card-body">

            @auth
                <form action="{{ url('/booking/' . $boardingHouse->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Booking Kos
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning">
                    Login dulu untuk booking
                </a>
            @endauth

        </div>
    </div>

</div>
@endsection
