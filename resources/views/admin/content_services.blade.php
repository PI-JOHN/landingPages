<div style="margin: 0px 50px 0px 50px;">

    @if($services)


        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>№ п/п</th>
                <th>Имя</th>
                <th>Текст</th>
                <th>Дата создания</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $k => $service)

                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{!! Html::link(route('serviceEdit',['service'=>$service->id]),$service->name,['alt'=>$service->name]) !!}</td>
                    <td>{{ $service->text }}</td>
                    <td>{{ $service->created_at }}</td>
                    <td>
                        {!! Form::open(['url'=>route('serviceEdit',['service'=>$service->id]), 'class' => 'form-horizontal','method' => 'POST']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>

            @endforeach
            </tbody>
        </table>
    @endif

    {!! Html::link(route('serviceAdd'),'Новая страница') !!}
</div>
