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
                            <h1 class="m-0 text-dark">Productos</h1>
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
                                        Lista y administracion de productos
                                    </h3>
                                    <?php if ($_SESSION['role_id'] === 1) { ?>
                                        <div class="card-tools">
                                            <ul class="nav nav-pills ml-auto">
                                                <li class="nav-item">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                                        <span class="fas fa-plus"></span>
                                                        Añadir nuevo producto
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div><!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Referencia</th>
                                                <th>Tipo</th>
                                                <th>Nombre</th>
                                                <th>PVP</th>
                                                <th>Divisas</th>
                                                <th>Categoria</th>
                                                <th>Cantidad</th>
                                                <th>Estado</th>
                                                <?php if ($_SESSION['role_id'] === 2 || $_SESSION['role_id'] === 1) { ?>
                                                <th>Acciones</th>
                                                <?php } ?>
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

        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registro de nuevo producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger text-center d-none" id="alert-modal-add">
                            Debe de llenar el formulario correctamente
                        </div>
                        <form id="form-add" role="form">
                            <div class="form-row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="productType">Tipo</label>
                                        <select id="productType" class="form-control">
                                        </select>
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="productCategory">Categoria</label>
                                        <select id="productCategory" class="form-control">
                                        </select>
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="code">Codigo</label>
                                        <input type="text" class="form-control" id="code" placeholder="Ingresar codigo">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="reference">Referencia</label>
                                        <input type="text" class="form-control" id="reference" placeholder="Ingresar referencia">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nombre del producto</label>
                                        <input type="text" class="form-control" id="name" placeholder="Ingresar nombre del producto">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="pvp">Precio</label>
                                        <input type="text" class="form-control" id="pvp" placeholder="Precio del producto">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="badge">Divisa</label>
                                        <input type="text" class="form-control" id="badge" placeholder="Precio en divisas">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="stock">Stock Inicial</label>
                                        <input type="text" class="form-control" id="badge" placeholder="Stock Inicial">
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="provider">Proveedor</label>
                                        <select class="form-control" id="provider">
                                        </select>
                                        <p class="text-danger text-error d-none">Debe de llenar el campo correctamente</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btn-modal-add">Guardar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-trash">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">El producto se inhabilitara</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Esta seguro de inhabilitar este producto?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="hidden" name="id-modal" id="id-modal">
                        <button type="button" class="btn btn-danger" id="btn-modal-remove">Si, estoy seguro</button>
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
            $.get('/api/products')
              .done(res => {
                const products = JSON.parse(res)
                const table = document.getElementById('table').children[1]
                table.innerHTML = ``
                products.filter(employee => Number(employee.status) === 1).forEach(product => {
                    const row = table.insertRow()
                    row.setAttribute('id', product.id);
                    row.innerHTML = `
                        <td>${product.code}</td>
                        <td>${product.reference}</td>
                        <td>${product.type_product.name}</td>
                        <td>${product.name}</td>
                        <td>${product.pvp}</td>
                        <td>${product.badge}</td>
                        <td>${product.category.name}</td>
                        <td>${product.stock.stock}</td>
                        <td>${Boolean(product.status) ? 'Activo' : 'Inactivo'}</td>
                        <td></td>
                    `
                    const btnRemove = document.createElement('button')
                    btnRemove.setAttribute('data-toggle', 'modal')
                    btnRemove.setAttribute('data-target', '#modal-trash')
                    btnRemove.className = 'btn btn-danger'
                    btnRemove.innerHTML = `
                        <span class="fas fa-trash"></span>
                    `
                    btnRemove.onclick = () => {
                        document.getElementById('id-modal').value = product.id
                    }

                    const btnGroups = document.createElement('div')
                    btnGroups.className = 'btn-group'
                    btnGroups.appendChild(btnRemove)

                    <?php if ($_SESSION['role_id'] === 2 || $_SESSION['role_id'] === 1) { ?>
                        row.children[9].appendChild(btnGroups)
                    <?php } ?>
                })
              })
              .fail(err => console.log(err))
        }

        function renderOptions() {
            const productCategorySelect = document.getElementById('productCategory')
            const productTypeSelect = document.getElementById('productType')
            const providerSelect = document.getElementById('provider')

            $.get('/api/categories')
                .done(res => {
                    const categories = JSON.parse(res)
                    let template = '<option value="Ninguna">Elegir categoria[Opcional]</option>'

                    categories.forEach(category => {
                        if (Number(category.status) === 1) {
                            template += `
                                <option value=${category.id}>${category.name}</option>
                            `
                        }
                    })

                    productCategorySelect.innerHTML = template
                })
                .fail(err => console.log(err))

            $.get('/api/types')
                .done(res => {
                    const types = JSON.parse(res)
                    let template = '<option value="Ninguna">Elegir Tipo[Opcional]</option>'

                    types.forEach(type => {
                        template += `
                            <option value=${type.id}>${type.name}</option>
                        `
                    })

                    productTypeSelect.innerHTML = template
                })
                .fail(err => console.log(err))

            $.get('/api/providers')
                .done(res => {
                    const providers = JSON.parse(res)
                    let template = '<option value="">Elegir un proveedor</option>'

                    providers.forEach(provider => {
                        if (Number(provider.status) === 1) {
                            template += `
                                <option value=${provider.id}>${provider.name} - ${provider.company}</option>
                            `
                        }
                    })

                    providerSelect.innerHTML = template
                })
                .fail(err => console.log(err))
        }

        document.addEventListener('DOMContentLoaded', () => {
            const inputs = Array.from(document.querySelectorAll('#form-add input, #form-add select'))
            const textsErrors = Array.from(document.getElementsByClassName('text-error'))

            get()

            renderOptions()

            inputs.forEach((input, i) => {
                input.onfocus = () => {
                    input.classList.remove('border')
                    input.classList.remove('border-danger')
                    textsErrors[i].classList.add('d-none')
                }

                input.onblur = () => {
                    if (input.value === '') {
                        input.classList.add('border')
                        input.classList.add('border-danger')
                        textsErrors[i].classList.remove('d-none')
                        return
                    }

                    if (input.id === 'pvp' || input.id === 'stock' || input.id === 'badge') {
                        let count = Number(input.value)

                        if (!count) {
                            input.classList.add('border')
                            input.classList.add('border-danger')
                            textsErrors[i].classList.remove('d-none')
                            textsErrors[i].innerHTML = 'Debe ingresar un valor correcto'
                        }

                        return
                    }

                    input.classList.remove('border')
                    input.classList.remove('border-danger')
                    textsErrors[i].classList.add('d-none')
                }
            })

            document.getElementById('btn-modal-add')
                .addEventListener('click', (e) => {
                    let isCorrect = true

                    const alertModalAdd = document.getElementById('alert-modal-add')

                    inputs.forEach((input, i) => {
                        if (input.value === '') {
                            input.classList.add('border')
                            input.classList.add('border-danger')
                            textsErrors[i].classList.remove('d-none')
                            return
                        }

                        if (input.id === 'pvp' || input.id === 'stock' || input.id === 'badge') {
                            let count = Number(input.value)

                            if (!count) {
                                input.classList.add('border')
                                input.classList.add('border-danger')
                                textsErrors[i].classList.remove('d-none')
                                textsErrors[i].innerHTML = 'Debe ingresar un valor correcto'
                            }

                            return
                        }

                        input.classList.remove('border')
                        input.classList.remove('border-danger')
                        textsErrors[i].classList.add('d-none')
                    })

                    isCorrect = inputs.every(input => input.value !== '')

                    let isCorrectNumbers = inputs
                        .filter(input => input.id === 'pvp' || input.id === 'stock' || input.id === 'badge')
                        .every(input => Number(input.value))

                    if (isCorrect && isCorrectNumbers) {
                        e.target.innerHTML = `
                            <div class="spinner-border text-light" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        `

                        alertModalAdd.classList.add('d-none')

                        const newData = {
                            type_product    : inputs[0].value,
                            category        : inputs[1].value,
                            code            : inputs[2].value,
                            reference       : inputs[3].value,
                            name            : inputs[4].value,
                            pvp             : inputs[5].value,
                            badge           : inputs[6].value,
                            stock           : inputs[7].value,
                            provider        : inputs[8].value
                        }

                        $.post('/api/products/add', newData)
                            .done(res => {
                                let { message } = JSON.parse(res)

                                if (message === 'success') {
                                    e.target.innerHTML = 'Guardar'
                                    inputs.forEach((input) => {
                                        input.value = ''
                                    })
                                    $('#modal-lg').modal('hide')
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 300;
                                    toastr.options.closeEasing = 'swing';
                                    toastr.success('Agregado satisfactoriamente')
                                    get()
                                }
                            })
                            .fail(err => console.log(err))
                    } else {
                        alertModalAdd.classList.remove('d-none')
                    }
                })

                document.getElementById('btn-modal-remove')
                    .addEventListener('click', () => {
                        const { value } = document.getElementById('id-modal')

                        const newData = {
                            status: 0,
                            id: value
                        }

                        $.post('/api/products/edit', newData)
                            .done(res => {
                                let { message } = JSON.parse(res)

                                if (message === 'success') {
                                    $('#modal-trash').modal('hide')
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 300;
                                    toastr.options.closeEasing = 'swing';
                                    toastr.success('Acción Realizada con exito')
                                    get()
                                }
                            })
                            .fail(err => console.log(err))
                    })
        })
    </script>

    <!-- End of the imports -->
</body>

</html>
