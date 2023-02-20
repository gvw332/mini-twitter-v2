<h1>CCOUCOU</h1>

@foreach ($tweets as $tweet)

     {{ $tweet->user_id}}     
     {{ $tweet->name}}
     {{ $tweet->img}}      
     {{ $tweet->text }}
@endforeach

