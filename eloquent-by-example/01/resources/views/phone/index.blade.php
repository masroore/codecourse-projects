@foreach ($phoneNumbers as $phoneNumber)
    <div class="phone-number">
        <h4>{{$phoneNumber->phone_number }}</h4>
        <p>Belongs to {{ $phoneNumber->user->name }}</p>
    </div>
@endforeach
