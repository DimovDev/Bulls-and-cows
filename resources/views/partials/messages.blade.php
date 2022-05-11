@if(session('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{session('error')}}</div>
@endif

<span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>

