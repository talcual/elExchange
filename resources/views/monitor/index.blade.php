@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Monitor') }}  <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addMonitor">Agregar</button></div>

                <div class="card-body">
                    <div class="row">
                        {{ session('response') }}
                    </div>

                    <div class="row">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Currency Monitor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monitors as $monitor)
                                    <tr>
                                        <td>{{$monitor->id}}</td>
                                        <td>{{$monitor->currency}}</td>
                                        <td><a href="/delete/{{$monitor->id}}" class="btn btn-dark">X</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="addMonitor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Monitor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/create_monitor" name="addmonit">
            @csrf
            <p>
                Se va a monitorear la siguiente moneda
            </p>
            <div class="mb-3">
                <label for="moneda" class="form-label">Moneda</label>
                <select name="moneda" class="form-control">
                    <option>Seleccionar Moneda</option>
                    @foreach($currencies as $row)
                        <option value="{{$row->currency}}">{{ $row->currency }}</option>
                    @endforeach
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" rel="guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.querySelector('button[rel=guardar]').onclick = () => {
        alert('Opa gangna style');
        document.querySelector('form[name=addmonit]').submit()
    }
</script>


@endsection
