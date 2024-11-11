<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
<table style="width:100%;border-collapse:collapse;border: 2px solid black;">
    <thead >
        <th style="text-align:left;border: 2px solid black;">#</th>
        <th style="text-align:left;border: 2px solid black;">Taxable Income</th>
        <th style="text-align:left;border: 2px solid black;">PAYE</th>
        <th style="text-align:left;border: 2px solid black;">Status</th>
        <th style="text-align:left;border: 2px solid black;">Update Date</th>
    </thead>
    <tbody>
        @foreach($transactions as $key=>$transaction)
        <tr>
            <td style="border: 2px solid black;">{{$key+1}}</td>
            <td style="border: 2px solid black;">{{($transaction->basic_salary)+($transaction->allowances)-($transaction->insurance)-($transaction->pension)}}</td>
            <td style="border: 2px solid black;">{{$payee[$key]}}</td>
            <td style="border: 2px solid black;">
                @if($transaction->status == true)
                Paid
                @else
                Pending
                @endif
            </td>
            <td style="border: 2px solid black;">{{date_format($transaction->updated_at,'F jS, Y')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>