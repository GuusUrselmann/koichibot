@extends('layouts.admin.layout')

@section('content')
    <div class="content-block levellayout" id="levelAdd">
        <form id="levelAddForm" method="POST" action="" enctype="multipart/form-data" >
            @csrf
            <div class="block-header">
                <div class="block-title">
                    <input type="text" name="level_level" placeholder="level" value="{{$level_next}}">
                </div>
            </div>
            <div class="block-body">
                <div class="level-info">
                    <div class="list-title">
                        Info
                    </div>
                    <div class="list-items">
                        <table>
                            <tr>
                                <td>Experience</td>
                                <td><input type="text" name="level_experience" placeholder="experience"></td>
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
