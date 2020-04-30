@extends('dashboard.partials.base')

@section('titulo')
    Administración de Pagos
@endsection
@section('head') 
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid mg-t-40">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="sparkline8-list">
                <div class="sparkline8-hd">
                    <div class="main-sparkline8-hd">
                        <h1>Pagos Recibidos</h1>
                    </div>
                </div>
                <div class="sparkline8-graph">
                    <div class="static-table-list mg-t-40">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Fecha</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Costo</th>
                                    
                                    <th>Merchant Order ID</th>
                                    <th>Notificación ID</th>
                                    <th>Notificación Topic</th>
                                    <th>Estatus</th>
                                    <th>Última Actualización</th>



                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(function () {
      
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('payment.index') }}",
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'created_at', name: 'payments.created_at'},
              {data: 'codigo', name: 'payments.codigo'},
              {data: 'name', name: 'payments.name'},
              {data: 'email', name: 'payments.email'},
              {data: 'amount', name: 'payments.amount'},
              {data: 'merchant_order_id', name: 'payments.merchant_order_id'},
              {data: 'mercadopago_id', name: 'notifications.mercadopago_id'},
              {data: 'mercadopago_topic', name: 'notifications.mercadopago_topic'},
              {data: 'estatus', name: 'payments.estatus'},
              {data: 'updated_at', name: 'payments.updated_at'},


              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>
@endsection