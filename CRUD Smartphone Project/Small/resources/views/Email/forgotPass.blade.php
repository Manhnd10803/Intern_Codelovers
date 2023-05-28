<div style="width=600px; margin: 0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{ $data['name'] }}</h2>
        <p>Email này giúp bạn lấy lại mật khẩu tài khoản bị quên</p>
        <p>Vui lòng click vào link bên dưới để đặt lại mật khẩu</p>
        <p><a href="{{ route('mat-khau-moi', ['id' => $data['id'], 'token' => $data['remember_token']] ) }}">Lấy lại mật khẩu</a></p>
    </div>
</div>