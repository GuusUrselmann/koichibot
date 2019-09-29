@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="userEdit">
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="block-header">
                <div class="block-title">
                    <input type="text" name="user_username" value="{{$user->username}}">
                </div>
            </div>
            <div class="block-body">
                <div class="user-profile">
                    <div class="profile-level">
                        LVL {{$user->level()->level}}
                    </div>
                    <div class="userskin-name">
                        {{$user->userskin()->name}}
                    </div>
                    <div class="profile-userskin">
                        <canvas id="progressChart" width="220" height="220"></canvas>
                        <div class="userskin-shadow">
                        </div>
                        <div class="userskin-inner background-cover" style="background-image: url({{asset('images/'.$user->userskin()->image)}})">
                        </div>
                    </div>
                    <div class="profile-experience">
                        {{$user->experience}} / {{$user->level(1)->experience}} Exp
                    </div>
                </div>
                <div class="user-stats">
                    <div class="stats-list">
                        <div class="list-title">
                            Stand
                        </div>
                        <div class="list-body">
                            <div class="stand" id="userStand">
                                <input id="userStandId" type=hidden name="user_stand_id" value="{{$user->stand_id}}">
                                <div class="form-select">
                                    <div class="select-current">
                                        {{$user->stand_id ? $user->stand()->name : 'No stand'}}
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

    <div class="content-block" id="userLogs">
        <div class="block-header">
            <div class="block-title">
                Logs
            </div>
        </div>
        <div class="block-body">
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
