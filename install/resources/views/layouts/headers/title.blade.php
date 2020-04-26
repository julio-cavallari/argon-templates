<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-md-12 {{ $class ?? '' }}">
          @if (isset($title) && $title)
            <h1 class="display-2 text-white">{{ $title }}</h1>
          @endif
          @if (isset($description) && $description)
            <p class="text-white mt-0 mb-5">{{ $description }}</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
