@extends('admin_panel.adminLayout')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('admin.students')}}">Students</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <H2>Teachers</H2> <H3>Musa</H3>
            </div>
        </div>
    </nav>
        <div class="content">
            <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">#####</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Nurlan Galymzhan</td>
                    <td>galymzhan@gmail.com</td>
                    <td>infoo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sakibaev Arman</td>
                    <td>arman@gmail.com</td>
                    <td>infoo</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Baxyt Azat</td>
                    <td>azat@gmail.com</td>
                    <td>infoo</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Amirov Abilay</td>
                    <td>abilay@gmail.com</td>
                    <td>infoo</td>
                </tr>

                </tbody>
            </table>
            </div>
        </div>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <H2>Teachers</H2> <H3>Azamat</H3>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">#####</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Muhtarxan Zhanarystan</td>
                    <td>zhanarystan@gmail.com</td>
                    <td>infoo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sultanova Akerke</td>
                    <td>akerke@gmail.com</td>
                    <td>infoo</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Akhiyat Sagyndyk</td>
                    <td>saqyndyk@gmail.com</td>
                    <td>infoo</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
