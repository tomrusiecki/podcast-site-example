@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Episodes</div>

                <div class="panel-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>#</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Summary</th>
                                <th>Author</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($episodes as $episode)
                                <tr>
                                    <td>{{$episode->getKey()}}</td>
                                    <td>{{$episode->number}}</td>
                                    <td>{{$episode->date}}</td>
                                    <td>{{$episode->title}}</td>
                                    <td>{{$episode->subtitle}}</td>
                                    <td>{{$episode->summary}}}</td>
                                    <td>{{$episode->author}}</td>
                                    <td>{{$episode->filepath}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Create New Episode</div>
                    <form action="{{url('admin')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group col-md-10">
                            <div class="control-label">Title</div>
                            <input class="form-control" type="text" name="title" placeholder="title" />
                        </div>
                        <div class="form-group col-md-10">
                            <div class="control-label">Subtitle</div>
                            <input class="form-control" type="text" name="subtitle" placeholder="subtitle" />
                        </div>
                        <div class="form-group col-md-10">
                            <div class="control-label">Summary</div>
                            <input class="form-control" type="text" name="summary" placeholder="A description of the episode" />
                        </div>
                        <div class="form-group col-md-4">
                            <div class="control-label">Author</div>
                            <input class="form-control" type="text" name="author" placeholder="Author's Name" />
                        </div>
                        <div class="form-group col-md-4">
                            <div class="control-label">Episode Number</div>
                            <input class="form-control" type="number" name="number" placeholder="Episode #" />
                        </div>
                        <div class="form-group col-md-4">
                            <div class="control-label">Episode Date</div>
                            <input class="form-control" type="date" name="date"/>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="control-label">File Upload</div>
                            <input class="form-control" type="file" name="podcast_file" />
                        </div>
                        <div class="form-group col-md-4">
                            <div class="control-label">&nbsp;</div>
                            <input class="form-control" type="submit" value="Create" />
                        </div>

                    </form>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
