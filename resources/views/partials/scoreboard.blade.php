<table class="ui table">
    <thead>
        <tr>
            <th>#</th>
            <th>username</th>
            <th>points</th>
            @if(isset($useLatestSubmit) && $useLatestSubmit)
                <th>latest submit</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{$row->final_position}}</td>
            <td><a href="{{ url('/user/' . $row->user->id) }}">{{$row->user->username}}</a></td>
            <td>{{$row->final_points}}</td>
            @if(isset($useLatestSubmit) && $useLatestSubmit)
                @if(isset($row->final_latest_submit))
                    <td><time title="{{$row->final_latest_submit}}">{{Carbon\Carbon::parse($row->final_latest_submit)->diffForHumans()}}</time></td>
                @else
                    <td>-</td>
                @endif
            @endif
        </tr>
        @endforeach
    </tbody>
</table>