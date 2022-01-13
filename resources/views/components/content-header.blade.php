<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{$title}} <span class="badge badge-pill badge-success">{{$count}}</span> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">{{$prefix ??  $title }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
