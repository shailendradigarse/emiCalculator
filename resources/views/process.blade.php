@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/process-emi" method="POST">
            @csrf
            <button type="submit">Process Data</button>
        </form>
    </div>
@endsection
