<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <style>
    .app-container {
        height: 100vh;
        width: 100%;
    }

    .complete {
        text-decoration: line-through;
    }
    </style>
</head>

<body>
    <div class="app-container d-flex align-items-center justify-content-center flex-column" ng-app="myApp"
        ng-controller="myController">
        <h3 class="mb-4">Klasemen Liga</h3>
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
        @endif
        <div class="d-flex align-items-center mb-3">
            <div class="form-group mr-3 mb-0">
                <form action="/match/store" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <select name="club1_id" class="form-control" id="taskDropdown1">
                                <option value="" disabled selected>Pilih Club 1</option>
                                @foreach($clubs as $club)
                                <option value="{{$club['id']}}">{{$club['name']}} - {{$club['city']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select name="club2_id" class="form-control" id="taskDropdown2">
                                <option value="" disabled selected>Pilih Club 2</option>
                                @foreach($clubs as $club)
                                <option value="{{$club['id']}}">{{$club['name']}} - {{$club['city']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input name="score1" type="number" class="form-control" id="formGroupExampleInput1"
                                placeholder="Masukkan Score Club 1" required>
                        </div>
                        <div class="col">
                            <input name="score2" type="number" class="form-control" id="formGroupExampleInput2"
                                placeholder="Masukkan Score Club 2" required>
                        </div>
                    </div>
                    <input name="count" type="hidden" value="1">
            </div>
            <button type="submit" class="btn btn-primary mr-3">
                Save
            </button>
            </form>

            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                Tambah Club
            </button>
        </div>

        <div class="table-wrapper">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Club</th>
                        <th>Main</th>
                        <th>Menang</th>
                        <th>Seri</th>
                        <th>Kalah</th>
                        <th>Gol Menang</th>
                        <th>Gol Kalah</th>
                        <th>Poin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($standings as $standing)
                    <tr>
                        <td>{{ $standing['rank'] }}</td>
                        <td>{{ $standing['club'] }}</td>
                        <td>{{ $standing['played'] }}</td>
                        <td>{{ $standing['won'] }}</td>
                        <td>{{ $standing['drawn'] }}</td>
                        <td>{{ $standing['lost'] }}</td>
                        <td>{{ $standing['goals_for'] }}</td>
                        <td>{{ $standing['goals_against'] }}</td>
                        <td>{{ $standing['points'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Club</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/club/store" method="post">
                        @csrf

                        <label for="name">Club Name</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                        @error('name')
                        <div>{{ $message }}</div>
                        @enderror

                        <br>

                        <label for="city">City</label>
                        <input class="form-control" type="text" id="city" name="city" required>
                        @error('city')
                        <div>{{ $message }}</div>
                        @enderror

                        <br>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    var app = angular.module("myApp", []);
    app.controller("myController", function($scope, $http) {
        $http.get('/')
            .then(function(response) {
                $scope.standings = response.data;
            })
            .catch(function(error) {
                console.error('Error fetching klasemen:', error);
            });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>