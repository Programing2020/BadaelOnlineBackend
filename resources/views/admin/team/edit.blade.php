@extends('layouts.admin')

@section('styles')
<style>
   .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
 .picture {
  width: 300px;
  height: 400px;
  background-color: #999999;
  border: 4px solid #CCCCCC;
  color: #FFFFFF;
  /* border-radius: 50%; */
  margin: 5px auto;
  overflow: hidden;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
}
.picture:hover {
  border-color: #2ca8ff;
}
.picture input[type="file"] {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0 !important;
  position: absolute;
  top: 0;
  width: 100%;
}
.picture-src {
  width: 100%;
  height: 100%;
}
.rowInput {
    display: flex;
    gap: 15px;
}
.selectLang {
    margin-top: 38px;
}
</style>

@endsection

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.team.update',$team->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('team.Uteam')}}</h2>
    </div>

    <div class="form-group">

        <div class="picture-container">

            <div class="picture">

                <img src="{{asset('storage/' . $team->photo)}}" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                <input type="file" id="wizard-picture" name="photo" class="form-control {{$errors->first('photo') ? "is-invalid" : "" }} ">

                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>

            </div>

            <h6>{{ __('team.Scover') }}</h6>

        </div>

    </div>

    {{-- name --}}
    <div class="form-group ml-2 col-sm-7">
        <div class="rowInput">

            <div class="en col-sm-9">
                <label class="col-sm-6 col-form-label"{{ __('team.Nenglish') }}</label>

                <input type="text" name='team[en][name]' class="form-control {{$errors->first('team.$index.name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $team->name}}" id="name">
                <input type="text" name='team[en][local]' value='en' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('team.en.name') }}
                </div>
            </div>

            <div class="ar col-sm-9">
                <label class="col-sm-6 col-form-label">{{ __('team.Narabic') }}</label>

                <input type="text" name='team[ar][name]' class="form-control {{$errors->first('team.$index.name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $team->name}}" id="name">
                <input type="text" name='team[ar][local]' value='ar' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('team.ar.name') }}
                </div>
            </div>

            <select class="form-control col-sm-2 selectLang" id="selectLang">
                @foreach(config('app.languages') as $index => $lang)
                <option id="lang">{{ $lang }}</option>
                @endforeach
            </select>

        </div>
    </div>

    {{-- position --}}
    <div class="form-group ml-2 col-sm-7">
        <div class="rowInput">

            <div class="en col-sm-9">
                <label class="col-sm-6 col-form-label"{{ __('team.Penglish') }}</label>

                <input type="text" name='team[en][position]' class="form-control {{$errors->first('position') ? "is-invalid" : "" }} " value="{{old('position') ? old('position') : $team->position}}" id="position" >
                <input type="text" name='team[en][local]' value='en' hidden>
                <div class="invalid-feedback">
                    {{ $errors->first('team.$index.position') }}
                </div>
            </div>

            <div class="ar col-sm-9">
                <label class="col-sm-6 col-form-label">{{ __('team.Parabic') }}</label>

                <input type="text" name='team[ar][position]' class="form-control {{$errors->first('position') ? "is-invalid" : "" }} " value="{{old('position') ? old('position') : $team->position}}" id="position">
                <input type="text" name='team[ar][local]' value='ar' hidden>
                <div class="invalid-feedback">
                    {{ $errors->first('team.$index.position') }}
                </div>
            </div>

            <select class="form-control col-sm-2 selectLang" id="selectLang">
                @foreach(config('app.languages') as $index => $lang)
                <option id="lang">{{ $lang }}</option>
                @endforeach
            </select>

        </div>
    </div>

    {{-- quote --}}
    <div class="form-group ml-2 col-sm-7">
        <div class="rowInput">

            <div class="en col-sm-9">
                <label class="col-sm-6 col-form-label"{{ __('team.Qenglish') }}</label>

                <input type="text" name='team[en][qoute]' class="form-control {{$errors->first('qoute') ? "is-invalid" : "" }} " value="{{old('qoute') ? old('linkedin') : $team->qoute}}" id="qoute">
                <input type="text" name='team[en][local]' value='en' hidden>
                <div class="invalid-feedback">
                    {{ $errors->first('team.$index.qoute') }}
                </div>
            </div>

            <div class="ar col-sm-9">
                <label class="col-sm-6 col-form-label">{{ __('team.Qarabic') }}</label>

                <input type="text" name='team[ar][qoute]' class="form-control {{$errors->first('qoute') ? "is-invalid" : "" }} " value="{{old('qoute') ? old('linkedin') : $team->qoute}}" id="qoute">
                <input type="text" name='team[ar][local]' value='ar' hidden>
                <div class="invalid-feedback">
                    {{ $errors->first('team.$index.qoute') }}
                </div>
            </div>

            <select class="form-control col-sm-2 selectLang" id="selectLang">
                @foreach(config('app.languages') as $index => $lang)
                <option id="lang">{{ $lang }}</option>
                @endforeach
            </select>

        </div>
    </div>

    {{-- twitter --}}
    <div class="form-group ml-4">

        <label for="twitter" class="col-sm-2 col-form-label">{{ __('team.twitter') }}</label>

        <div class="col-sm-7">

            <input type="text" name='twitter' class="form-control {{$errors->first('twitter') ? "is-invalid" : "" }} " value="{{old('twitter') ? old('twitter') : $team->twitter}}" id="twitter">

            <div class="invalid-feedback">
                {{ $errors->first('twitter') }}
            </div>

        </div>

    </div>

    {{-- facebook --}}
    <div class="form-group ml-4">

        <label for="facebook" class="col-sm-2 col-form-label">{{ __('team.facebook') }}</label>

        <div class="col-sm-7">

            <input type="text" name='facebook' class="form-control {{$errors->first('facebook') ? "is-invalid" : "" }} " value="{{old('facebook') ? old('facebook') : $team->facebook}}" id="facebook">

            <div class="invalid-feedback">
                {{ $errors->first('facebook') }}
            </div>

        </div>

    </div>

    {{-- instagram --}}
    <div class="form-group ml-4">

        <label for="instagram" class="col-sm-2 col-form-label">{{ __('team.instagram') }}</label>

        <div class="col-sm-7">

            <input type="text" name='instagram' class="form-control {{$errors->first('instagram') ? "is-invalid" : "" }} " value="{{old('instagram') ? old('instagram') : $team->instagram}}" id="instagram">

            <div class="invalid-feedback">
                {{ $errors->first('instagram') }}
            </div>

        </div>

    </div>

    {{-- linkedin --}}
    <div class="form-group ml-4">

        <label for="linkedin" class="col-sm-2 col-form-label">{{ __('team.linkedin') }}</label>

        <div class="col-sm-7">

            <input type="text" name='linkedin' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin') ? old('linkedin') : $team->linkedin}}" id="linkedin">

            <div class="invalid-feedback">
                {{ $errors->first('linkedin') }}
            </div>

        </div>

    </div>

      <div class="form-group ml-4">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">{{ __('team.update') }}</button>
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
        $(".selectLang").change(function() {
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
    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
      readURL(this);
  });
  //Function to show image before upload
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
  }
}
</script>

@endpush
