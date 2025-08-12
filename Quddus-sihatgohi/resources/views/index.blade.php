@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bronlar Ro'yxati</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ism</th>
                        <th>Telefon</th>
                        <th>Kelish</th>
                        <th>Ketish</th>
                        <th>Davolash turi</th>
                        <th>Holati</th>
                        <th>Harakatlar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->arrival_date->format('d.m.Y') }}</td>
                        <td>{{ $booking->departure_date->format('d.m.Y') }}</td>
                        <td>{{ ucfirst($booking->treatment_type) }}</td>
                        <td>
                            <span class="badge bg-{{ 
                                $booking->status == 'confirmed' ? 'success' : 
                                ($booking->status == 'pending' ? 'warning' : 
                                ($booking->status == 'cancelled' ? 'danger' : 'info')) 
                            }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-info">Ko'rish</a>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-primary">Tahrirlash</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection