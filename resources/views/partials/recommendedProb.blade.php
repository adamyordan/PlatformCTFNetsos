<table class="ui table">
    <thead>
        <tr>
            <th>#</th>
            <th>task name</th>
            <th>total solve</th>
            <th>score</th>
        </tr>
    </thead>
    <tbody>
        <?php $cnt=1; ?>
        @foreach ($data as $row)
        <tr>
            <td>{{$cnt++}}</td>
            <td>
                <a href="{{ url('contest/' . $contest->id . '/task/' . $task->id ) }}">
                    {{$row->title}}
                </a>
            </td>
            <td>{{count($row->getSolver($contest))}}</td>
            <td>{{$row->pivot->points}}</td>
                                
        </tr>
        @endforeach
    </tbody>
</table>