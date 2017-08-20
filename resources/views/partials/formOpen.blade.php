dd({{ $action }})
{!! Form::open(['url' => $url,

$action =='crear'? 'POST' : $action == 'editar'? 'PUT' : 'DELETE'

]) !!}
