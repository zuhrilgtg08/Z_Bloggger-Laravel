@extends('layouts.dashboard.main', ['sbActive' => 'admin.dashboard'])
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>   
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-folder"></i> Data Postingan <span class="float-end">({{ $posts->count()}})</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('dashboard.posts.index') }}">Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        @if (auth()->user()->is_admin == true)
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body"><i class="fa-solid fa-users"></i> Data Users <span class="float-end">({{ $users->count() }})</span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('dashboard.users.index') }}">Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @else 
            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body"><i class="fa-solid fa-trash"></i> Post Trashed <span class="float-end">({{ $trashed->count()}})</span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('dashboard.trashed.index') }}">Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-comment"></i> Data Rating <span class="float-end">({{ $ratings->count()}})</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('dashboard.ratings.index') }}">Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-bookmark"></i> Data Bookmark <span class="float-end">({{ $bookmarks->count()}})</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('dashboard.bookmarks.index') }}">Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    All Data 1
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    All Data 2
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var ctx = document.getElementById("myAreaChart");
        var data = {{ Js::from($result1) }}
        var myLineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Bookmarks", "Ratings", "Posts"],
                datasets: [
                    {
                        label: "Count",
                        lineTension: 0.3,
                        backgroundColor: "rgb(241, 90, 14)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: data
                    },
                ],
            },
        });
    </script>

    <script type="text/javascript">
        var ctx = document.getElementById("myBarChart");
        var data = {{ Js::from($result2) }}
        var myLineChart = new Chart(ctx, {
        type: 'bar',
            data: {
                labels: ["Users", "Categories", "Posts Trashed"],
                datasets: [{
                    label: "Count",
                    backgroundColor: "rgb(232, 23, 147)",
                    data: data,
                }],
            },
        });
    </script>
@endsection