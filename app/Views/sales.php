<!DOCTYPE html>
<html lang='es'>

<?php include_once '../app/Views/partials/head.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php include_once '../app/Views/partials/navbar.php' ?>

        <?php include_once '../app/Views/partials/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Facturas de Ventas</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Lista de ventas
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th>Factura</th>
                                                <th>Cliente</th>
                                                <th>Monto</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!-- /.Left col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <div class="modal fade" id="modal-view">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalles de la factura</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-text"><b>Cliente:</b></p>
                                <p class="card-text" id="client"></p>
                                <p class="card-text"><b>Fecha:</b></p>
                                <p class="card-text" id="date"></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text"><b>Factura:</b></p>
                                <p class="card-text" id="factura"></p>
                                <p class="card-text"><b>Monto:</b></p>
                                <p class="card-text" id="monto"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive mt-3">
                                <table class="table" id="table-products">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="hidden" name="id-modal" id="id-modal">
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <?php include_once '../app/Views/partials/footer.php' ?>
    </div>
    <!-- ./wrapper -->

    <!-- Import JavaScript -->
    <!-- Import AdminLTE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js" integrity="sha512-KBeR1NhClUySj9xBB0+KRqYLPkM6VvXiiWaSz/8LCQNdRpUm38SWUrj0ccNDNSkwCD9qPA4KobLliG26yPppJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function get() {
            $.get('/api/sales')
              .done(res => {
                const sales = JSON.parse(res)
                const table = document.getElementById('table').children[1]
                table.innerHTML = ``
                sales.forEach(sale => {
                    const row = table.insertRow()
                    row.setAttribute('id', sale.id);
                    row.innerHTML = `
                        <th>${sale.factura.toUpperCase()}</th>
                        <td>${sale.client}</td>
                        <td>${sale.mount}</td>
                        <td>${sale.date_created}</td>
                        <td></td>
                    `
                    const btnView = document.createElement('button')
                    btnView.setAttribute('data-toggle', 'modal')
                    btnView.setAttribute('data-target', '#modal-view')
                    btnView.className = 'btn btn-primary'
                    btnView.innerHTML = `
                        <span class="fas fa-eye"></span>
                    `
                    btnView.onclick = () => {
                        const client = document.getElementById('client')
                        const date = document.getElementById('date')
                        const factura = document.getElementById('factura')
                        const monto = document.getElementById('monto')
                        const tableProducts = document.getElementById('table-products')

                        Array.from(tableProducts.children[0].children)
                            .forEach((r, i) => {
                                if (i > 0) {
                                    r.remove()
                                }
                            })

                        client.innerText = sale.client
                        date.innerText = sale.date_created
                        factura.innerText = sale.factura.toUpperCase()
                        monto.innerText = sale.mount
                        console.log(sales)
                        const products = sales
                            .filter(s => s.client === sale.client)
                            .map(s => s.product)

                        products.forEach(id => {
                            $.get('/api/products')
                                .done(res => {
                                    const productsDetails = JSON.parse(res)
                                    const product = productsDetails.find(p => p.id === id)
                                    const rowProduct = tableProducts.insertRow()
                                    rowProduct.setAttribute('id', id)
                                    rowProduct.innerHTML = `
                                        <td>${product.name}</td>
                                        <td>${sale.amount}</td>
                                        <td>${sale.mount}</td>
                                    `
                                })
                        })
                    }

                    const btnGroups = document.createElement('div')
                    btnGroups.className = 'btn-group'
                    btnGroups.appendChild(btnView)

                    row.children[4].appendChild(btnGroups)
                })
              })
              .fail(err => console.log(err))
        }

        document.addEventListener('DOMContentLoaded', () => {
            get()
        })
    </script>

    <!-- End of the imports -->
</body>

</html>
