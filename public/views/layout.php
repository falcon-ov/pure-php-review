<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + Bootstrap + Vue.js (CDN)</title>
    <!-- Bootstrap CSS через CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body>
    <div id="app" class="container mt-5">
        <h1>{{ message }}</h1>
        <p>Данные из PHP: {{ phpData }}</p>
        <button class="btn btn-primary" @click="changeMessage">Изменить текст</button>
        <button class="btn btn-secondary" @click="fetchData">Загрузить данные</button>
    </div>

    <!-- Vue.js через CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Bootstrap JS через CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.phpData = <?php echo json_encode(['phpData' => 'Привет от PHP!'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    </script>
    <script src="/js/app.js"></script>
</body>

</html>