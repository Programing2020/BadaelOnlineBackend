@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.testi.update',$testi->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container">

        <div class="form-group ml-5">

            <label for="Photo" class="col-sm-2 col-form-label">Photo</label>

            <div class="col-sm-7">

                <input type="file" name='photo' class="form-control {{$errors->first('photo') ? "is-invalid" : "" }} " value="{{old('photo') ? old('photo') : $testi->photo}}" id="photo">

                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="lang" class="col-sm-2 col-form-label">Languages</label>

            <div class="col-sm-9">
                <select class="form-control" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- name --}}
        <div class="form-group ml-5 en">

            <label for="name" class="col-sm-2 col-form-label">Name English</label>

            <div class="col-sm-7">

                <input type="text" name='testimonial[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $testi->name}}" id="name">
                <input type="text" name='testimonial[en][local]' id="local" value="en" hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="name" class="col-sm-2 col-form-label">Name Arabic</label>

            <div class="col-sm-7">

                <input type="text" name='testimonial[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $testi->name}}" id="name">
                <input type="text" name='testimonial[ar][local]' id="local" value="ar" hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>

        {{-- proffession --}}
        <div class="form-group ml-5 en">

            <label for="profession" class="col-sm-2 col-form-label">Profession English</label>

            <div class="col-sm-7">

                <input type="text" name='testimonial[en][profession]' class="form-control {{$errors->first('profession') ? "is-invalid" : "" }} " value="{{old('profession') ? old('profession') : $testi->profession}}" id="profession">
                <input type="text" name='testimonial[en][local]' id="local" value="en" hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('profession') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="profession" class="col-sm-2 col-form-label">Profession Arabic</label>

            <div class="col-sm-7">

                <input type="text" name='testimonial[ar][profession]' class="form-control {{$errors->first('profession') ? "is-invalid" : "" }} " value="{{old('profession') ? old('profession') : $testi->profession}}" id="profession">
                <input type="text" name='testimonial[ar][local]' id="local" value="ar" hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('profession') }}
                </div>

            </div>

        </div>

        {{-- desc --}}
        <div class="form-group ml-5 en">

            <label for="desc" class="col-sm-2 col-form-label">Testi English</label>

            <div class="col-sm-7">

                <textarea name="testimonial[en][desc]" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('desc') ? old('desc') : $testi->desc}}</textarea>
                <input type="text" name='testimonial[en][local]' id="local" value="en" hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('desc') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="desc" class="col-sm-2 col-form-label">Testi Arabic</label>

            <div class="col-sm-7">

                <textarea name="testimonial[ar][desc]" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('desc') ? old('desc') : $testi->desc}}</textarea>
                <input type="text" name='testimonial[ar][local]' id="local" value="ar" hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('desc') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="status" class="col-sm-2 col-form-label">Status</label>

            <div class="col-sm-7">

                <select name='status' class="form-control {{$errors->first('status') ? "is-invalid" : "" }} " id="status">
                    <option {{$testi->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">PUBLISH</option>

                    <option {{$testi->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">DRAFT</option>
                </select>

                <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">Update</button>

            </div>

        </div>

    </div>

  </form>
@endsection

@push('scripts')
<script>
    // language

    window.onload = function () {
        if(localStorage.getItem('local') == 'en'){
                $('.ar').css({display: "none"});
                $('.en').css({display: "block"});
        }else{
                $('.ar').css({display: "block"});
                $('.en').css({display: "none"});
        }
    }

    $(function () {
        $("#selectLang").change(function() {
            var val = $(this).val();
            localStorage.setItem('local',val);
            if(localStorage.getItem('local') == 'en'){
                $('.ar').css({display: "none"});
                $('.en').css({display: "block"});
        }else{
                $('.ar').css({display: "block"});
                $('.en').css({display: "none"});
        }
        });
    });

</script>

@endpush
