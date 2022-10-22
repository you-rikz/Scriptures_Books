<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '8450b8bf9921f0a99f536da4a22aef1ea2bea0a25a1f1a0713bc5e67ab6b285a102919cf780d165535b59cebcabab748bf1755e9d22ff51ffe81341562a79c560c055541bd2d419bb3ebf41c33a21dab70e2dc13b773fda85efd15316bcc7889e65e812155506b7c45f41e7d46016f35e525161623dcf1c32d4134874168188b';

    try {
        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
          'Authorization' => 'Bearer ' . $token,        
          'Accept'        => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
          'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<pre>';
        var_dump($e);
    }
    return null; 
}

$books = getBooks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="card-body">
<h1 style="text-align:center;">BIBLE and Authors</h1>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Author</th>
      <th scope="col">Category</th>
    </tr>
    <?php
        foreach($books ->data as $data){
            $book = $data->attributes;
            ?>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row"><?php echo $data ->id; ?></th>
                    <td><?php echo $book ->name; ?></td>
                    <td><?php echo $book ->author; ?></td>
                    <td><?php echo $book ->category; ?></td>
                   
                    </tr>
                </tbody>
        
                <?php
        }
        ?>
</table>
    </div>
    </div>
    









<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>