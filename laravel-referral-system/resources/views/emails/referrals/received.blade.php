@component('mail::message')
# {{ $sender->name }} has invited you to Codecourse

You'll get 50% off your first payment

@component('mail::button', ['url' => route('register', ['referral' => $referral->token])])
    Sign up now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
