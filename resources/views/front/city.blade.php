                                        <option value="">Select City</option>
                                         @foreach($zones as $c)
                                         @if(Auth::check())
                                         
                                          <option  value="{{$c->name}}">{{$c->name }} </option> 
                                          <!--<option  value="{{$c->name}}" {{ Auth::user()->city == $c->name ? 'selected' : '' }}>{{$c->name }}  </option> -->
                                          @else
                                          <option  value="{{$c->name}}">{{$c->name }} </option> 
                                          @endif
                                        @endforeach