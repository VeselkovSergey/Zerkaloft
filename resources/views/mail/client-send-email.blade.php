<div style="text-align: center; background-image: url('{{asset('img/new-bg.jpeg')}}'); background-repeat: no-repeat; background-size: cover; padding: 20px;">
    <div>
        <img width="140" height="75" src="{{asset('icon/new_logo.png')}}" alt="">
    </div>
    <div style="text-align: center; color: white;">
        <h3>Вы оформили заказ у нас на сайте</h3>
        <div>Оплата: {{$paymentType}}</div>
        <div>Доставка: {{$deliveryType}}, по адресу: {{$address}}</div>
        <div>Заказ: {{$products}}</div>
    </div>
</div>
