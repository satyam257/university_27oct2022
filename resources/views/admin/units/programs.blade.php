@extends('admin.layout')
@section('section')
<div class="py-3">
    <table class="table">
        <thead>
            <th>S/N</th>
            <th>Program</th>
            <th></th>
        </thead>
        <tbody>
            @php($k = 1)
            @foreach($programs as $program)
            <tr>
                <td>{{$k++}}</td>
                <td>{{$program->name}}</td>
                <td>
                    <a href="{{route('admin.programs.levels', [$program->id])}}" class="btn btn-sm btn-primary">{{__('text.word_levels')}}</a> | 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection