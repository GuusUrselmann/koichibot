@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="levels">
        <div class="block-header">
            <div class="block-title">Levels</div>
        </div>
        <div class="block-body">
            <div class="table platform levels" id="table-levels" data-ajax="false" data-ajaxPath="/admin/users/ajaxTableUsers">
                <div class="table-options">
                    <div class="table-search">
                        <input type="text" placeholder="search...">
                    </div>
                    <div class="table-amount">
                        <select>
                            <option value="10" selected>10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="table-add">
                        <div class="add-button">
                            <a href="{{url('/admin/levels/add')}}">
                                <div class="add-left">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="add-right">
                                    ADD
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-field">
                    <table cellpadding="0" cellspacing="0">
                        <tr class="table-header">
                            <th style="width: 70px;">level</th>
                            <th style="width: 70px;">actions</th>
                            <th style="width: 140px;">experience</th>

                        </tr>
                        @forelse($levels as $level)
                            <tr class="table-row">
                                <td class="level table-centered">{{$level->level}}</td>
                                <td class="actions"><a class="edit" href="{{url('/admin/levels/'.$level->level.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/levels/'.$level->level.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="experience">{{$level->experience}}</td>
                            </tr>
                        @empty
                            <tr class="table-empty">
                                <td></td>
                                <td></td>
                                <td class="table-empty-msg">
                                    No items found.
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <div class="table-pagination">
                    <div class="tablep-counter">
                    </div>
                    <div class="tablep-buttons">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
