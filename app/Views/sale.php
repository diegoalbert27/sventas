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
                            <h1 class="m-0 text-dark">Venta Directa</h1>
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
                                        Venta de productos para los clientes
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="alert alert-danger d-none" id="alert-sale">
                                        El Formulario debe ser llenado correctamente
                                    </div>
                                    <form id="form-add">
                                        <div class="form-row mb-3">
                                            <div class="col-xs col-md-1">
                                                <label for="client">Cliente:</label>
                                            </div>
                                            <!-- <div class="col-xs col-md-1">
                                                <input class="form-control" type="text">
                                            </div> -->
                                            <div class="col-xs col-md-3">
                                                <input class="form-control" id="ci" type="text" placeholder="Buscar por cedula">
                                            </div>
                                            <!-- <div class="col-xs col-md-5">
                                                <input class="form-control" type="text">
                                            </div> -->
                                            <div class="col-xs col-md">
                                                <input class="form-control" id="client" type="text">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="card-text"><b>Productos</b></p>
                                        </div>
                                        <div class="form-row p-3">
                                            <div class="col-xs col-md-12 text-right">
                                                <button class="btn btn-primary" type="button" id="btn-add-product">
                                                    <span class="fas fa-plus"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="products-list">
                                            <div class="form-row mb-3 text-center">
                                                <!-- <div class="col-xs col-md-2">
                                                    <label for="code">Codigo</label>
                                                    <input class="form-control" type="text">
                                                </div> -->
                                                <div class="col-xs col-md-3">
                                                    <label for="product">Producto:</label>
                                                    <!-- <input class="form-control" type="text"> -->
                                                    <select class="form-control" id="products">
                                                    </select>
                                                </div>
                                                <div class="col-xs col-md">
                                                    <label for="amount">Cantidad:</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-xs col-md-2">
                                                    <label for="stock">Existencia:</label>
                                                    <input class="form-control" name="stock" type="text" readonly>
                                                </div>
                                                <div class="col-xs col-md-2">
                                                    <label for="price">Precio Unitario:</label>
                                                    <input class="form-control" name="pvp" type="text" readonly>
                                                </div>
                                                <div class="col-xs col-md-2">
                                                    <label for="total">Total:</label>
                                                    <input class="form-control" type="text" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row border-top p-3">
                                            <div class="col-xs col-md-8 text-right">
                                                <p class="card-text"><b>Subtotal:</b></p>
                                                <p class="card-text"><b>Total a pagar:</b></p>
                                            </div>
                                            <div class="col-xs col-md-4 text-right totales">
                                                <p class="card-text"><b>0</b></p>
                                                <p class="card-text"><b>0</b></p>
                                            </div>
                                        </div>
                                        <!-- <div class="text-center p-3 mt-2 border-bottom">
                                            <p class="card-text"><b>Detalles del pago</b></p>
                                        </div> -->
                                        <div class="text-right p-3 mt-2 border-bottom">
                                            <button class="btn btn-success" id="btn-sale">PROCESAR</button>
                                        </div>
                                    </form>
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

        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Elija un producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
        function getProducts(callback) {
            $.get('/api/products')
              .done(res => {
                const products = JSON.parse(res)
                callback(products)
              })
              .fail(err => console.log(err))
        }

        document.addEventListener('DOMContentLoaded', () => {
            const ci = document.getElementById('ci')
            const client = document.getElementById('client')
            const products = document.getElementById('products')

            let productsList = []

            const btnAddProduct = document.getElementById('btn-add-product')

            getProducts((products) => {
                let template = `<option value="">Eliga un producto</option>`
                products.filter(product => Number(product.status) === 1).forEach(product => {
                    template += `
                        <option value="${product.id}">${product.name}</option>
                    `
                })
                document.getElementById('products')
                    .innerHTML = template
            })

            products.addEventListener('change', (e) => {
                const inputs = Array.from(document.querySelectorAll('#products-list input'))
                
                const { value } = e.target
                
                if (value === '') {
                    inputs[0].value = 0
                    inputs[1].value = 0
                    inputs[2].value = 0
                    inputs[3].value = 0
                    return
                }

                getProducts(products => {
                    const product = products.find(product => product.id === value)
                    inputs[0].value = 1
                    inputs[1].value = product.stock.stock
                    inputs[2].value = product.pvp

                    if (Number(inputs[0].value)) {
                        inputs[3].value = Number(inputs[0].value) * Number(product.pvp)
                    }

                    inputs[0].onkeyup = (e) => {
                        const { value } = e.target
                        inputs[3].value = Number(inputs[0].value) * Number(product.pvp)
                    }
                })
            })

            btnAddProduct.addEventListener('click', () => {
                const inputs = Array.from(document.querySelectorAll('#products-list input, select'))

                if (inputs[0].value === '') {
                    return
                }

                const newProduct = {
                    id: inputs[0].value,
                    amount: inputs[1].value,
                    mount: inputs[4].value
                }

                productsList = [...productsList, newProduct]

                const productList = document.getElementById('products-list')
                const row = document.createElement('div')
                row.className = 'form-row mb-3 text-center'
                inputs.forEach(input => {
                    const col = document.createElement('div')
                    col.className = 'col-xs col-md'
                    col.innerHTML = `
                        <label>${input.parentElement.children[0].innerText}</label>
                        <p class="card-text">${input.value}</p>
                    `
                    row.appendChild(col)
                })
                productList.appendChild(row)

                const totales = document.getElementsByClassName('totales')[0].children
                let subtotal = Number(totales[0].innerText) === 0 ? 1 : Number(totales[0].innerText)
                totales[0].innerText = subtotal + Number(inputs[4].value)
                totales[1].innerText = subtotal + Number(inputs[4].value)
            })

            ci.addEventListener('focus', (e) => {
                const alert = document.getElementById('alert-sale')
                ci.classList.remove('border')
                ci.classList.remove('border-danger')
                alert.classList.add('d-none')
            })

            ci.addEventListener('keyup', (e) => {
                const { value } = e.target

                $.get('/api/customers')
                    .done(res => {
                        const customers = JSON.parse(res)
                        const customer = customers.find(customer => customer.ci === value)

                        if (!customer) {
                            client.value = 'No encontrado'
                            return
                        }

                        client.value = `${customer.first_name} ${customer.last_name}`
                    })
                    .fail(err => console.error(err))
            })

            document.getElementById('form-add')
                .addEventListener('submit', (e) => {
                    e.preventDefault()
                    
                    const alert = document.getElementById('alert-sale')
                    if (client.value === 'No encontrado' || client.value === '') {
                        ci.classList.add('border')
                        ci.classList.add('border-danger')
                        alert.classList.remove('d-none')
                        return;
                    }

                    ci.classList.remove('border')
                    ci.classList.remove('border-danger')
                    
                    if (productsList.length === 0) {
                        alert.classList.remove('d-none')
                        return
                    }

                    alert.classList.add('d-none')

                    productsList.forEach(product => {
                        const newSale = {
                            product: product.id,
                            client: ci.value,
                            amount: product.amount,
                            mount: product.mount
                        }

                        $.post('/api/sales/add', newSale)
                            .done(res => {
                                let { message } = JSON.parse(res)

                                if (message === 'success') {
                                    ci.value = ''
                                    client.value = ''

                                    Array.from(document.querySelectorAll('#products-list input'))
                                        .forEach(input => input.value = '')

                                    Array.from(document.querySelectorAll('#products-list')[0].children)
                                        .forEach((row, i) => {
                                            if (i > 0) {
                                                row.innerHTML = ''
                                            }
                                        })

                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 300;
                                    toastr.options.closeEasing = 'swing';
                                    toastr.success('Venta Realizada con exito')
                                }
                            })
                            .fail(err => console.log(err))
                    })
                })
        })
    </script>

    <!-- End of the imports -->
</body>

</html>
