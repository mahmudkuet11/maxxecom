@if(session('msg'))
<div class="alert alert-dismissible alert-{{ session('status') == 'success' ? 'success' : 'danger' }}">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('msg') }}
</div>
@endif