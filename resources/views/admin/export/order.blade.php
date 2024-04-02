<!-- resources/views/export.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data</title>
    <style>
        /* Atur gaya tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data orders</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>NO ORDER</th>
                <th>PRODUK</th>
                <th>VARIAN NAME</th>
                <th>QTY</th>
                <th>CUSTOMER</th>
                <th>ALAMAT</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $key=> $order)
            @php
                $order_status = '';
                switch ($order->order->order_status_id) {
                case '1':
                    if (count($order->order->payment) > 0) {
                    # code...
                    $order_status = 'Menunggu Konfirmasi';
                    }else{
                    $order_status = 'Menunggu Pembayaran';
                    }
                    break;
                case '2':
                    $order_status = 'Pesanan diproses';
                    break;
                case '3':
                    $order_status = 'Menunggu Pelunasan';
                    break;
                case '4':
                    $order_status = 'Pesanan diproses';
                    break;
                case '5':
                    $order_status = 'Pesanan siap dikirim';
                    break;
                case '6':
                    $order_status = 'Dalam Pengiriman';
                    break;
                case '7':
                    $order_status = 'Order Selesai';
                    break;
                    
                default:
                    $order_status = 'Order Selesai';
                    # code...
                    break;
                }
            @endphp
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $order->order->order_no }}</td>
                <td>{{ $order->product->name }}</td>
                <td>{{ $order->product_varian_name }}</td>
                <td>{{ $order->qty }}</td>
                <td>{{ $order->order->name }}</td>
                <td>{{ $order->order->address }}</td>
                <td>{{ $order_status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
