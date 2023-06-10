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

    <script>
        const id_book = {{ $id}};
    </script>
    
    <script src="{{ mix('js/helper.js') }}"></script>
    <script src="{{ mix('js/book.js') }}"></script>
</head>

<body class="antialiased">

    <div class="intro-y box p-5 mt-5">

        <div class="intro-y box">
           
            <form id="frmBook" action="{{ route('books.update', ['id' => $id])}}">

                <div id="input" class="p-5">
                    <h2 class="font-medium text-base mr-auto">Save book</h2>
                    <div class="preview">
                        <div>
                            <label for="title" class="form-label">Title</label>
                            <input id="title" name="title" type="text" class="form-control" placeholder="Input text">
                        </div>
                        <div>
                            <label for="description" class="form-label">Description</label>
                            <input id="description" name="description" type="text" class="form-control" placeholder="Input text">
                        </div>
                        <div class="mt-3">
                            <label for="year" class="form-label">Year</label>
                            <input id="year" name="year"  type="number" class="form-control form-control-rounded"
                                placeholder="2004">
                        </div>
                        <div class="mt-3">
                            <label for="author_id" class="form-label">Author</label>
                            <select  id="author_id" name="author_id" min="4" max="4"  class="form-select mt-2 sm:mr-2" aria-label="Default select example">
                   
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="editorial_id" class="form-label">Editorial</label>
                         
                            <select id="editorial_id" name="editorial_id" class="form-select mt-2 sm:mr-2" aria-label="Default select example">
                               
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class=" d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary" onclick="update()">update book</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>
</body>

</html>