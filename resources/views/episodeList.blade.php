<div class="episode-list">
    @foreach($episodes as $episode)
        <div class="episode">
            <h3>#{{$episode->number}} : {{$episode->title}}</h3>
            <p>{{$episode->summary}}</p>
            @if ($episode->filepath)
                <audio controls>
                    <source src="{{$episode->filepath}}">
                </audio>
            @endif
        </div>
    @endforeach
</div>