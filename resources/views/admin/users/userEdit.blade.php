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
                <div class="user-header">
                    <div class="user-userskin">
                        <div class="userskin-inner background-cover" style="background-image: url({{asset('images/'.$user->userskin()->image)}})">
                        </div>
                        <div class="userskin-name">
                            {{$user->userskin()->name}}
                        </div>
                    </div>
                    <div class="user-progress">
                        <div class="progress-title">
                            LVL {{$user->level()->level}}
                        </div>
                        <div class="progress-level">
                            <div class="level-inner">
                                <canvas id="progressChart" width="150" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user-body">
                    <div class="user-stand user-infocard">
                        <div class="stand-title">
                            Stand
                        </div>
                        <div class="stand-info">
                            <div class="stand" id="userStand">
                                <input id="userStandId" type=hidden name="user_stand_id" value="{{$user->stand_id}}">
                                <div class="form-select">
                                    <div class="select-current">
                                        {{$user->stand_id ? $user->stand()->name : 'No stand'}}
                                    </div>
                                    <ul class="select-list">
                                        <li data-id="">No stand</li>
                                        @foreach($stands as $stand)
                                            <li data-id="{{$stand->id}}">{{$stand->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div id="standStats" class="stand-stats {{$user->stand_id ? 'toggled' : ''}}">
                                <table>
                                    <tr>
                                        <td>Power MIN</td>
                                        <td><input type="text" name="user_power_min" value="{{$user->power_min ? $user->power_min : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Power MAX</td>
                                        <td><input type="text" name="user_power_max" value="{{$user->power_max ? $user->power_max : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Health</td>
                                        <td><input type="text" name="user_health" value="{{$user->health ? $user->health : ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Speed</td>
                                        <td><input type="text" name="user_speed" value="{{$user->speed ? $user->speed : ''}}"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="user-stats user-infocard">
                        <div class="stats-title">
                            Stats
                        </div>
                        <div class="stats-list">
                            <table>
                                <tr>
                                    <td>Discord ID</td>
                                    <td><input class="longstat" type="text" name="user_discord_id" value="{{$user->discord_id ? $user->discord_id : ''}}"></td>
                                </tr>
                                <tr>
                                    <td>Money</td>
                                    <td><input type="text" name="user_money" value="{{$user->money}}"></td>
                                </tr>
                            </table>
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

    <script>
        var ctx = $('#progressChart');
        var progressChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [12, 19],
                    backgroundColor: [
                        'rgba(234, 39, 144, .8)',
                        'rgba(45, 45, 45, .8)'
                    ]
                }]
            },
            options: {
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
                cutoutPercentage: 75,
                responsive: false,
                maintainAspectRatio: true,
                showScale: false
            }
        });
    </script>
@endsection
