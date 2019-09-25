@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="users">
        <div class="block-header">
            <div class="block-title">Users</div>
        </div>
        <div class="block-body">
            <div class="table platform users" id="table-users" data-ajax="false" data-ajaxPath="/admin/users/ajaxTableUsers">
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
                            <a href="{{url('/admin/users/add')}}">
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
                            <th style="width: 70px;">id</th>
                            <th style="width: 70px;">actions</th>
                            <th style="width: 200px;">username</th>
                            <th style="width: 200px;">stand</th>
                            <th style="width: 200px;">joined since</th>
                            <th style="width: 100px;">user level</th>
                        </tr>
                        @forelse($users as $user)
                            <tr class="table-row">
                                <td class="id table-centered">{{$user->id}}</td>
                                <td class="actions"><a class="edit" href="{{url('/admin/users/'.$user->id.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/users/'.$user->id.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="username"><a href="{{url('/admin/users/'.$user->id.'/edit')}}">{{$user->username}}</a></td>
                                <td class="stand">{{$user->stand_id ? $user->stand()->name : '-'}}</td>
                                <td class="joined-since">{{$user->created_at}}</td>
                                <td class="user-level">{{$user->userlevel}}</td>
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
