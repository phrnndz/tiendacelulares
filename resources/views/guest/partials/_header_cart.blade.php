 
 <?php $total = 0 ?>
@foreach((array) session('cart') as $id => $details)
 <?php $total += $details['price'] * $details['quantity'] ?>
@endforeach
<div class="shopping-item">
    <a href="{{ url('/cart') }}">Cesta - <span class="cart-amunt">${{ $total }}</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{{ count((array) session('cart')) }}</span></a>
</div>
