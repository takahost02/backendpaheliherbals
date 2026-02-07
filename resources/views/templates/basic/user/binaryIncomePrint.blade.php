<!DOCTYPE html>
<html>
<head>
    <title>Master Matching Income Report</title>
    <style>
        body { font-family: Arial; }
        table { width:100%; border-collapse: collapse; }
        table, th, td { border:1px solid #000; }
        th, td { padding:8px; text-align:center; }
    </style>
</head>
<body>

<h2>Master Matching Income Report</h2>
<h4>Total Income: {{ showAmount($totalIncome) }}</h4>

<table>
    <thead>
        <tr>
            <th>TRX</th>
            <th>Session</th>
            <th>Pairs</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Post Balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $trx)

            @php
                preg_match('/\((.*?)\)/', $trx->details, $sessionMatch);
                $session = $sessionMatch[1] ?? '-';

                preg_match('/(\d+)\s*Pair/', $trx->details, $pairMatch);
                $pairs = $pairMatch[1] ?? 0;
            @endphp

            <tr>
                <td>{{ $trx->trx }}</td>
                <td>{{ $session }}</td>
                <td>{{ $pairs }}</td>
                <td>{{ showDateTime($trx->created_at) }}</td>
                <td>{{ showAmount($trx->amount) }}</td>
                <td>{{ showAmount($trx->post_balance) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>
