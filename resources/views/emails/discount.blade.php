@component('mail::message')
# Pemberitahuan Diskon Produk

@if(isset($user))
Halo, {{ $user->name }}!
@endif


Kami memiliki diskon baru untuk produk **{{ $productName }}**. Sekarang kamu bisa membelinya dengan potongan harga sebesar **{{ $discount }}%** mulai dari tanggal **{{ date('d F Y', strtotime($start_date)) }}** sampai tanggal **{{ date('d F Y', strtotime($end_date)) }}**!

Ayo belanja sekarang dan dapatkan diskonnya:

@component('mail::button', ['url' => route('products.all')])
Belanja Sekarang
@endcomponent

Terima kasih telah memilih produk kami dan memberikan dukunganmu!

Salam hangat,<br>
{{ config('app.name') }}
@endcomponent
