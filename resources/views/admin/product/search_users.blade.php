<select name="all_users[]" multiple required>
@foreach($users as $user)
<option value="{{$user->id}}">{{$user->name}}</option>
@endforeach
</select>