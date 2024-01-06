<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item"><a class="nav-link {{ (Route::is('account-settings.account')) ? 'active' : '' }}" href="{{ route('account-settings.account') }}"><i
                class="bx bx-user me-1"></i> Account</a></li>
    <li class="nav-item"><a class="nav-link {{ (Route::is('account-settings.security')) ? 'active' : '' }}" href="{{ route('account-settings.security') }}"><i
                class="bx bx-lock-alt me-1"></i> Security</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('pages/account-settings-billing') }}"><i
                class="bx bx-detail me-1"></i> Billing & Plans</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('pages/account-settings-notifications') }}"><i
                class="bx bx-bell me-1"></i> Notifications</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('pages/account-settings-connections') }}"><i
                class="bx bx-link-alt me-1"></i> Connections</a></li>
</ul>
