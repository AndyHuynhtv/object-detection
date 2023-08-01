@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- @if(session::has('errorLogin'))
    <div class = "alert alert-danger">
        {{session::get('errorLogin')}}
    </div>
@endif --}}
