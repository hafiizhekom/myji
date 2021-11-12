<?php
   
function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;    
}

function totalprice_order($order){
    
    $price=0;
    $dicount = $order->discount_amount;
    foreach ($order->detail as $key => $detail) {
        $price = $price + $detail->total_price;
    }
    $price = $price - $dicount;
    return $price;
}