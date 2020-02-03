<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Chollomix</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
      </li>
      @foreach ($categories as $category)
        <li class="nav-item">
          <a class="nav-link" href="{{route('category-view',$category->hash)}}">{{$category->title}}</a>
        </li>
      @endforeach
      <!--<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Informática
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Portátiles</a>
          <a class="dropdown-item" href="#">Tablets</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Ver todos</a>
        </div>
      </li>-->
    </ul>
  </div>
</nav>