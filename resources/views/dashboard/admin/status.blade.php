@extends('master.masterDashboardAdmin')

@section('namaHalaman')
<h1>{{ $namaHalaman }}</h1>
@endsection

@section('content')

<table class="table">
    <thead>
        <tr>
            <td>Email</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
    </thead>

    <tbody>
        @forelse ($users as $user)

            <tr>
                <td>{{ $user->email }}</td>
                <td>@if($user->status == 0) Inactive @else Active @endif</td>
                <td><a href="{{ route('status', $user->id) }}">@if($user->status == 1) Inactive @else Active @endif</a></td>
            </tr>
            
        @empty
            <p>Data users tidak ditemukan...</p>
        @endforelse
        
    </tbody>
</table>

{{ $users->links() }}

@endsection