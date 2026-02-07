<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Weekly Binary Report</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; text-align:center; }
        th { background:#f0f0f0; }
    </style>
</head>
<body>

<h2 style="text-align:center">Weekly Binary Income Report</h2>

<p>
<strong>User:</strong> {{ $user->username }} <br>
<strong>Period:</strong> Last 7 Days
</p>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Pairs</th>
            <th>Commission</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $row)
        <tr>
            <td>{{ $row->date }}</td>
            <td>{{ $row->pair }}</td>
            <td>{{ number_format($row->commission,2) }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <th>{{ $totalPair }}</th>
            <th>{{ number_format($totalCommission,2) }}</th>
        </tr>
    </tfoot>
</table>

</body>
</html>
