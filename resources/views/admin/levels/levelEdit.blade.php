@extends('layouts.admin.layout')

@section('content')
    <div class="content-block levellayout" id="levelEdit">
        <form id="levelEditForm" method="POST" action="" enctype="multipart/form-data" >
            @csrf
            <div class="block-header">
                <div class="block-title">
                    {{$level->level}}
                </div>
            </div>
            <div class="block-body">
                <div class="level-info">
                    <div class="list-title">
                        Data
                    </div>
                    <div class="list-items">
                        <table>
                            <tr>
                                <td>Experience</td>
                                <td><input type="text" name="level_experience" value="{{$level->experience}}"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="button-submit">
                <button class="submit" type="submit" name="task_submit">
                    SAVE
                </button>
            </div>
        </form>
    </div>
@endsection
