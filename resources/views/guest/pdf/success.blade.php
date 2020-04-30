<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprobante de Pago</title>
<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .footer{
        padding-top: 50px;
        font-size: 10px;
        text-align: justify;

    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
</style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="">
                               
                            </td>
                            <td style="width:450px">
                                Código de  Pago: {{ $reference }} <br>
                                Fecha: {{ $dateForHumans }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Tienda e-commerce<br>
                                Oaxaca, Mexico
                                CP 68000
                            </td>
                            
                            <td>
                                {{ $name}}<br>
                                {{ $email}} <br>
    

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Código de Compra
                </td>
                
                <td>
                    
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    {{ $reference }}
                </td>
                
                <td>

                </td>
            </tr>
            <tr class="heading">
                <td>
                    Método de Pago
                </td>
                
                <td>
                    ID #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Mercado Pago Web Checkout
                </td>
                
                <td>
                    {{ $merchant_order_id}}
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Artículo
                </td>
                
                <td>
                    Precio
                </td>
            </tr>
            @forelse ($items as $item)
            <tr class="item">
                <td>
                    {{ $item->quantity }} {{ $item->name }}
                </td>
                
                <td>
                    {{ $item->price }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Sin Artículos</td>
            </tr>
            @endforelse
            

            
            <tr class="item last">
                <td>

                </td>
                
                <td>

                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                  $ {{ number_format($amount,2) }} 
                </td>
            </tr>
        </table>
        <p class="footer" >Agradecemos su compra, para cualquier aclaración no dude en contactar con nosotros. Todos los pagos son realizados en pesos mexicanos. </p>
    </div>
</body>
</html>