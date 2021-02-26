import React from 'react';
import ReactDOM from 'react-dom';

function Example() {
    return (
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Emitir factura o cotización.</strong>
                        </div>
                        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                            <span class="badge badge-pill badge-warning">¡Atención!</span>
                                Al momento de estar realizando su factura. <span class="badge badge-pill badge-warning">¡No
                                    recargue esta página!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form method="POST" onsubmit="return checkSubmit();">
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Fecha de emisión" class="text-primary fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input id="date_issue" name="date_issue" type="date"
                                        class="text-dark form-control "
                                        value="<?php echo date('y/m/d'); ?>"
                                        onchange="addDays(30);" required autocomplete="date_issue" autofocus />
                                </div>
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Fecha de vencimiento" class="text-primary fas fa-calendar-times"></i>
                                        </span>
                                    </div>
                                    <input id="expiration_date" name="expiration_date" type="date"
                                        value="{{ old('expiration_date') }}"
                                        class="text-dark form-control @error('expiration_date') is-invalid @enderror"
                                        required autocomplete="expiration_date" autofocus readonly />
                                </div>

                                <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}" />
                                <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i class="text-primary fas fa-tags"></i>
                                        </span>
                                    </div>
                                    <select name="applied_price" id="applied_price"
                                        class="form-control @error('applied_price') is-invalid @enderror" required
                                        onchange="alert('Los precios serán afectados con esta opción.')">
                                        <option selected disabled>Precio a aplicar</option>
                                        <option value="1">Especial</option>
                                        <option value="2">Contado</option>
                                        <option value="3">Crédito</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i class="text-primary fas fa-receipt"></i>
                                        </span>
                                    </div>
                                    <select name="invoice_type" id="invoice_type"
                                        class="form-control @error('invoice_type') is-invalid @enderror" required>
                                        <option selected disabled>Tipo de factura</option>
                                        <option value="0">Factura sin iva</option>
                                        <option value="1">Factura con iva</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i class="text-primary fas fa-file-word"></i>
                                        </span>
                                    </div>
                                    <select name="document_type" id="document_type"
                                        class="form-control @error('document_type') is-invalid @enderror" required>
                                        <option selected disabled>Tipo de gestión</option>
                                        <option value="1">Factura</option>
                                        <option value="0">Cotización</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <a type="submit" class="btn btn-secondary mb-1" data-toggle="modal"
                                            data-target="#largeModal"><i class="text-light fas fa-user-plus"></i>
                                        </a>
                                    </div>
                                    <select name="customer_id" id="cifrado" onchange="mostrarInput();"
                                        class="select2 form-control @error('customer_id') is-invalid @enderror">
                                        <option selected disabled>Cliente</option>
                                        <option value="0">C/F</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <input class="text-dark form-control" name="customer_name"
                                        placeholder="Nombre del cliente" id="numero" type="text" />
                                </div>

                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <input class="text-dark form-control" name="customer_email" placeholder="Correo"
                                        id="text" type="text" />
                                </div>

                                <textarea class="form-control" rows="5" id="description" placeholder="Descripción"
                                    name="description" value="{{ old('description') }}"></textarea>

                                <input type="hidden" name="date" id="date" />
                                <br>

                                </br>
                                <button type="button" onclick="agregarProducto()" style="border-radius: 95px;"
                                    class="btn btn-success text-light" data-dismiss="modal">Agregar Producto<i
                                        class="fas fa-cart-plus text-light"></i>
                                </button>

                                <input type="hidden" id="ListaPro" name="ListaPro" value="" />

                                <div class="row table-responsive">
                                    <table id="TablaPro" class="table table-striped table-bordered dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ProSelected">
                                            <tr>

                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Total</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td><span id="total">0</span>
                                                    <td>&nbsp;</td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <label>Total</label>
                                        </span>
                                    </div>

                                    <input id="spTotal" onchange="numbersToText()"
                                        class="text-dark form-control @error('spTotal') is-invalid @enderror" name="spTotal"
                                        readonly />
                                </div>


                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <input id="totalletras"
                                        class="text-dark form-control @error('totalletras') is-invalid @enderror"
                                        name="totalletras" autofocus value="total letras" readonly />

                                </div>

                                <div class="container">
                                    <div class="col-12">
                                        <div class="col text-center">
                                            <button type="submit" style="border-radius: 10px"
                                                class="btn btn-lg btn-primary mt-3">
                                                <i class="far fa-save"></i>Guardar
                                                </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
