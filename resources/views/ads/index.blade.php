<div class="container">
    <div class="row">
        @if (url('/search') !== url()->current())
            <div class="col-6">
                {!! Form::open(['url' => route('search.ads'), 'class'=>'contact-form d-flex my-3','method'=>'GET']) !!}
                <input class="form-control mr-sm-2" id="s" name="search" type="text"
                       placeholder="Введите название объявления"
                       aria-label="Search">
                <button class="btn btn-primary" type="submit">Поиск</button>
                {!! Form::close() !!}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="my-3"><h3>Список категорий:</h3></div>
                <div class="list-group list-group-flush">
                    @if(isset($category))
                        @foreach($category as $item)
                            <a class="list-group-item" href="{{'ads/'. $item->id }}">{{ $item->title }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="list-group list-group-flush">
                    <a class="list-group-item h4 my-2" href="{{ route('category') }}">Все категории</a>
                </div>
            </div>
        </div>
        <h3 class="my-3">Объявления:</h3>
        @if(count($ads))
            <div class="row">
                @foreach($ads as $item)
                    <div class="col-lg-3 col-md-6 col-12">
                        <div><a href="{{'ads/'.$item->cat->first()->slug.'/'. $item->id }}"><strong
                                    class="title">{{ Str::substr($item->title, 0, 25) }}</strong></a></div>
                        <img class="img-fluid" src="{{ asset('storage/'.$item->imges->first()->path) }}">
<!--                             style="height:160px;width:240px;"
                             alt=""-->
                        <div>{{ $item->cost.'руб' }}</div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    {{$ads->appends(['search' => request()->search])->links()}}
                </div>
            </div>
        @else
            <div class="h3">Объявлений не найдено.</div>
        @endif
    </div>


