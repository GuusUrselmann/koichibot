@extends('layouts.admin.layout')

@section('content')
    <div class="content-block userlayout" id="userAdd" class="userlayout">
        <form id="userAddForm" method="POST" action="" enctype="multipart/form-data" >
            @csrf
            <div class="block-header">
                <div class="block-title">
                    <input type="text" name="user_username" placeholder="discordname#1234">
                </div>
            </div>
            <div class="block-body">
                <div class="user-profile">
                    <div class="profile-level">
                        LVL <input id="level" type="text" name="user_level" value="1">
                    </div>
                    <div class="userskin-name">
                        <div class="form-select" id="userSkin">
                            <input class="select-input" type=hidden name="user_userskin_id" value="{{$userskinDefault->id}}">
                            <div class="select-current">
                                {{$userskinDefault->name}}
                            </div>
                            <ul class="select-list">
                                <li data-image="{{asset('images/'.$userskinDefault->image)}}" data-id="{{$userskinDefault->id}}"><div class="item-image background-cover" style="background-image: url({{asset('images/'.$userskinDefault->image)}})"></div>{{$userskinDefault->name}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="profile-userskin">
                        <canvas id="progressChart" width="220" height="220"></canvas>
                        <div class="userskin-shadow">
                        </div>
                        <div id="skin" class="userskin-inner background-cover" style="background-image: url({{asset('images/'.$userskinDefault->image)}})">
                        </div>
                    </div>
                    <div class="profile-experience">
                        <input id="levelExpMin" type="text" name="user_experience" value="0"> / <span id="levelExpMax">50</span> Exp
                    </div>
                    <div class="user-info">
                        <div class="list-title">
                            Info
                        </div>
                        <div class="list-items">
                            <table>
                                <tr class="password">
                                    <td>Password</td>
                                    <td><input type="password" name="user_password" placeholder="password"><div class="password-toggle"><i class="fas fa-eye-slash"></i></div></td>
                                </tr>
                                <tr>
                                    <td>Discord ID</td>
                                    <td><input class="wideInput" type="text" name="user_discord_id" placeholder="1234567890"></td>
                                </tr>
                                <tr>
                                    <td>Userlevel</td>
                                    <td>
                                        <div class="form-select">
                                            <input class="select-input" type=hidden name="user_userlevel" value="member">
                                            <div class="select-current">
                                                member
                                            </div>
                                            <ul class="select-list">
                                                <li data-id="member">member</li>
                                                <li data-id="admin">admin</li>
                                                <li data-id="owner">owner</li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Money</td>
                                    <td><input type="text" name="user_money" value="0"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="user-stats">
                    <div class="stats-list">
                        <div class="list-title">
                            Stand
                        </div>
                        <div class="list-body">
                            <div class="stand" id="userStand">
                                <div class="form-select">
                                    <input class="select-input" type=hidden name="user_stand_id" value="">
                                    <div class="select-current">
                                        No stand
                                    </div>
                                    <ul class="select-list">
                                        <li data-id="">No stand</li>
                                        @foreach($stands as $stand)
                                            <li data-id="{{$stand->id}}"><div class="item-image background-cover" style="background-image: url({{asset('images/'.$stand->image)}})"></div>{{$stand->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div id="standStats" class="list-items">
                                <table>
                                    <tr>
                                        <td>Power</td>
                                        <td><input type="text" name="user_power" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Speed</td>
                                        <td><input type="text" name="user_speed" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Range</td>
                                        <td><input type="text" name="user_range" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Durability</td>
                                        <td><input type="text" name="user_durability" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Precision</td>
                                        <td><input type="text" name="user_precision" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Potential</td>
                                        <td><input type="text" name="user_potential" value=""></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="stats-list">
                        <div class="list-title">
                            Stats
                        </div>
                        <div class="list-body">
                            <div class="list-items">
                                <table>
                                    <tr>
                                        <td>Health</td>
                                        <td><input type="text" name="user_health" value="10"></td>
                                    </tr>
                                    <tr>
                                        <td>Power MIN</td>
                                        <td><input type="text" name="user_power_min" value="10"></td>
                                    </tr>
                                    <tr>
                                        <td>Power MAX</td>
                                        <td><input type="text" name="user_power_max" value="20"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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

    <div class="content-block" id="userUnlocks">
        <div class="block-header">
            <div class="block-title">
                Unlocks
            </div>
        </div>
        <div class="block-body">
            <div class="unlocks">
                <div class="unlock">
                    <input class="unlock-input" form="userAddForm" type="hidden" name="user_unlocks_userskins" value="{{$userskinDefault->id}}">
                    <div class="unlock-title">
                        User skins<span class="unlock-add"><i class="fa fas far fal fab fa-plus"></i></span>
                        <div class="add-list">
                            <ul>
                                @forelse($userskins as $userskin)
                                    <li data-id="{{$userskin->id}}" data-image="{{asset('images/'.$userskin->image)}}" class="selectable {{$userskinDefault->id == $userskin->id ? 'hidden' : ''}}">
                                        <div class="unlock-image background-cover" style="background-image: url({{asset('images/'.$userskin->image)}})"></div>
                                        <span class="unlock-name">{{$userskin->name}}</span>
                                    </li>
                                @empty
                                    <li class="empty">No user skins found</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="unlock-list">
                        <ul>
                            <li data-id="{{$userskinDefault->id}}" class="selectable"><div class="unlock-image background-cover" style="background-image: url({{asset('images/'.$userskinDefault->image)}})"></div><span class="unlock-name">{{$userskinDefault->name}}</span><span class="unlock-remove"><i class="fa fas far fal fab fa-times"></i></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    var ctx = $('#progressChart');
    var progressChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [0, 100],
                backgroundColor: [
                    'rgba(234, 39, 144, .8)',
                    'rgba(45, 45, 45, .8)'
                ]
            }]
        },
        options: {
            animation: false,
            legend: {display: false},
            tooltips: {enabled: false},
            hover: {mode: null},
            elements: {
                center: {
                    text: '1',
                    color: '#36A2EB',
                    fontStyle: 'Helvetica',
                    sidePadding: 15
                },
                arc: {
                    borderWidth: 0
                }
            },
            cutoutPercentage: 80,
            responsive: false,
            maintainAspectRatio: true,
            showScale: false
        }
    });
    </script>
@endsection
