<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/styles.css">

  <style>
    body {
       gap: 2rem;
      justify-content: center;
      padding: 2rem;
      place-items: center;
      
    }

    div {
      height: 20%;
      width: 100%;
    }

    .animate {
      animation-duration: 0.75s;
      animation-delay: 1s;
      animation-name: animate-fade;
      animation-timing-function: cubic-bezier(0.26, 0.53, 0.74, 1.48);
      animation-fill-mode: backwards;
      background: #DDFFFF;
      margin-bottom: 7px;
    }

    .animate:hover{
      background: #A2FFFF;
      cursor:pointer;
    }
    /* Glow In */
    .animate.glow {
      animation-name: animate-glow;
      animation-timing-function: ease;
    }

    @keyframes animate-glow {
      0% {
        opacity: 0;
        filter: brightness(3) saturate(3);
        transform: scale(0.8, 0.8);
      }

      100% {
        opacity: 1;
        filter: brightness(1) saturate(1);
        transform: scale(1, 1);
      }
    }

    .delay-1 {
      animation-delay: 0.6s;
    }

    .delay-2 {
      animation-delay: 0.7s;
    }

    .delay-3 {
      animation-delay: 0.8s;
    }

    .delay-3 {
      animation-delay: 0.10s;
    }



    nav {
  display: flex;
  gap: 0.5rem;
}

a {
  flex: 1;
  background-color: #333;
  color: #fff;
  border: 1px solid;
  padding: 0.5rem;
  text-align: center;
  text-decoration: none;
  transition: all 0.5s ease-out;
}

a:hover,
a:focus {
  background-color: #fff;
  color: #333;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
  </style>
  <script>
    function requestSearch() {
      let authorName = document.getElementById('authorname').value;
      console.log(authorName);

      var request = new XMLHttpRequest();
      request.open('GET', 'http://localhost/Interpay/api/search.php?name=' + authorName, true);

      request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
          // Success!
          var data = JSON.parse(request.responseText);
          document.getElementById('container').innerHTML = '';
          if(data.data.length > 0){
            for (let i = 0; i < data.data.length; i++) {
              const element = data.data[i];
              let author = element['authorName'];
              let book = element['bookName'];
  
              const newDiv = document.createElement("div");
              newDiv.classList.add('animate');
              newDiv.classList.add('glow');
              newDiv.classList.add(`delay-${i}`);
              newDiv.innerHTML = '<b>Author:</b> '+author + ' <br><b>Book:</b> ' + '<p style="color:#FF5100">'+book+'</p>';
              document.getElementById('container').appendChild(newDiv);
  
            }

          }else{
            document.getElementById('container').innerHTML = `You Search with '${authorName}' Not has Results `;

          }
        
        } else {
          // We reached our target server, but it returned an error
          
        }
      };

      request.onerror = function() {
        // There was a connection error of some sort
      };

      request.send();
    }
  </script>

</head>

<body>
  <nav>
    <a href="http://localhost/Interpay/frontpage/?pathToSearch=search.php">Home</a>
    <a href="http://localhost/Interpay/api/">Readed XML</a>
  </nav>

  
  <br><br>
  <form action="#" onsubmit="return false">
    <label for="authorname">Author Name:</label><br>
    <input type="text" id="authorname" name="authorname" value=""><br>
    <input type="submit" value="Search" onclick="javascript:requestSearch();">
  </form>
<span> <h3>Books List:</h3> </span> 
  <div id="container">

  </div>
</body>

</html>


<?php

/*
namespace App;

header('content-type: application/json; charset=utf-8');

const ROOT_TEST_PATH = __DIR__;

$response = json_encode('No Data Found', http_response_code(404));
$criteria = array('name' => $_REQUEST['name']);
$path = $_REQUEST['pathToSearch'];


  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/Interpay/api/'.$path,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $criteria,
  ));

  $response = curl_exec($curl);

  http_response_code(200);

  curl_close($curl);


echo $response;
*/
