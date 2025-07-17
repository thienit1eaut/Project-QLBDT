<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HỆ THỐNG ĐĂNG NHẬP</title>

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome.min.css') }}">

    <style type="text/css">
        .main-login {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            width: 100%;
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity));
        }
        #box-login {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        #login {
            width: 100%;
            max-width: 420px;
            margin: 15px;
            padding: 20px 40px;
            transform: translateY(-30px);
            border-radius: 8px;
            background: #ffffff;
            --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / .1), 0 2px 4px -2px rgb(0 0 0 / .1);
            --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color)
            --tw-shadow-color is not defined
            , 0 2px 4px -2px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }
        #login .logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #login .loginform {
            margin-top: 28px;
        }
        .loginform .control-input-group .input-prepend {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .loginform .control-input-group .input-prepend .add-on {
            display: inline-block;
            width: auto;
            height: 20px;
            min-width: 16px;
            padding: 4px 5px;
            font-size: 14px;
            font-weight: normal;
            line-height: 20px;
            text-align: center;
            text-shadow: rgb(255, 255, 255) 0px 1px 0px;
            border: 1px solid rgb(204, 204, 204);
            background-color: rgb(238, 238, 238);
        }
        .loginform .control-input-group .input-prepend .add-on {
            border-radius: 0px;
            padding: 10px;
            color: rgb(130, 130, 131);
            text-shadow: none;
            border: 1px solid rgb(221, 221, 221);
        }
        .loginform .control-input-group .input-prepend input {
            width: 100%;
            height: 38px;
            padding-left: 12px;
            border-radius: 0;
            border: 1px solid rgb(221, 221, 221);
        }
        .loginform .control-input-group .input-prepend input:focus-visible {
            border-color: rgb(99 102 241 / 1);
        }
        .loginform .control-input-group .login-extend {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .loginform .control-input-group .login-extend .forget-password {
            font-size: 13px;
            color: #009dd9;
        }
        .loginform .login-btn {
            width: 100%;
            padding: 11px;
            border-radius: 0px;
            font-size: 16px;
            color: rgb(255, 255, 255);
            text-shadow: none;
            font-weight: bold;
            cursor: pointer;
            border: 1px solid #009dd9;
            background-color: #009dd9;
        }
        .loginform .login-btn:hover {
            opacity: 0.8;
            color: rgb(255, 255, 255);
        }
    </style>
</head>
<body>
    <div class="main-login bg-gray-100">
        <form action="{{ route('login') }}" method="POST" id="form_login" accept-charset="UTF-8">
            @csrf
            <div id="box-login">
                <div id="login">
                    <div class="logo">
                        <img style="max-height: 70px;" src="{{ asset('assets/frontend/images/logo-eaut-1.png') }}" class="img-fluid" alt="" title="">
                    </div>
                    <div class="loginform">
                        
                        @if ($errors->any())
                            <div style="color: red;font-size:13px;">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="control-input-group">
                            <div class="input-prepend">
                                <span class="add-on"><i class="fas fa-user"></i></span>
                                <input name="login" type="text" maxlength="50" value="{{ old('login') }}" placeholder="Tên đăng nhập">
                            </div>
                        </div>
                        <div class="control-input-group" style="margin-bottom: 10px;">
                            <div class="input-prepend">
                                <span class="add-on"><i class="fas fa-key"></i></span>
                                <input name="password" type="password" id="cphMain_ctl00_password" placeholder="Mật khẩu">
                            </div>
                            <div class="login-extend">
                                <div class="block-hint pull-left">
                                    <!-- <span class="Normal"><input id="cphMain_ctl00_RememberCheckbox" type="checkbox" name=""><label for="cphMain_ctl00_RememberCheckbox">Nhớ mật khẩu</label></span> -->
                                </div>
                                <div class="block-hint pull-right">
                                    <a href="#" class="forget-password">Quên mật khẩu?</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" id="cphMain_ctl00_Btn_Login" class="btn btn-block login-btn" title="Đăng nhập">Đăng nhập</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>