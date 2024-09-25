@extends('layouts.app')

@section('content')
<table>
    <thead>
        <tr>
            <th>Client ID</th>
            <!-- Loop through months dynamically -->
            @foreach ($emiDetails[0] as $key => $value)
                @if ($key != 'clientid')
                    <th>{{ $key }}</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($emiDetails as $row)
            <tr>
                <td>{{ $row->clientid }}</td>
                @foreach ($row as $key => $value)
                    @if ($key != 'clientid')
                        <td>{{ $value }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
