<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action={{route('store')}} method="POST" enctype="multipart/form-data">
            @csrf
            <legend>Thông tin ứng viên</legend>
            <div class="mb-3">
                <input type="file" name="file_excel" id="file_excel" class="form-control mt-3" required>
                <input type="submit" class="btn btn-primary mt-3" value="Thêm file">
              </div>
        </form>
    </div>
</body>
</html>
