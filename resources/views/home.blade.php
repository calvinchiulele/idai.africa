@extends('layouts.app')
@section('content')
<div class="container">
    @auth
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (Auth::user()->role_id != 2)
                <div class="card">
                    <div class="card-header">
                        Welcome Mr {{ Auth::user()->name }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }} Auth::user()->name
                            </div>
                        @endif

                        You are logged in!
                            <a href="{{url('/')}}/admin">
                                Go to administration dashboard
                            </a>
                    </div>
                </div>
            @endif

            @if (Auth::user()->role_id == 2)
            <div class="card mt-5">
                <div class="card-header">Register Volunteer</div>
                <div class="card-body">
                    <div class="card-body">
                    <form method="POST" 
                    action="{{ route('volunteers.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="province" 
                            class="col-md-4 col-form-label 
                            text-md-right">
                                {{ __('Province') }}
                            </label>
                            
                            <div class="col-md-6">
                                <select name="province" 
                                class="browser-default custom-select 
                                custom-select-lg mb-3" id="province_select">
                                    <option value="{{ $province->id }}" 
                                    selected>
                                        {{ $province->name }}
                                    </option>
                                    @foreach($provinces as $someProvince)
                                        <option 
                                        value="{{ $someProvince->id }}">
                                            {{ $someProvince->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="province" 
                            class="col-md-4 col-form-label text-md-right">
                                {{ __('City') }}
                            </label>
                            
                            <div class="col-md-6">
                                <select name="city" 
                                class="browser-default custom-select 
                                custom-select-lg mb-3">
                                    <option 
                                    value="{{ $province->GeoCity[0]->id }}" 
                                    selected>
                                        {{ $province->GeoCity[0]->name }}
                                    </option>
                                    @foreach($province->GeoCity as $city)
                                        <option value="{{ $city->id }}">
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" 
                            class="col-md-4 col-form-label text-md-right">
                                {{ __('Telephone') }}
                            </label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" 
                                class="form-control 
                                {{ $errors->has('telephone') ? 
                                'is-invalid' : '' }}" 
                                name="telephone" required autofocus
                                placeholder="84 73 32 021">

                                @if ($errors->has('telephone'))
                                    <span class="invalid-feedback" 
                                    role="alert">
                                        <strong>
                                            {{ $errors->first('telephone') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--
                        <div class="form-group row">
                            <label for="whatsapp" 
                            class="col-md-4 col-form-label 
                            text-md-right">
                                {{ __('This number has WhatsApp ?') }}
                            </label>
                            
                            <div class="col-md-6">
                                <select class="browser-default custom-select custom-select-lg mb-3">
                                    <option selected>Yes</option>
                                    <option value="1">No</option>
                                </select>
                            </div>
                        </div>
                        --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" 
                                class="btn btn-primary float-right">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endauth
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#province_select").change(function () {
                $("#province_select option:selected").each(function() {
                    window.location.replace(
                        "{{ url('/') }}/home/" +$(this).val()
                    );
                });
            });  
        })
    </script>
@endsection
