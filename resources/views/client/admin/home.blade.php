@extends('layouts.client')

@section('content')
<div class="container">
    <div class="content">
        <h2 class="mb-2">Dashboard</h2>
        
        <div class="card">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </div>
        </div>
    </div>
</div>
@endsection
