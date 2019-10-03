@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="stands">
        <div class="block-header">
            <div class="block-title">Stands</div>
        </div>
        <div class="block-body">
            <div class="stands-header">
                Standard
            </div>
            <div class="stands-list">
                @forelse($stands as $stand)
                    <div class="stand-card">
                        <a href="#">
                            <div class="stand-inner">
                                <div class="stand-image background-cover" style="background-image: url({{asset('images/'.$stand->image)}})">
                                </div>
                                <div class="stand-name">
                                    {{$stand->name}}
                                </div>
                                <div class="stand-info">
                                    Active: {{$stand->active()}}
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
