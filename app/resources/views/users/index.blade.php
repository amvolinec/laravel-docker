@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <table class="table table-sm table-bordered">
                    <thead class="thead-dark">
                    <tr style="font-size: 11px">
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>

                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($users))
                        @foreach($users AS $user)
                            <tr>
                                <td>{{ $user["name"] }}</td>
                                <td>{{ $user["email"] }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info float-md-left" href="{{ route('user.edit', $user['id']) }}">Edit</a>
                                    <form class="form-add" method="POST"
                                          action="{{ route('user.destroy', $user['id']) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger float-md-right"
                                                onclick="return confirm('Are you sure?')">Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach()
                    @endif
                    </tbody>
                </table>

            </div>

            <div class="col-md-4">
                <form class="form-add" method="POST" action="{{ route('user.new') }}">
                    @csrf
                    <div class="form-row">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" value="{{ old("name")  }}" required>
                    </div>
                    <div class="form-row">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="text" name="email" value="{{ old("email")  }}" required>
                    </div>
                    <div class="form-row">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password">
                    </div>
                    <div class="form-row">
                        <label for="password-confirm">{{ __('Confirm') }}</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                               autocomplete="new-password">
                    </div>
                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-sm btn-outline-success"
                                onclick="return confirm('Are you sure?')">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection

