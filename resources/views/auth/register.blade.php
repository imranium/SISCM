@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_role" class="col-md-4 col-form-label text-md-end">Register As</label>
                            <div class="col-md-6">
                                <select name="user_role" id="user_role" class="form-control" required>
                                    <option value="3">Student</option>
                                    <option value="2">Lecturer</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3" id="studentFields" style="display:none;">
                            <label for="student_id" class="col-md-4 col-form-label text-md-end">Student ID</label>
                            <div class="col-md-6">
                                <input type="text" name="student_id" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3" id="lecturerFields" style="display:none;">
                            <label for="staff_id" class="col-md-4 col-form-label text-md-end">Staff ID</label>
                            <div class="col-md-6">
                                <input type="text" name="staff_id" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('user_role').addEventListener('change', function () {
    document.getElementById('studentFields').style.display = this.value == 3 ? 'flex' : 'none';
    document.getElementById('lecturerFields').style.display = this.value == 2 ? 'flex' : 'none';

    if (this.value == 3) {
        document.getElementById('studentFields').classList.add('row', 'mb-3');
        document.getElementById('studentFields').querySelector('input').classList.add('form-control');
    } else {
        document.getElementById('studentFields').classList.remove('row', 'mb-3');
        if(document.getElementById('studentFields').querySelector('input')){
             document.getElementById('studentFields').querySelector('input').classList.remove('form-control');
        }

    }

    if (this.value == 2) {
        document.getElementById('lecturerFields').classList.add('row', 'mb-3');
        document.getElementById('lecturerFields').querySelector('input').classList.add('form-control');
    } else {
        document.getElementById('lecturerFields').classList.remove('row', 'mb-3');
         if(document.getElementById('lecturerFields').querySelector('input')){
             document.getElementById('lecturerFields').querySelector('input').classList.remove('form-control');
        }
    }
});
</script>
@endsection
