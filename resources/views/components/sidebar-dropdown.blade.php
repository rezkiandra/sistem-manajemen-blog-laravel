<li class="sidebar-item {{ $active ? 'selected' : '' }}">
  <a class="sidebar-link has-arrow {{ $active ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
    <span class="hide-menu">
      <i class="{{ $icon }}"></i>
      {{ $title }}
    </span>
  </a>

  <ul aria-expanded="false" class="collapse first-level base-level-line {{ $active ? 'in' : '' }}">
    {{ $slot }}
  </ul>
</li>
