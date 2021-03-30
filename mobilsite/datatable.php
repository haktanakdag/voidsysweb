 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
<style>
body {
  background: #F8F8F8;
}

/* ============================================================
	Responsive Table via Data Label
============================================================ */
table {
  border: 0;
  width: 100%;
  margin: 0;
  padding: 0;
  border-collapse: collapse;
  border-spacing: 0;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
}
table thead {
  background: #F0F0F0;
  height: 60px !important;
}
table thead tr th:first-child {
  padding-left: 45px;
}
table thead tr th {
  text-transform: uppercase;
  line-height: 60px !important;
  text-align: left;
  font-size: 11px;
  padding-top: 0px !important;
  padding-bottom: 0px !important;
}
table tbody {
  background: #fff;
}
table tbody tr {
  border-top: 1px solid #e5e5e5;
  height: 60px;
}
table tbody tr td:first-child {
  padding-left: 45px;
}
table tbody tr td {
  height: 60px;
  line-height: 60px !important;
  text-align: left;
  padding: 0 10px;
  font-size: 14px;
}
table tbody tr td i {
  margin-right: 8px;
}

@media screen and (max-width: 800px) {
  table {
    border: 1px solid transparent;
    box-shadow: none;
  }
  table thead {
    display: none;
  }
  table tbody tr {
    border-bottom: 45px solid #F8F8F8;
  }
  table tbody tr td:first-child {
    padding-left: 10px;
  }
  table tbody tr td:before {
    content: attr(data-label);
    float: left;
    font-size: 10px;
    text-transform: uppercase;
    font-weight: bold;
  }
  table tbody tr td {
    display: block;
    text-align: right;
    font-size: 14px;
    padding: 0px 10px !important;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
  }
}
</style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


</head>

<body translate="no" >
  <div class="container">
  <h2>Responsive Table</h2>            
  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td data-label="first-name">John</td>
        <td data-label="last-name">Doe</td>
        <td data-label="email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3b515453557b5e435a564b575e15585456">[email&#160;protected]</a></td>
      </tr>
      <tr>
        <td data-label="first-name">Mary</td>
        <td data-label="last-name">Moe</td>
        <td data-label="email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="214c405358614459404c514d440f424e4c">[email&#160;protected]</a></td>
      </tr>
      <tr>
        <td data-label="first-name">July</td>
        <td data-label="last-name">Dooley</td>
        <td data-label="email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c1abb4adb881a4b9a0acb1ada4efa2aeac">[email&#160;protected]</a></td>
      </tr>
    </tbody>
  </table>
</div>
  
  
  