@extends('layout.layout')

@section('page_title', 'SignUp Page')

@section('content')
    <section id="main">
        <div class="container">

{{--            @if($errors->any())--}}
{{--                @foreach($errors->all() as $error)--}}
{{--                    <div class="alert alert-danger" role="alert">--}}
{{--                        {{ $error }}--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endif--}}

            <form action="{{ route('auth.signup') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                    @error('email'){{$message}}@enderror
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username">
                    @error('username'){{$message}}@enderror

                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                    @error('password'){{$message}}@enderror
                </div>

                <div class="form-group">
                    <label for="re_password">Re Password:</label>
                    <input type="password" name="re_password" id="re_password">
                    @error('password'){{$message}}@enderror
                </div>

                <div class="form-group">
                    <label for="photo">Choose photo:</label>
                    <input type="file" name="photo" id="photo">
                    @error('photo'){{$message}}@enderror
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="policy">policy</label>--}}
{{--                    <input type="checkbox" name="policy" id="photo">--}}
{{--                </div>--}}

                <br/>

                <button class="button">Sign Up</button>
            </form>
        </div>
    </section>
@endsection
