@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-white">
                    <div class="card-header">Update Thought</div>

                    <div class="card-body">
                        <form action="{{ route('thoughts.update', $thought->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="content">Thought Content:</label>
                                <textarea class="bg-dark text-white form-control mb-3 @error('content') is-invalid @enderror" id="content" name="content" rows="3" maxlength="280" style="resize: none;">{{ old('content', $thought->content) }}</textarea>                                @error('content')
                                <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Thought</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
