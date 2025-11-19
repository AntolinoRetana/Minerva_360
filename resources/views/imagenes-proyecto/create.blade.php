<form method="POST" action="{{ route('imagenes-proyecto.store') }}" enctype="multipart/form-data">
    @csrf

    @include('imagenes-proyecto.form')

</form>

