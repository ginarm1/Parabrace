@component('mail::message')
# Your order was successful!

Thank You {{$user_name}}. Your Order ID: {{$order->id}}

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
