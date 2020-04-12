<!DOCTYPE html>
<html>
    <head>
        <title>Esempio ajax</title>

        <script>
            var xhr;

            var id;
            var nome;
            var cognome;
            var sidi;
            var tax;

            function get()
            {
                document.getElementById("contentRisposta").style.display="block";
                //preparo la richiesta ajax
                xhr = new XMLHttpRequest();
                //asincrona
                xhr.open("GET", 'http://localhost:80/phprest/api.php', true);
                //configuro la callback di risposta ok
                xhr.onload = function() {
                    //scrivo la risposta nel body della pagina
                    document.getElementById('risposta').innerHTML = xhr.response;
                };
                //configuro la callback di errore
                xhr.onerror = function() { 
                    alert('Errore');
                };
                //invio la richiesta ajax
                xhr.send();
            }

            function getid()
            {
                document.getElementById("contentRisposta").style.display="block";

                id = document.getElementById("inputId").value;
                xhr = new XMLHttpRequest();
                xhr.open("GET", 'http://localhost:80/phprest/api.php?id='+id, true);
                xhr.onload = function()
                {
                    document.getElementById('risposta').innerHTML = xhr.response;
                }
                xhr.onerror = function()
                { 
                    alert('Errore');
                };
                xhr.send();
            }

            function deleteid()
            {
                document.getElementById("contentRisposta").style.display="block";
                
                id = document.getElementById("inputId").value;
                xhr = new XMLHttpRequest();
                xhr.open("DELETE", 'http://localhost:80/phprest/api.php?id='+id, true);
                xhr.onload = function()
                {
                    document.getElementById('risposta').innerHTML = xhr.response;
                }
                xhr.onerror = function()
                { 
                    alert('Errore');
                };
                xhr.send();
            }

            function post()
            {
                document.getElementById("contentRisposta").style.display="block";

                nome = document.getElementById("inputNome").value;
                cognome = document.getElementById("inputCognome").value;
                sidi = document.getElementById("inputSidi").value;
                tax = document.getElementById("inputTax").value;
                xhr = new XMLHttpRequest();
                xhr.open("POST", 'http://localhost:80/phprest/api.php', true);
                xhr.onload = function()
                {
                    document.getElementById('risposta').innerHTML = xhr.response;
                }
                xhr.onerror = function()
                { 
                    alert('Errore');
                };
                xhr.send(
                    JSON.stringify({
                        "name":nome,
                        "surname":cognome,
                        "sidi_code":sidi,
                        "tax_code":tax
                    })
                );
            }

            function patch()
            {
                document.getElementById("contentRisposta").style.display="block";

                id = document.getElementById("inputId2").value;
                nome = document.getElementById("inputNome2").value;
                cognome = document.getElementById("inputCognome2").value;
                sidi = document.getElementById("inputSidi2").value;
                tax = document.getElementById("inputTax2").value;
                xhr = new XMLHttpRequest();
                xhr.open("PATCH", 'http://localhost:80/phprest/api.php', true);
                xhr.onload = function()
                {
                    document.getElementById('risposta').innerHTML = xhr.response;
                }
                xhr.onerror = function()
                { 
                    alert('Errore');
                };
                xhr.send(
                    JSON.stringify({
                        "id":id,
                        "name":nome,
                        "surname":cognome,
                        "sidi_code":sidi,
                        "tax_code":tax
                    })
                );
            }

            function put()
            {
                document.getElementById("contentRisposta").style.display="block";

                id = document.getElementById("inputId2").value;
                nome = document.getElementById("inputNome2").value;
                cognome = document.getElementById("inputCognome2").value;
                sidi = document.getElementById("inputSidi2").value;
                tax = document.getElementById("inputTax2").value;
                xhr = new XMLHttpRequest();
                xhr.open("PUT", 'http://localhost:80/phprest/api.php', true);
                xhr.onload = function()
                {
                    document.getElementById('risposta').innerHTML = xhr.response;
                }
                xhr.onerror = function()
                { 
                    alert('Errore');
                };
                xhr.send(
                    JSON.stringify({
                        "id":id,
                        "name":nome,
                        "surname":cognome,
                        "sidi_code":sidi,
                        "tax_code":tax
                    })
                );
            }
        </script>

        
        

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <!--<h2>Richiesta</h2>
        <button class="btn btn-primary" id="get" onclick="get()">GET</button>
        <br>
        <div class="content rounded">
            <input id="inputId" placeholder="ID studente"/>
            <button class="btn btn-primary" id="getid" onclick="getid()">GET ID</button>
            <button class="btn btn-primary"id="deleteid" onclick="deleteid()">DELETE</button>
        </div>
        <div class="content row rounded">
            <div class="col-6">
                <input id="inputNome" placeholder="Nome"/><br>
                <input id="inputCognome" placeholder="Cognome"/><br>
                <input id="inputSidi" placeholder="Codice SIDI"/><br>
                <input id="inputTax" placeholder="Codice fiscale"/><br>
            </div>
            <div class="col-6">
                <button class="btn btn-primary " id="post" onclick="post()">POST</button>
            </div>
        </div>
        <div class="content row rounded">
            <div class="col-6">
                <input id="inputId2" placeholder="ID Studente"/><br>
                <input id="inputNome2" placeholder="Nome"/><br>
                <input id="inputCognome2" placeholder="Cognome"/><br>
                <input id="inputSidi2" placeholder="Codice SIDI"/><br>
                <input id="inputTax2" placeholder="Codice fiscale"/><br>
            </div>
            <div class="col-6">
                <button class="btn btn-primary" id="patch" onclick="patch()">PATCH</button>
                <br>
                <button class="btn btn-primary" id="put" onclick="put()">PUT</button>
            </div>
        </div>
        <div id="contentRisposta">
        <h2>Risposta</h2>
        <div class="content rounded" id="risposta"></div>
        </div>-->
        
      <!--Table-->

<?php

?>
<table class="table table-hover table-fixed">
            <tr>
                <td>Year</td>
                <td>Section</td>
            </tr>
</table>
            <?php
               while ($row = mysql_fetch_array($sql)) {
                   echo "<tr>";
                   echo "<td>".$row['year']."</td>";
                   echo "<td>".$row['section']."</td>";
                   echo "</tr>";
               }

            ?>
    </body>
</html>
