@if (session('status'))
<div class="box-header">
    <h3 class="box-title text-green alert_thongbao">{{ session('status') }}</h3>
</div>
@endif