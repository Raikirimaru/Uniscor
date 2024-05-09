<ul class="nav flex-column">
    @if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a href="{{ route('universities.index') }}" class="nav-link">Universities</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link">Users</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('criterias.index') }}" class="nav-link">Criteria</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('comments.index') }}" class="nav-link">Comments</a>
    </li>
    @endif
    <li class="nav-item">
        <a href="{{ route('auth.profileView') }}" class="nav-link">Profile</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('auth.updatePasswordView') }}" class="nav-link">Change Password</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('auth.logout') }}" class="nav-link">Logout</a>
    </li>
</ul>


