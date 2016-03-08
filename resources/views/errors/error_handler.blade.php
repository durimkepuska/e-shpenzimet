@if ($errors->any())
  <br>  <div class="alert alert-danger"
        <strong>Njoftim!</strong><br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif
