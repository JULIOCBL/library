<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <meta name="url" content="{{ url('/') }}" />
    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="{{ mix('js/helper.js') }}"></script>
    <script src="{{ mix('js/home.js') }}"></script>

</head>

<body class="antialiased">

    <div class="intro-y box p-5 mt-5">

        <div class="row">

            <div class="col-3">
                <label for="author_id" class="form-label">Author</label>
                <select id="author_id" class="form-select" aria-label="Default select example">
                    <option value="*">*</option>
                </select>
            </div>

            <div class="col-3">
                <label for="editorial_id" class="form-label">Editorial</label>

                <select id="editorial_id" class="form-select" aria-label="Default select example">
                    <option value="*">*</option>

                </select>
            </div>
            <div class="col-3">

            </div>
            <div class="col-3 d-flex flex-row-reverse">

                <a href="{{ route('view.book') }}" type="button" class="btn btn-primary" style=" height: 41px;">new
                    book</a>
            </div>
        </div>

        <br>

        <div class="overflow-x-auto scrollbar-hidden">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th class="whitespace-nowrap">Folio</th>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Description</th>
                        <th class="whitespace-nowrap">Year</th>
                        <th class="whitespace-nowrap">author</th>
                        <th class="whitespace-nowrap">editorial</th>
                        <th class="whitespace-nowrap">edit</th>
                    </tr>
                </thead>
                <tbody id="list-books">
                  

                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul id="paginate" class="pagination">
                    
                </ul>
            </nav>
        </div>
    </div>
    </div>
</body>

</html>
