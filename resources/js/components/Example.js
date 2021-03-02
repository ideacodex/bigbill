import { now } from 'lodash';
import React from 'react';
import ReactDOM from 'react-dom';

class Example extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            date_issue: now(), expiration_date: now(), applied_price: null,
        };

        this.handleChangeDateIssue = this.handleChangeDateIssue.bind(this);
        this.handleChangeAppliedPrice = this.handleChangeAppliedPrice.bind(this);
    }

    handleChangeDateIssue(event) {
        console.log('fecha: ', event.target.value);
        var result = new Date(event.target.value);
        result.setDate(result.getDate() + 30);
        console.log(result.getUTCMonth());
        let month=result.getMonth() + 1
        let formatDate= result.getFullYear() + "-" + (month<10? '0'+month: month) + "-" + result.getDate();
        console.log(formatDate);
        this.setState({ date_issue: event.target.value });
        this.setState({ expiration_date: formatDate });
    }

    handleChangeAppliedPrice(event) {
        console.log('select: ', event.target.value);
        alert('Los precios serán afectados con esta opción.')
        this.setState({ expiration_date: formatDate });
    }

    render() {
        return (
            <div className="animated fadeIn" >
                <div className="row">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">
                                <strong className="card-title">Emitir factura o cotización.</strong>
                            </div>
                            <div className="card-body">
                                <form method="POST" onSubmit="return checkSubmit();">
                                    <div className="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div className="input-group-prepend">
                                            <span className="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Fecha de emisión" className="text-primary fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input id="date_issue" name="date_issue" type="date"
                                            className="text-dark form-control "
                                            value={this.state.date_issue} onChange={this.handleChangeDateIssue} required />
                                    </div>
                                    <div className="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div className="input-group-prepend">
                                            <span className="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Fecha de vencimiento" className="text-primary fas fa-calendar-times"></i>
                                            </span>
                                        </div>
                                        <input id="expiration_date" name="expiration_date" type="date"
                                            value={this.state.expiration_date}
                                            className="text-dark form-control"
                                            required readOnly />
                                    </div>

                                    <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}" />
                                    <div className="col-12 col-md-6 input-group input-group-lg mb-4">
                                        <div className="input-group-prepend">
                                            <span className="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i className="text-primary fas fa-tags"></i>
                                            </span>
                                        </div>
                                        <select name="applied_price" id="applied_price"
                                            className="form-control @error('applied_price') is-invalid @enderror" required
                                            onChange={this.handleChangeAppliedPrice} value={this.state.applied_price}>
                                            <option selected disabled>Precio a aplicar</option>
                                            <option value="1">Especial</option>
                                            <option value="2">Contado</option>
                                            <option value="3">Crédito</option>
                                        </select>
                                    </div>

                                    <div className="col-12 col-md-6 input-group input-group-lg mb-4">
                                        <div className="input-group-prepend">
                                            <span className="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i className="text-primary fas fa-receipt"></i>
                                            </span>
                                        </div>
                                        <select name="invoice_type" id="invoice_type"
                                            className="form-control @error('invoice_type') is-invalid @enderror" required>
                                            <option selected disabled>Tipo de factura</option>
                                            <option value="0">Factura sin iva</option>
                                            <option value="1">Factura con iva</option>
                                        </select>
                                    </div>
                                    <div className="col-12 col-md-6 input-group input-group-lg mb-4">
                                        <div className="input-group-prepend">
                                            <span className="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i className="text-primary fas fa-file-word"></i>
                                            </span>
                                        </div>
                                        <select name="document_type" id="document_type"
                                            className="form-control @error('document_type') is-invalid @enderror" required>
                                            <option selected disabled>Tipo de gestión</option>
                                            <option value="1">Factura</option>
                                            <option value="0">Cotización</option>
                                        </select>
                                    </div>
                                    <div className="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div className="input-group-prepend">
                                            <a type="submit" className="btn btn-secondary mb-1" data-toggle="modal"
                                                data-target="#largeModal"><i className="text-light fas fa-user-plus"></i>
                                            </a>
                                        </div>
                                        <select name="customer_id" id="cifrado" onChange="mostrarInput();"
                                            className="select2 form-control @error('customer_id') is-invalid @enderror">
                                            <option selected disabled>Cliente</option>
                                            <option value="0">C/F</option>
                                        </select>
                                    </div>

                                    <div className="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <input className="text-dark form-control" name="customer_name"
                                            placeholder="Nombre del cliente" id="numero" type="text" />
                                    </div>

                                    <div className="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <input className="text-dark form-control" name="customer_email" placeholder="Correo"
                                            id="text" type="text" />
                                    </div>

                                    <textarea className="form-control" rows="5" id="description" placeholder="Descripción"
                                        name="description" value="{{ old('description') }}"></textarea>

                                    <input type="hidden" name="date" id="date" />
                                    <br>

                                    </br>
                                    <button type="button" onClick="agregarProducto()"
                                        className="btn btn-success text-light" data-dismiss="modal">Agregar Producto<i
                                            className="fas fa-cart-plus text-light"></i>
                                    </button>

                                    <input type="hidden" id="ListaPro" name="ListaPro" value="" />

                                    <div className="row table-responsive">
                                        <table id="TablaPro" className="table table-striped table-bordered dataTable no-footer">
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

                                    <div className="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div className="input-group-prepend">
                                            <span className="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <label>Total</label>
                                            </span>
                                        </div>

                                        <input id="spTotal" onChange="numbersToText()"
                                            className="text-dark form-control @error('spTotal') is-invalid @enderror" name="spTotal"
                                            readOnly />
                                    </div>


                                    <div className="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <input id="totalletras"
                                            className="text-dark form-control @error('totalletras') is-invalid @enderror"
                                            name="totalletras" value="total letras" readOnly />

                                    </div>

                                    <div className="container">
                                        <div className="col-12">
                                            <div className="col text-center">
                                                <button type="submit"
                                                    className="btn btn-lg btn-primary mt-3">
                                                    <i className="far fa-save"></i>Guardar
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
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
