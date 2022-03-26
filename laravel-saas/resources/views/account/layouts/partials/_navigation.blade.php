<ul class="nav nav-pills nav-stacked">
    <li class="{{ return_if(on_page('account'), 'active') }}">
        <a href="{{ route('account.index') }}">Account overview</a>
    </li>
    <li class="{{ return_if(on_page('account/profile'), 'active') }}">
        <a href="{{ route('account.profile.index') }}">Profile</a>
    </li>
    <li class="{{ return_if(on_page('account/password'), 'active') }}">
        <a href="{{ route('account.password.index') }}">Change password</a>
    </li>
    <li class="{{ return_if(on_page('account/deactivate'), 'active') }}">
        <a href="{{ route('account.deactivate.index') }}">Deactivate account</a>
    </li>
    <li class="{{ return_if(on_page('account/twofactor'), 'active') }}">
        <a href="{{ route('account.twofactor.index') }}">Two factor authentication</a>
    </li>
    <li class="{{ return_if(on_page('account/tokens'), 'active') }}">
        <a href="{{ route('account.tokens.index') }}">API tokens</a>
    </li>
</ul>

@subscribed
    @notpiggybacksubscription
        <hr>
        <ul class="nav nav-pills nav-stacked">
            @subscriptionnotcancelled
                <li class="{{ return_if(on_page('account/subscription/swap'), 'active') }}">
                    <a href="{{ route('account.subscription.swap.index') }}">Change plan</a>
                </li>
                <li class="{{ return_if(on_page('account/subscription/cancel'), 'active') }}">
                    <a href="{{ route('account.subscription.cancel.index') }}">Cancel subscription</a>
                </li>
            @endsubscriptionnotcancelled
            @subscriptioncancelled
                <li class="{{ return_if(on_page('account/subscription/resume'), 'active') }}">
                    <a href="{{ route('account.subscription.resume.index') }}">Resume subscription</a>
                </li>
            @endsubscriptioncancelled
            <li class="{{ return_if(on_page('account/subscription/card'), 'active') }}">
                <a href="{{ route('account.subscription.card.index') }}">Update card</a>
            </li>
            @teamsubscription
                <li class="{{ return_if(on_page('account/subscription/team'), 'active') }}">
                    <a href="{{ route('account.subscription.team.index') }}">Manage team</a>
                </li>
            @endteamsubscription
        </ul>
    @endnotpiggybacksubscription
@endsubscribed
