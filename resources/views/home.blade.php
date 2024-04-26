@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container py-4">
            <div class="row">
                <div class="col-3">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-3 bg-dark">
                            <ul class="nav nav-link-secondary flex-column gap-2">
                                <li class="nav-item">
                                    <a class="nav-link fw-bolder text-white" href="{{ route('index') }}">
                                        <span>All thoughts</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('liked') }}">
                                        <span>Liked thougts</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        @auth
                            <div class="mb-3 bg-da">
                                <form action="{{ route('thoughts.store') }}" method="post">
                                    @csrf
                                    <textarea class="form-control bg-dark text-white" id="thought" name="content"
                                              rows="3"
                                              maxlength="280" style="resize: none;"></textarea>
                                    <div class="">
                                        <button type="submit" class="btn mt-3 btn-primary ml-auto"> Post</button>
                                    </div>
                                </form>
                            </div>
                        @endauth
                        <hr>
                        <div class="mt-3">
                            @foreach ($thoughts as $thought)
                                <div class="card bg-dark text-white mb-3">
                                    <div class="px-3 pt-4 pb-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="card-title mb-0">{{ $thought->user->name }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="fs-6 fw-light text-white">
                                            {{ $thought->content }}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            @auth
                                            <div>
                                                @if(!$thought->isLikedBy(auth()->user()))
                                                    <form action="{{ route('thoughts.like', $thought->id) }}"
                                                          method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary btn-sm">Like
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('thoughts.dislike', $thought->id) }}"
                                                          method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Unlike
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            @endauth
                                            <div>
                                                <span class="fas fa-heart me-1"></span> {{ $thought->likes }} likes
                                            </div>
                                            <div>
                                                <span class="fs-6 fw-light ">
                                                    <span class="fas fa-clock text-white"></span> {{ $thought->created_at }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        @if(Auth::id() == $thought->user_id)
                                            <div class="position-absolute mt-3 mx-3 top-0 end-0">
                                                <a href="{{ route('thoughts.edit', $thought->id) }}"
                                                   class="btn btn-warning">Edit</a>
                                                <form action="{{ route('thoughts.destroy', $thought->id) }}"
                                                      method="POST" style="display: inline;"
                                                      id="delete-form-{{ $thought->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <form action="{{ route('index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <input name="search" placeholder="..." class="form-control bg-dark text-white" type="text">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
