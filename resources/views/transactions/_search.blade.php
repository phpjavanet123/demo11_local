<div class="card uper search-form">
    <div class="card-header">Search Filter</div>
    <div class="card-body">
        <form method="get" action="{{ route('transactions.index') }}/">
            <div class="row">
                <div class='col-sm-3'>
                    <div class="form-group">
                        <label for="date_from">From:</label>
                        <div class='input-group date'>
                            <input type='text' class="form-control" name="date_from" value="{{\Request::get('date_from')}}"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    <div class="form-group">
                        <label for="date_to">To:</label>
                        <div class='input-group date'>
                            <input type='text' class="form-control" name="date_to" value="{{\Request::get('date_to')}}"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-3'>
                    <div class="form-group">
                        <label for="user_id">Users:</label>
                        <select class="form-control" name="user_id">
                            @foreach($users as $user)
                                @if (\Request::get('user_id') == $user->id)
                                    <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                @else
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>
