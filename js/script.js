$("select#tipo_documento").change(function (event) {
      var tipo_documento = document.getElementById('tipo_documento').value;
      var req = this.createXMLHTTPObject();
      if (!req) return;
      var url = 'http://www.seu_site.com.br/seu_php.php?tipo_documento = ' . tipo_documento;
      req.open('GET',url,true);
      req.onreadystatechange = function () {          
        if (req.readyState != 4) {
            return;
        }
        if (req.status != 200 && req.status != 304) {
            alert('HTTP error ' + req.status);
            return;
        }


        alert('ok');
    }
    if (req.readyState == 4) return;
    req.send();


});