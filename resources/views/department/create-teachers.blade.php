
<hr>
<div>
    @if($errors->any())
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
</div>
<div>
    {{session('Success')?session('Success'):''}}
</div>
CREATE TEACHER EXCEL
<form method="POST" enctype="multipart/form-data">
    @csrf
    EXCEL FILE<input type="file" name="excel">
    <button type="submit">CREATE TEACHER</button>
</form>