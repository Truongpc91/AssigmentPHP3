<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* General styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007BFF;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .content {
            padding: 20px;
        }

        .invoice-details,
        .customer-details {
            margin-bottom: 20px;
        }

        .customer-details p,
        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f4f4f4;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
        }

        .footer {
            background-color: #007BFF;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .content {
                padding: 10px;
            }

            .invoice-table th,
            .invoice-table td {
                padding: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ $mailData['title'] }}</h1>
        </div>
        <div class="content">
            <div class="customer-details">
                <p><strong>Hóa đơn : </strong></p>
                <p>Tên: {{ $mailData['order']->user_name }}</p>
                <p>Email: {{ $mailData['order']->user_email }}</p>
                <p>Phone:{{ $mailData['order']->user_phone }}</p>
                <p>Address: {{ $mailData['order']->user_address }}</p>
                <p>Note: {{ $mailData['order']->user_note }}</p>
            </div>
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mailData['orderDetail'] as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->variant_size_name }}</td>
                            <td>{{ $item->variant_color_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product_price_sale) }}</td>
                            <td>{{ number_format($item->quantity * $item->product_price_sale) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="total">Total</td>
                        <td colspan="2" > <strong>{{ number_format($mailData['order']->total_price) }} vnđ</strong></td>
                    </tr>
                </tfoot>
            </table>
            <p>Nếu có thắc mắc và đánh giá liên hệ đến email<a
                    href="">truonqpc91@gmail.com</a>.</p>
        </div>
        <div class="footer">
            <p>&copy; Cảm ơn đã đặt hàng</p>
        </div>
    </div>
</body>

</html>
