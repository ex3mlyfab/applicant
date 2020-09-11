<template>
    <!-- Pharmacy Modal -->
 <div class="modal" id="purchase-block-normal" tabindex="-1" role="dialog" aria-labelledby="purchase-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-top" role="document" >
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title">Drug Purchase Order</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">


                        <form class="form form-element" onsubmit="return false;">
                            <div class="form-group form-row">
                                <div class="form-group col-md-4">
                                    <label for="supplier">Choose Supplier</label>
                                    <select @change="changeSupplier($event)" name="supplier_id" id="supplier" class="form-control form-control-lg" required>
                                        <option value="" selected disabled>Choose</option>
                                        <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">
                                            {{ supplier.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group ml-auto">
                                    <label>Selected</label>
                                    <input type="text" class="form-control form-control-lg" readonly :value="supplier.display">
                                </div>
                            </div>
                            <h2 class="text-center">Fill Purchase Order</h2>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="drugs">
                                <thead>
                                <th>Class</th>
                                <th>Drug Name/ Form</th>
                                <th>Quantity ordered</th>
                                <th>Cost</th>
                                <th>MIN / Avail</th>

                                <th style="text-align: center;background: #eee">

                                </th>
                                </thead>
                                <tbody>
                                <tr v-for="(purchaseOrder, k) in purchaseOrders" :key="k">
                                    <td scope="row" class="trashIconContainer">
                                        <i class="far fa-trash-alt" @click="deleteRow(k, purchaseOrder)"></i>
                                    </td>
                                    <td>
                                        <select class="form-control" v-model="purchaseOrders[k].drugModelId" @change="changeDrug($event)">
                                            <option v-for="(drugModel, j) in drugModels" :key="j" :value="drugModel.name">
                                                {{ drugModel.name }}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control text-right" type="number" min="0" step=".01" v-model="purchaseOrder.price" @change="calculateLineTotal(purchaseOrder)"
                                        />
                                    </td>
                                    <td>
                                        <input class="form-control text-right" type="number" min="0" step=".01" v-model="purchaseOrder.product_qty" @change="calculateLineTotal(purchaseOrder)"
                                        />
                                    </td>
                                    <td>
                                        <input type="text" readonly class="form-control">
                                    </td>
                                    <td>
                                        <input readonly class="form-control text-right" type="number" min="0" step=".01" v-model="purchaseOrder.line_total" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">
                                        total Price
                                    </td>
                                    <td>
                                        <p>{{ invoice_total }}</p>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>


                    <button type='button' class="btn btn-info" @click="addNewRow">
                        <i class="fas fa-plus-circle"></i>
                        Add
                    </button>


                            <button  id="drugSubmit" data-appointment="" class="btn btn-primary pull-right">Submit</button>
                    </form>

                    </div>

                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
</div>

</template>
<script>
    export default {
        props: ['generated_by', 'purchase_order_id'],
        data(){
            return {
                suppliers: [],
                supplier_id: '',
                selectedSupplier: '',
                supplier:{
                    id: '',
                    display: ''
                },
                invoice_total: '',
                drugModels: [],
                filteredDrugs:[],
                filteredDrug:{},
                drugModel: {},
                purchaseOrders : [{
                    drugModelId:'',
                    price: '',
                    product_qty: '',
                    line_total:0,
                    drugModel:{
                        name: '',
                    }
                }],
                purchaseOrder:{
                    drugModel: {
                        name: '',
                    },
                }
            }
        },
        methods: {
            loadSuppliers(){
              let _this = this;
               axios.get('/admin/suppliers/load').then (function(response){
                    _this.suppliers = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            loadDrugs(){
                let _this = this;
                axios.get('/admin/drug/getall').then( function(response){
                    _this.drugModels = response.data;
                    console.log(response.data);
                }).catch(function(error){
                    console.log(error);
                })
            },
            loadPurchaseOrders(){
                let _this = this;
            },
            changeDrug(event){
               console.log(event.target.value);



            },
            changeSupplier(event){
                this.supplier.id = event.target.value;
                this.supplier.display= event.target.options[event.target.options.selectedIndex].text;
            },
            calculateTotal() {
                var total;
                total = this.purchaseOrders.reduce(function (sum, product) {
                    var lineTotal = parseFloat(product.line_total);
                    if (!isNaN(lineTotal)) {
                        return sum + lineTotal;
                    }
                }, 0);


                if (!isNaN(total)) {
                    this.invoice_total = total.toFixed(2);
                } else {
                    this.invoice_total = '0.00'
                }
            },
            displayDrugName(name = ""){
                return name
            },
            calculateLineTotal(purchaseOrder) {
                var total = parseFloat(purchaseOrder.price) * parseFloat(purchaseOrder.product_qty);
                if (!isNaN(total)) {
                    purchaseOrder.line_total = total.toFixed(2);
                }
                this.calculateTotal();
            },
            deleteRow(index, purchaseOrder) {
                var idx = this.purchaseOrders.indexOf(purchaseOrder);
                console.log(idx, index);
                if (idx > -1) {
                    this.purchaseOrders.splice(idx, 1);
                }
                this.calculateTotal();
            },
            addNewRow() {
                this.purchaseOrders.push({
                    drugModelId:'',
                    price: '',
                    product_qty: '',
                    line_total:0
                });
            }
        },
        created: function(){
            this.loadSuppliers();
            this.loadDrugs();
        },
        computed: {

        }

    }

</script>

