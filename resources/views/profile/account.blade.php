
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Account') }}</title>
    <!-- Bootstrap CSS-->
    <link href="{{asset('admin-assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="{{asset('admin-assets/css/theme.css')}}" rel="stylesheet" media="all">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>

  <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
             <div class="card">
                <div class="card-header">
                    <i class="fa fa-user"></i>
                    <strong class="card-title pl-2">Account Details</strong>
                </div>
                <div class="card-body">
                    <div class="mx-auto d-block">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                       <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle mx-auto d-block"/>
                       @else 
                       <img src="{{asset('admin-assets/images/icon/avatar-01.jpg')}}" alt="John Doe" />
                       @endif
                        <h5 class="text-sm-center mt-2 mb-1">{{ Auth::user()->name }}</h5>
                        <div class="location text-sm-center">
                            <i class="fa fa-map-marker"></i> {{ Auth::user()->email }}
                        </div>
                    </div>
        
                </div>
            </div>
       
        </div>
  </div>
</x-app-layout>

</body>
</html>
