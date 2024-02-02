<!DOCTYPE html>
<html lang= "en">
<head>
 <meta charset="UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"> 
    <meta name="description" content="PHP">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="author" content="Bolux"> 
  <!-- Latest compiled and minified CSS -->
  <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <!-- jQuery library -->
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
 <!-- Popper JS -->
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <!-- Latest compiled JavaScript -->
  <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
  <script src="https://kit.fontawesome.com/965b829563.js" crossorigin="anonymous"></script>
  <link rel= "stylesheet" type= "text/css" href= "index.css">
</head>

<body>
    <div class="container">
        <h1>StarWars API Viewer</h1>

        <div class="category" id="films">
            <h2> <i class="fas fa-film"></i> Films</h2>
             <div class= "table-container">
              <table class= "table table-striped">
              
              </table>
             </div>
            <button class="loadMore btn btn-success">Load More</button>
        </div>

        <div class="category" id="people">
            <h2> <i class="fa-solid fa-person-half-dress"></i></i> People</h2>
            <div class= "table-container">
              <table class= "table table-striped">
              
              </table>
             </div>
            <button class="loadMore btn btn-success">Load More</button>
        </div>

        <div class="category" id="planets">
            <h2> <i class="fas fa-globe"></i> Planets</h2>
            <div class= "table-container">
              <table class= "table table-striped">
              
              </table>
             </div>
            <button class="loadMore btn btn-success">Load More</button>
        </div>

        <div class="category" id="species">
            <h2> <i class="fa-solid fa-snowflake"></i></i> Species</h2>
            <div class= "table-container">
              <table class= "table table-striped">
              
              </table>
             </div>
            <button class="loadMore btn btn-success">Load More</button>
        </div>

        <div class="category" id="starships">
            <h2> <i class="fa-solid fa-star-of-david"></i> Starships</h2>
             <div class= "table-container">
              <table class= "table table-striped">
              
              </table>
             </div>
            <button class="loadMore btn btn-success">Load More</button>
        </div>

        <div class="category" id="vehicles">
            <h2><i class="fa-solid fa-car-side"></i> Vehicles</h2>
            <div class= "table-container">
              <table class= "table table-striped">
              
              </table>
             </div>
            <button class="loadMore btn btn-success">Load More</button>
        </div>
         
        <script>
            const apiUrl = 'https://swapi.dev/api/';
            const itemsPerPage = 10;

            function loadData(endpoint, page = 1) {
                $.get(`${apiUrl}${endpoint}/?page=${page}`, function (data) {
                    displayData(endpoint, data.results);
                    const category = $(`#${endpoint}`);
                    const loadMoreButton = category.find('.loadMore');

                    if (data.next) {
                        loadMoreButton.show();
                        loadMoreButton.off('click').on('click', function () {
                            loadData(endpoint, page + 1);
                        });
                    } else {
                        loadMoreButton.hide();
                    }
                });
            }

            function displayData(endpoint, items) {
                const category = $(`#${endpoint}`);
                const table = category.find('table');
                const tableBody = table.find('tbody');
                table.empty(); 

                if (items.length === 0) {
                    table.hide();
                    return;
                } else {
                    table.show();
                }

                const headers = Object.keys(items[0]);
                const headerRow = '<thead><tr>' + headers.map(header => `<th>${header}</th>`).join('') + '</tr></thead>';
                table.append(headerRow);

                const tableBodyHtml = items.map(item => createTableRowHtml(item, headers)).join('');
                table.append(`<tbody>${tableBodyHtml}</tbody>`);
            }

            function createTableRowHtml(item, headers) {

                return `<tr>${headers.map(header => `<td>${item[header]}</td>`).join('')}</tr>`;
            }

            $(document).ready(function () {
            
                loadData('films');
                loadData('people');
                loadData('planets');
                loadData('species');
                loadData('starships');
                loadData('vehicles');
                
            });
            </script>
        </div>
</body>
</html>
