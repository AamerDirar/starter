<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .error {
            color: #ae1c17;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item active">
                        <a class="nav-link"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                            <span class="sr-only">(current)</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{__('messages.Update your offer')}}

            </div>
            '
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <br>
            <form method="POST" action="{{ route('offers.update', $offer->id) }}">
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                <div class="form-group">
                    <label for="exampleInputEmail1">أختر صوره العرض</label>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.Offer Name')}}"
                           value="{{ $offer->name_ar }}">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                    <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.Offer Name')}}"
                           value="{{ $offer->name_en }}">
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control" name="price" placeholder="{{__('messages.Offer Price')}}"
                           value="{{ $offer->price }}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Offer details ar')}}</label>
                    <input type="text" class="form-control" name="details_ar" value="{{ $offer->details_ar }}"
                        placeholder="{{__('messages.Offer details')}}">
                    @error('details_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Offer details en')}}</label>
                    <input type="text" class="form-control" name="details_en" value="{{ $offer->details_en }}"
                        placeholder="{{__('messages.Offer details')}}">
                    @error('details_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">{{__('messages.update')}}</button>
            </form>


        </div>
    </div>
</body>
</html>
