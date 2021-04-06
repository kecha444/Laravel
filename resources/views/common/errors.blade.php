@if(count($errors)>0)
<div class="w-100">
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&items;</button>
        <p><strong>Что-то пошло не так</strong></p>
        <p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </p>
    </div>
</div>
@endif