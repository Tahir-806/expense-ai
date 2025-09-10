
<style>
    .custom-navbar {
        background: #fff;
        box-shadow: 0 8px 32px 0 rgba(56, 163, 220, 0.11), 0 1.5px 5px 0 rgba(56, 163, 220, 0.08);
        border-radius: 2.2rem;
        margin: 2.2rem auto 1.7rem auto;
        max-width: 1300px;
        width: 98vw;
        padding: 0.6rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .custom-navbar .navbar-brand {
        color: #2563eb;
        font-size: 2rem;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        letter-spacing: 0.03em;
    }
    .custom-navbar nav {
        display: flex;
        align-items: center;
        gap: 2rem;
    }
    .custom-nav-link {
        color: #2563eb;
        font-weight: 500;
        font-size: 1.09rem;
        text-decoration: none;
        border-radius: 1.4rem;
        padding: 0.49rem 1.25rem;
        transition: background 0.19s, color 0.16s, box-shadow 0.16s;
        position: relative;
    }
    .custom-nav-link.active,
    .custom-nav-link:hover {
        background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
        color: #fff;
        box-shadow: 0 3px 16px rgba(56, 163, 220, 0.10);
    }
    /* Profile Dropdown */
    .profile-menu {
        position: relative;
        display: inline-block;
    }
    .profile-btn {
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        color: #2563eb;
        font-weight: 600;
        font-size: 1.09rem;
        border-radius: 2rem;
        padding: 0.32rem 1.05rem 0.32rem 0.55rem;
        transition: background 0.16s;
    }
    .profile-btn .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #38b6ff;
    }
    .profile-btn .profile-caret {
        font-size: 1.2rem;
        transition: transform 0.17s;
    }
    .profile-menu.open .profile-caret {
        transform: rotate(180deg);
    }
    .profile-dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 0.5rem);
        min-width: 145px;
        background: #fff;
        border-radius: 1.2rem;
        box-shadow: 0 8px 20px 0 rgba(56, 163, 220, 0.13);
        z-index: 9999;
        padding: 0.6rem 0;
        overflow: hidden;
    }
    .profile-menu.open .profile-dropdown {
        display: block;
    }
    .profile-dropdown a,
    .profile-dropdown button {
        display: block;
        width: 100%;
        padding: 0.7rem 1.2rem;
        background: none;
        border: none;
        text-align: left;
        color: #2563eb;
        font-weight: 500;
        font-size: 1.01rem;
        text-decoration: none;
        transition: background 0.13s, color 0.13s;
        cursor: pointer;
    }
    .profile-dropdown a:hover,
    .profile-dropdown button:hover {
        background: #e9eefb;
        color: #2563eb;
    }
    @media (max-width: 700px) {
        .custom-navbar {
            flex-direction: column;
            align-items: stretch;
            padding: 0.6rem 0.7rem;
            border-radius: 1.2rem;
        }
        .custom-navbar nav {
            gap: 0.5rem;
            margin-top: 0.8rem;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .profile-dropdown {
            right: 0;
            left: unset;
        }
    }
</style>
<header class="custom-navbar">
    <a href="{{ url('/') }}" class="navbar-brand">
        <i class="bi bi-wallet2"></i> MyExpenses
    </a>
    <nav>
        <a href="{{ route('expenses.index') }}" class="custom-nav-link{{ request()->routeIs('expenses.index') ? ' active' : '' }}">Expense</a>
        <a href="{{ route('incomes.index') }}" class="custom-nav-link{{ request()->routeIs('incomes.index') ? ' active' : '' }}">Income</a>
        <a href="{{ route('budgets.index') }}" class="custom-nav-link{{ request()->routeIs('budgets.index') ? ' active' : '' }}">Budget</a>

        @auth
        <div class="profile-menu" id="profileMenu">
            <button class="profile-btn" id="profileBtn" type="button" aria-haspopup="true" aria-expanded="false">
                @if(Auth::user()->avatar ?? false)
                    <img class="user-avatar" src="{{ Auth::user()->avatar }}" alt="avatar">
                @else
                    <span style="background:#38b6ff; color:#fff; border-radius:50%; width:36px; height:36px; display:flex; align-items:center; justify-content:center; font-size:1.13rem; font-weight:600;">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </span>
                @endif
                <span>{{ Auth::user()->name }}</span>
                <span class="profile-caret"><i class="bi bi-chevron-down"></i></span>
            </button>
            <div class="profile-dropdown" id="profileDropdown">
                <a href="{{ route('profile.edit') }}">Profile</a>
                <button onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>
        @else
            <a href="{{ route('login') }}" class="custom-nav-link{{ request()->routeIs('login') ? ' active' : '' }}">Login</a>
            <a href="{{ route('register') }}" class="custom-nav-link{{ request()->routeIs('register') ? ' active' : '' }}">Register</a>
        @endauth
    </nav>
</header>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var profileMenu = document.getElementById('profileMenu');
    var profileBtn = document.getElementById('profileBtn');
    if(profileBtn) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('open');
        });
        document.addEventListener('click', function(e) {
            if (!profileMenu.contains(e.target)) {
                profileMenu.classList.remove('open');
            }
        });
    }
});
</script>
