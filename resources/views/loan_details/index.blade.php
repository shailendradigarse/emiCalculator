@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Loan Details</h2>

    <!-- Loan Details Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Number of Payments</th>
                <th>First Payment Date</th>
                <th>Last Payment Date</th>
                <th>Loan Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loanDetails as $loan)
            <tr>
                <td>{{ $loan->clientid }}</td>
                <td>{{ $loan->num_of_payment }}</td>
                <td>{{ $loan->first_payment_date }}</td>
                <td>{{ $loan->last_payment_date }}</td>
                <td>{{ $loan->loan_amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Process Data Button -->
    <form action="{{ route('process.data') }}" method="POST" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-primary">Process Data</button>
    </form>

    <!-- EMI Details Table -->
    @if(session('emiDetails'))
    <h2>EMI Details</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client ID</th>
                @foreach(session('emiColumns') as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach(session('emiDetails') as $emi)
            <tr>
                <td>{{ $emi['clientid'] }}</td>
                @foreach(session('emiColumns') as $column)
                    <td>{{ $emi[$column] ?? '0.00' }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
