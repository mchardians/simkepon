<x-auth-layout title="Login">
    <x-slot name="styles">
        <style>
            @font-face {
                font-family: "FOT-Yuruka Std";
                src: url("{{ asset('assets/fonts/FOT-Yuruka Std/FOT-Yuruka Std.woff2') }}");
            }

            .bg-login-image {
                background: url('{{ asset('assets/img/background/bg-login-1.svg') }}') no-repeat;
                background-position: center;
                background-size: contain;
            }

            .bg-login-image::before {
                content: "Selamat Datang";
                display: block;
                font-family: "FOT-Yuruka Std";
                font-size: 2rem;
                text-align: center;
                color: #fff;
                margin-top: 1.25rem;
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <div class="container mt-md-5 mt-lg-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-12 col-lg-10">
                    <div class="card card-primary overflow-hidden shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-6 col-lg-7 d-none d-md-block d-lg-block bg-login-image bg-primary">
                                </div>
                                <div class="col-md-6 col-lg-5">
                                    <div class="p-4 m-3">
                                        <img src="{{ asset('assets/img/simkepon.svg') }}" alt="logo" width="285"
                                            class="mb-3 mt-2">

                                        @error('userInvalid')
                                            <div class="alert alert-danger alert-dismissible show fade">
                                                <div class="alert-body">
                                                    <button class="close" data-dismiss="alert">
                                                        <span>&times;</span>
                                                    </button>
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                        
                                        <form method="POST" action="{{ route('authenticate') }}" autocomplete="off">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" tabindex="1" value="{{ old('email') }}" autofocus>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="password" class="control-label">Password</label>
                                                    {{-- <div class="float-right">
                                                    <a href="{{ route('auth.forgot-password') }}" class="text-small">
                                                      Forgot Password?
                                                    </a>
                                                  </div> --}}
                                                </div>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" tabindex="2">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="remember" class="custom-control-input"
                                                        tabindex="3" id="remember-me">
                                                    <label class="custom-control-label" for="remember-me">Remember
                                                        Me</label>
                                                </div>
                                            </div> --}}

                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary btn-lg btn-icon icon-right btn-block"
                                                    tabindex="4">
                                                    Login
                                                </button>
                                            </div>
                                        </form>
                                        <div class="text-center mt-5 text-small">
                                            Copyright &copy; {{ now()->format('Y') }}. Made with 💙 by <a
                                                href="https://github.com/mchardians" target="_blank">mchardians</a>
                                            <div class="mt-2">
                                                <a href="https://github.com/mchardians/simkepon">Repository</a>
                                                <div class="bullet"></div>
                                                <a
                                                    href="https://github.com/mchardians/simkepon/blob/main/LICENSE">License</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-auth-layout>
