@extends('layouts.admin.layout')

@section('content')
    <div class="content-block userlayout" id="userEdit">
        <form id="userEditForm" method="POST" action="" enctype="multipart/form-data" >
            @csrf
            <div class="block-header">
                <div class="block-title">
                    <input type="text" name="user_username" value="{{$user->username}}">
                </div>
            </div>
            <div class="block-body">
                <div class="user-profile">
                    <div class="profile-level">
                        LVL <input id="level" type="text" name="user_level" value="{{$user->level()->level ? $user->level()->level : ''}}">
                    </div>
                    <div class="userskin-name">
                        <div class="form-select" id="userSkin">
                            <input class="select-input" type=hidden name="user_userskin_id" value="{{$user->userskin_id}}">
                            <div class="select-current">
                                {{$user->userskin->name}}
                            </div>
                            <ul class="select-list">
                                @foreach($userskins_unlocked as $userskin)
                                    <li data-image="{{asset('images/'.$userskin->image)}}" data-id="{{$userskin->id}}"><div class="item-image background-cover" style="background-image: url({{asset('images/'.$userskin->image)}})"></div>{{$userskin->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="profile-userskin">
                        <canvas id="progressChart" width="220" height="220"></canvas>
                        <div class="userskin-shadow">
                        </div>
                        <div id="skin" class="userskin-inner background-cover" style="background-image: url({{asset('images/'.$user->userskin->image)}})">
                        </div>
                    </div>
                    <div class="profile-experience">
                        <input id="levelExpMin" type="text" name="user_experience" value="{{$user->experience}}"> / <span id="levelExpMax">{{$user->level(1)->experience}}</span> Exp
                    </div>
                    <div class="user-info">
                        <div class="list-title">
                            Info
                        </div>
                        <div class="list-items">
                            <table>
                                <tr class="password">
                                    <td>Password</td>
                                    <td><input type="password" name="user_password" placeholder="new password"><div class="password-toggle"><i class="fas fa-eye"></i></div></td>
                                </tr>
                                <tr>
                                    <td>Discord ID</td>
                                    <td><input class="wideInput" type="text" name="user_discord_id" value="{{$user->discord_id}}"></td>
                                </tr>
                                <tr>
                                    <td>Userlevel</td>
                                    <td>
                                        <div class="form-select">
                                            <input class="select-input" type=hidden name="user_userlevel" value="{{$user->userlevel}}">
                                            <div class="select-current">
                                                {{$user->userlevel}}
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
                                    <td><input type="text" name="user_money" value="{{$user->money}}"></td>
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
                                    <input class="select-input" type=hidden name="user_stand_id" value="{{$user->stand_id}}">
                                    <div class="select-current">
                                        {{$user->stand_id ? $user->stand->name : 'No stand'}}
                                    </div>
                                    <ul class="select-list">
                                        <li data-id="">No stand</li>
                                        @foreach($stands as $stand)
                                            <li data-id="{{$stand->id}}"><div class="item-image background-cover" style="background-image: url({{asset('images/'.$stand->image)}})"></div>{{$stand->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div id="standStats" class="list-items {{$user->stand_id ? 'toggled' : ''}}">
                                <table>
                                    <tr>
                                        <td>Power</td>
                                        <td><input type="text" name="user_power" value="{{$user->power ? $user->power : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Speed</td>
                                        <td><input type="text" name="user_speed" value="{{$user->speed ? $user->speed : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Range</td>
                                        <td><input type="text" name="user_range" value="{{$user->range ? $user->range : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Durability</td>
                                        <td><input type="text" name="user_durability" value="{{$user->durability ? $user->durability : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Precision</td>
                                        <td><input type="text" name="user_precision" value="{{$user->precision ? $user->precision : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Potential</td>
                                        <td><input type="text" name="user_potential" value="{{$user->potential ? $user->potential : ''}}"></td>
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
                                        <td><input type="text" name="user_health" value="{{$user->health ? $user->health : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Power MIN</td>
                                        <td><input type="text" name="user_power_min" value="{{$user->power_min ? $user->power_min : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Power MAX</td>
                                        <td><input type="text" name="user_power_max" value="{{$user->power_max ? $user->power_max : ''}}"></td>
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
                    <input class="unlock-input" form="userEditForm" type="hidden" name="user_unlocks_userskins" value="{{$user->unlocks_userskins}}">
                    <div class="unlock-title">
                        User skins<span class="unlock-add"><i class="fa fas far fal fab fa-plus"></i></span>
                        <div class="add-list">
                            <ul>
                                @forelse($userskins as $userskin)
                                    <li data-id="{{$userskin->id}}" data-image="{{asset('images/'.$userskin->image)}}" class="selectable {{$user->unlockedUserskin($userskin->id) ? 'hidden' : ''}}">
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
                            @forelse($userskins_unlocked as $userskin)
                                <li data-id="{{$userskin->id}}" class="selectable"><div class="unlock-image background-cover" style="background-image: url({{asset('images/'.$userskin->image)}})"></div><span class="unlock-name">{{$userskin->name}}</span><span class="unlock-remove"><i class="fa fas far fal fab fa-times"></i></span></li>
                            @empty
                                <li class="empty">No user skins unlocked</li>
                            @endforelse
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
                data: [{{$user->experience}}, {{$user->level(1)->experience - $user->experience}}],
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
