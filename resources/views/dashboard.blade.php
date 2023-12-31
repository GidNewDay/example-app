
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/" target="_blank">Wiinkel</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
{{--            <a class="nav-link" href="#">Sign out</a>--}}
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ Auth::user()->name }},
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file"></span>
                            Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="users"></span>
                            Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="layers"></span>
                            Integrations
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Saved reports</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Current month
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Last quarter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Social engagement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Year-end sale
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Панель Администратора</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-outline-secondary">Share</button>
                        <button class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>

{{--            <canvas class="my-4" id="myChart" width="900" height="380"></canvas>--}}
            <div class="container">
                <h2 class="text-center">Добавление товара</h2>
                <br>
                <form action = "/create" method = "post" class="form-group" >

{{--                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">--}}
                    @csrf
                    <label class="form-group"> Name:</label>
                    <input type="text" class="form-control" placeholder=" Name" name="product_name">
                    <label>price:</label>
                    <input type="text" class="form-control" placeholder="price" name="price">
                    <label>size:</label>
                    <input type="text" class="form-control" placeholder="size" name="size">
                    <label>preview:</label>
                    <input type="text" class="form-control" placeholder="preview" name="preview">
                    <label>category:</label>
                    <select class="form-control" name="category_id">
                        <option value="1">jackets</option>
                        <option value="2">clothes</option>
                        <option value="3">t-shirts</option>
                    </select>
                    <label>description</label>
                    <textarea class="form-control" placeholder="description" name="description"></textarea>
                    <br>
                    <button type="submit"  value = "Add student" class="btn btn-primary">Добавить</button>
                </form>
            </div>
            <h2>Все товары</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Категория</th>
                        <th>Описание</th>
                        <th>Размеры</th>
                    </tr>
                    </thead>
                    <tbody>

{{--                    @foreach($products as $product)--}}
{{--                        <tr>--}}
{{--                            <td>{{$product['id']}}</td>--}}
{{--                            <td>{{$product['product_name']}}</td>--}}
{{--                            <td>{{$product['price']}}</td>--}}
{{--                            <td>{{$product['category']}}</td>--}}
{{--                            <td>{{$product['description']}}</td>--}}
{{--                            <td>{{$product['size']}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}

                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

@section('script')
<!-- Bootstrap core JavaScript
================================================== -->
<<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>


@endsection
</body>
</html>
