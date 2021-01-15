<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Convertor</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Convertor</a>
        </div>
    </nav>
    <main class="container">
        <form action="/result" class="needs-validation">
            @csrf
            <div class="row g-3 py-5">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" id="amount" name="amount" class="form-control" placeholder="Сколько">
                        <select name="from" id="from" class="form-select">
                            @foreach ($currencies as $currency => $value)
                                <option value={{$currency}}>{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span type="submit" class="input-group-text">Сконвертировать в :</span>
                        <select name="to" id="from" class="form-select">
                            @foreach ($currencies as $currency => $value)
                                <option value={{$currency}}>{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text">По курсу от</span>
                        <input class="form-control" type="date" name="date" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary bg-dark">Конвертация</button>
                </div>
            </div>
        </form>
        @yield('main')
    </main>
</body>
</html>
