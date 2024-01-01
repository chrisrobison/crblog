<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Christopher Robison: Blog Entry</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&family=Titillium+Web:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/fontawesome-free-6.4.0-web/css/all.min.css">
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
<style>
  .match {
    background-color: #ff06;
  }
  .small {
    font-size: 12px;
  }
</style>
</head>
<body class="hold-transition iframe-mode ">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Search Results</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Search</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div id="search-results" class="card-body">
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy; 2024 <a href="https://cdr2.com">Christopher Robison</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/crblog/assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/crblog/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/crblog/assets/js/adminlte.min.js"></script>
<script>
if (parent && parent.fixIframeHeight) parent.fixIframeHeight() ;
async function doSearch() {
    let query = document.location.search.replace(/^\?q=/, '');
    query = encodeURIComponent(query);
    let req1 = await fetch("/crblog/search.php?q="+query); 
    let data = await req1.json();
    
    if (data) {
        let out = "";
        data.sort((a, b) => { return b.weight - a.weight } );

        data.forEach(item=>{
            out += `<div class='result'><a href="${item.url}" target="_blank" alt="${item.title}">${item.title}</a><br><a class='small' href="${item.url}" target="_blank" alt="${item.title}">https://cdr2.com${item.url}</a><br><p class='small'>${item.snippet}</p></div>`;
        });
        document.querySelector("#search-results").innerHTML = out;
    }
};
doSearch();
</script>
</body>
</html>
