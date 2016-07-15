<table class="table table-responsive" id="foods-table">
    <thead>
        <th>Name</th>
        <th>Category Id</th>
        <th>Content</th>
        <th>Image</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($foods as $food)
        <tr>
            <td>{!! $food->name !!}</td>
            <td>{!! $food->category_id !!}</td>
            <td>{!! $food->content !!}</td>
            <td>{!! $food->image !!}</td>
            <td>
                {!! Form::open(['route' => ['foods.destroy', $food->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('foods.show', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('foods.edit', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
