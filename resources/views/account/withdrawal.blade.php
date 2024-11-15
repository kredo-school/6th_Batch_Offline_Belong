@extends('layouts.app')     

@section('content')

<div class="container-fluid" style="position: relative; height: 100vh; padding: 0;">
    <img src="{{ asset('images/background.jpg') }}" alt="homeimage" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="col-md-4 bg-white p-3 rounded">
            <h1 class="text-center" style="font-size: 36px;">Withdrawal</h1>
            <hr>
            
            <!-- Name Entry Field -->
            <div class="form-group text-center">
                <p><h5>Are you sure you want to withdrawal?</h5></p>  
                <p><h5>※We will stop the payments starting next month.</h5></p>                
            </div>
            <br>

            <!-- ユーザー削除フォーム -->
            <form action="{{ route('account.destroy', ['id' => Auth::id()]) }}" method="POST">
                @csrf
                @method('DELETE')  <!-- DELETEメソッドを使用 -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('account.show', ['id' => Auth::id()]) }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-danger">Withdrawal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
