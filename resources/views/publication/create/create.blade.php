@section('create')
    @foreach(['success','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{$status}} text-center">
                {{session()->get($status)}}
            </div>
        @endif
    @endforeach
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            {!! Form::open(['url' => (isset($ads->id)) ? route('update.publication', $ads->id) : route('store.publication'), 'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <div class="col-md-6">
                        <div>{!!Form::label('Ad-Title', 'Заголовок объявления:', ['class' => 'h3 label'])!!}</div>
                        {!! Form::text('title',isset($ads->title) ? $ads->title  : old('title'), ['class' => 'form-control', 'placeholder'=>'Введите название объявления']) !!}

                        {!!Form::label('cost', 'Стоимость:', ['class' => 'h3 label'])!!}
                        {!! Form::number('cost',isset($ads->cost) ? $ads->cost  : old('cost'), ['class' => 'form-control', 'placeholder'=>'Введите стоимость объявления']) !!}
                    </div>
                </div>
                @if(isset($ads))
                    @foreach($ads->imges as $item)

                        <div class="col-md-4" class="img-field">
                            {{--{!!Form::label('Photo-ads', 'Фото объявления:', ['class' => 'label'])!!}--}}
                            {{--{{ Html::image(asset('storage/'.$item->path, ''))}}--}}
                            <img class="img-responsive" src="{{ asset('storage/'.$item->path) }}" width="600" alt="">
                        {!! Form::hidden('old_image',$item->path) !!}
                        <!--                         <div>

                                {!! Form::open(['url' => route('destroy.image', $item->id),'class'=>'form-horizontal','method'=>'POST']) !!}

                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                        {!! Form::close() !!}
                            </div>-->
                            <a class="btn btn-french-5" href="{{ route('destroy.image', $item->id) }}">удалить</a>

                        </div>
                    @endforeach
                    <div class="col-md-6">
                        <div class="input-prepend">
                            {!! Form::file('images[]', ['multiple' => true,'class' => 'filestyle', 'data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>""]) !!}
                        </div>
                    </div>
                @else
                    <div class="col-md-6" class="text-field">
                        {!!Form::label('Photo-ads', 'Фото объявления:', ['class' => 'label'])!!}
                        <div class="input-prepend">
                            {!! Form::file('images[]', ['multiple' => true, 'class' => 'filestyle','data-buttonText'=>'Выберите изображение',
                            'data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
                        </div>
                    </div>
                @endif
                <div class="form-check form-switch" class="text-field">
                    @if(isset($ads))
                        {!!Form::label('Ad-category', 'Измените категорию:', ['class' => 'h4 label my-3'])!!}
                        @foreach($cat as $key => $item)
                            <p><input class="form-check-input" type="checkbox" name="category[]" value="{{ $key }}"
                                      @foreach ($ads->cat as $category) @if($category->id === $key ) checked @else
                                    '' @endif @endforeach>
                                {{ $item }}</p>
                        @endforeach
                </div>
                @else
                    <div class="form-check form-switch" class="text-field">
                        {!!Form::label('Ad-category', 'Выберите категорию:', ['class' => 'h4 label my-3'])!!}
                        @foreach($lists as $key => $item)

                            <p><input class="form-check-input" type="checkbox" name="category[]"
                                      value="{{ $key }}">{{ $item }}</p>

                        @endforeach
                        @endif
                    </div>
                    @if(isset($ads->id))
                        <input type="hidden" name="_method" value="PUT">

                    @endif
                    <div class="col-md-12" class="submit-button">
                        {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
                    </div>

            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
