@foreach($projects as $project)
<div class="col-md-4">
    <div class="case-item relative">
        <a href="{{url('du-an/'.$project->alias.'.html')}}" title="{{$project->name}}"><img src="{{ asset('upload/news/'.$project->photo) }}" alt="{{$project->name}}" title="{{$project->name}}"> </a>
        <div class="case-abs">
            <a href="{{url('du-an/'.$project->alias.'.html')}}" title="{{$project->name}}">
                <img src="{{asset('public/images/picture/zoom.png')}}" alt="{{$project->name}}" title="{{$project->name}}">
            </a>
            <p><a href="{{url('du-an/'.$project->alias.'.html')}}" title="{{$project->name}}">{{$project->name}}</a> </p>
        </div>
    </div>
</div>
@endforeach