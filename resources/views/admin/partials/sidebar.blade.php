<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar" style="overflow: auto;">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.slideshows.index' || Route::currentRouteName() == 'admin.slideshows.create' || Route::currentRouteName() == 'admin.slideshows.edit') ? 'active' : '' }}"
               href="{{ route('admin.slideshows.index') }}">
                <i class="app-menu__icon fa fa-hand-o-right"></i>
                <span class="app-menu__label">Slider</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.abouts.index' || Route::currentRouteName() == 'admin.abouts.create' || Route::currentRouteName() == 'admin.abouts.edit') ? 'active' : '' }}"
               href="{{ route('admin.abouts.index') }}">
                <i class="app-menu__icon fa fa-signal"></i>
                <span class="app-menu__label">About us</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.programs.index' || Route::currentRouteName() == 'admin.programs.create' || Route::currentRouteName() == 'admin.programs.edit') ? 'active' : '' }}"
               href="{{ route('admin.programs.index') }}">
                <i class="app-menu__icon fa fa-th-large"></i>
                <span class="app-menu__label">programs</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.notices.index' || Route::currentRouteName() == 'admin.notices.create' || Route::currentRouteName() == 'admin.notices.edit') ? 'active' : '' }}"
               href="{{ route('admin.notices.index') }}">
                <i class="app-menu__icon fa fa-book"></i>
                <span class="app-menu__label">Notice</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.welcomes.index' || Route::currentRouteName() == 'admin.welcomes.create' || Route::currentRouteName() == 'admin.welcomes.edit') ? 'active' : '' }}"
               href="{{ route('admin.welcomes.index') }}">
                <i class="app-menu__icon fa fa-map-o"></i>
                <span class="app-menu__label">Welcome Message</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.lifes.index' || Route::currentRouteName() == 'admin.lifes.create' || Route::currentRouteName() == 'admin.lifes.edit') ? 'active' : '' }}"
               href="{{ route('admin.lifes.index') }}">
                <i class="app-menu__icon fa fa-file-pdf-o"></i>
                <span class="app-menu__label">Life at Advance</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.scholarships.index' || Route::currentRouteName() == 'admin.scholarships.create' || Route::currentRouteName() == 'admin.scholarships.edit') ? 'active' : '' }}"
               href="{{ route('admin.scholarships.index') }}">
                <i class="app-menu__icon fa fa-check-square-o"></i>
                <span class="app-menu__label">Scholarship</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.feestructures.index' || Route::currentRouteName() == 'admin.feestructures.create' || Route::currentRouteName() == 'admin.feestructures.edit') ? 'active' : '' }}"
               href="{{ route('admin.feestructures.index') }}">
                <i class="app-menu__icon fa fa-film"></i>
                <span class="app-menu__label">Fee Structure</span>
            </a>
        </li>



        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.hostelfees.index' || Route::currentRouteName() == 'admin.hostelfees.create' || Route::currentRouteName() == 'admin.hostelfees.edit') ? 'active' : '' }}"
               href="{{ route('admin.hostelfees.index') }}">
                <i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">Hostel Fee</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.galleries.index' || Route::currentRouteName() == 'admin.galleries.create' || Route::currentRouteName() == 'admin.galleries.edit') ? 'active' : '' }}"
               href="{{ route('admin.galleries.index') }}">
                <i class="app-menu__icon fa fa-user-circle"></i>
                <span class="app-menu__label">Gallery</span>
            </a>
        </li>


        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.images.index' || Route::currentRouteName() == 'admin.images.create' || Route::currentRouteName() == 'admin.images.edit') ? 'active' : '' }}"
               href="{{ route('admin.images.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Gallery Images</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.achievers.index' || Route::currentRouteName() == 'admin.achievers.create' || Route::currentRouteName() == 'admin.achievers.edit') ? 'active' : '' }}"
               href="{{ route('admin.achievers.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Achiver</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.events.index' || Route::currentRouteName() == 'admin.events.create' || Route::currentRouteName() == 'admin.events.edit') ? 'active' : '' }}"
               href="{{ route('admin.events.index') }}">
                <i class="app-menu__icon fa fa-comment"></i>
                <span class="app-menu__label">Event</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.admissionforms.index' ? 'active' : '' }}"
               href="{{ route('admin.admissionforms.index') }}">
                <i class="app-menu__icon fa fa-thumbs-up"></i>
                <span class="app-menu__label">Admission form</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.contacts.index' ? 'active' : '' }}"
               href="{{ route('admin.contacts.index') }}">
                <i class="app-menu__icon fa fa-thumbs-up"></i>
                <span class="app-menu__label">Message From user</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.allimages.index' || Route::currentRouteName() == 'admin.allimages.create' || Route::currentRouteName() == 'admin.allimages.edit') ? 'active' : '' }}"
               href="{{ route('admin.allimages.index') }}">
                <i class="app-menu__icon fa fa-thumbs-up"></i>
                <span class="app-menu__label">Upload Image</span>
            </a>
        </li>

    </ul>
</aside>
