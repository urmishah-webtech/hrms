<h4>Hello, {{$name}}</h4>
<p>Follow this link to change your password:</p>
<a href="{{request()->getSchemeAndHttpHost()}}/resetnewpassword/{{$id}}/{{$token}}">Click here...</a>