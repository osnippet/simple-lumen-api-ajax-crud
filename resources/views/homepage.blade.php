
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=" {{ $name }}">
    <meta name="author" content="">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>{{ $name }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/dashboard.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
     <div class="container">
      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>Flatly</h1>
            <p class="lead">Flat and modern</p>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-6">
            <p class="lead">Flat and modern Yes</p>
          </div>
        </div>
      </div>

      <div class="container">
            <form id="dataForm">
                <fieldset>
                    <legend>Add Post</legend>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" id="title" placeholder="Enter Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Enter Description"></textarea>
                    </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </fieldset>
            </form>
            <hr>
            <ul id="items" class="list-group"></ul>          
        </div>
    
    
    
          <footer id="footer">
    
          </footer>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          getData();
          // Submit event
          $('#dataForm').on('submit', function(e){
            e.preventDefault();
    
            let title = $('#title').val();
            let description = $('#description').val();
    
            addData(title, description);
          });
    
          // Delete event
          $('body').on('click', '.deleteLink', function(e){
            e.preventDefault();
    
            let id = $(this).data('id');
    
            deleteData(id);
          });
    
          // Delete item through api
          function deleteData(id){
            $.ajax({
              method:'POST',
              url:'/lumen/api/posts/'+id,
              data: {_method: 'DELETE'}
            }).done(function(item){
            //   alert('Item Removed');
              location.reload();
            });
          }
    
          // Insert items using api
          function addData(title, description){
            $.ajax({
              method:'POST',
              url:'/lumen/api/posts',
              data: {title: title, description: description}
            }).done(function(item){
            //   alert('Item # '+item.id+' added');
              location.reload();
            });
          }
    
          // Get items from API
          function getData(){
            $.ajax({
              url:'/lumen/api/posts'
            }).done(function(items){
              let view = '';
              $.each(items, function(key, item){
                view += `
                  <li class="list-group-item">
                    <strong>${item.title}: </strong>${item.description} <a href="#" class="deleteLink" data-id="${item.id}">Delete</a>
                  </li>
                `;
              });
              $('#items').append(view);
            });
          }
        });
      </script>
    </body>
</html>
